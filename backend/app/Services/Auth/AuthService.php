<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Resources\ProfileResource;
use App\Jobs\SendEmailJob;
use App\Mail\SendResetPasswordCode;
use App\Models\Referal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    public function createUser($request):User
    {
        $request=request();
        $referal_code=$this->generateRandomInt();
        if(isset($_GET['referal_code']) && !empty($_GET['referal_code'])){
            $referance=User::where('referal_code',$_GET['referal_code'])->first();
            if(!$referance){
                return response()->json(['message'=>'no user found against this referal code'],404);
            }
        }
        $user=User::create($request->only('name','username','email')+[
            'password'=>bcrypt($request->password),
            'image'=>'assets/images/avator.png',
            'referal_code'=> $referal_code,
            'isFreelancer'=>0
        ]);
        if($user){
            // insert referance record if referal code exist
            if(isset($referance) && !empty($referance)){
                $this->storeReferance($referance->id,$user->id);
            }
            $id=customEncrypt($user->id);
            // send email to user with activation code
            SendEmailJob::dispatchAfterResponse([
                'user_email'=>$user->email,
                'user_name'=>$user->name,
                'url'=>$request->getSchemeAndHttpHost()."/email/verify/$id",
                'mailTo'=>'user',
                'mailFor'=>'verification'
            ]);

        }
        return $user;
    }

    public function changepassword(ChangePasswordRequest $request)
    {
        $datetime=date('Y-m-d H:i:s', strtotime('-1 hour'));
        $passwordCodeCheck=DB::table('password_resets')->where('email',$request->email)->where('token',$request->token)->first();
        if(empty($passwordCodeCheck))
        {
            return "not found";
        }

        $passwordCode=DB::table('password_resets')->where('email',$request->email)->where('token',$request->token)->where('created_at','>',$datetime)->first();
        if($passwordCode)
        {
            DB::table('users')->where('email',$request->email)->update([
                'password'=>bcrypt($request->password),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);

            DB::table('password_resets')->where('email',$request->email)->delete();
            return "true";

        } else {
           return "false";
        }
    }

    public function forgetpassword(Request $request)
    {

        $otpCode=rand(111111,999999);
        $datetime=date('Y-m-d H:i:s', strtotime('-1 hour'));
        //DB::table('password_resets')->where('email',$request->email)->delete();
        $passwordCode=DB::table('password_resets')->where('email',$request->email)->where('created_at','>',$datetime)->first();
        if(!$passwordCode)
        {
        DB::table('password_resets')->where('email',$request->email)->where('created_at','<',$datetime)->delete();
        DB::table('password_resets')->insert(
            array(
                'email'=>$request->email,
                'token'=>$otpCode,
                'created_at'=>date('Y-m-d H:i:s')
            )
        );
        Mail::to($request->email)->send(new SendResetPasswordCode($otpCode));
    }
    else
        Mail::to($request->email)->send(new SendResetPasswordCode($passwordCode->token));
    return true;

    }

    public function login($creds)
    {
        if(!auth()->attempt($creds)){
            return response()->json(['message'=>'invalid credentials'],401);
        }

        $user=auth()->user();
        if(!$user->verified) {

            $isEmailAlreadySent = DB::table('password_resets')->where('email', $creds['email'])->first();

            if($isEmailAlreadySent && $this->checkIfEmailSentAnHourBefore($isEmailAlreadySent)) {
                return response()->json(['message'=>'Please verify your account first to continue'],403);
            } else {
                $id = customEncrypt($user->id);
                dispatch(new SendEmailJob([
                    'user_email'=>$user->email,
                    'user_name'=>$user->name,
                    'url'=>request()->getSchemeAndHttpHost()."/email/verify/$id",
                    'mailTo'=>'user',
                    'mailFor'=>'verification'
                ]));
                return response()->json(['message'=>'A verification email has been sent, please verify your account first to continue'],403);
            }
        }

        $this->storeFcmTokenIfRequestHas();

        $token=$user->createToken($creds['email'])->plainTextToken;

        return response()->json([
                'message'=>'user login successfully',
                'token'=>$token,
                'data'=>new ProfileResource($user)
            ]);
    }


    private function storeFcmTokenIfRequestHas()
    {

        $request=request();
        $requestDeviceId = $request->header('Device-Id');
        $requestDeviceType = $request->header('Device-Type');


        auth()->user()->fcmTokens()->updateOrCreate(
            [
                'device_id' => $requestDeviceId,
                'device_type' => $requestDeviceType
            ],
            [
                'fcm_token' => $request->fcm_token,
            ]
        );
    }

    private function storeReferance($referance,$referal)
    {
        Referal::create([
            'referance_id'=>$referance,
            'referal_id'=>$referal
        ]);
    }

    private function generateRandomInt()
    {
        return rand(100000,999999);
    }

    private function checkIfEmailSentAnHourBefore($email)
    {
        $hourAgo = Carbon::now()->addHour();
        return Carbon::parse($email->created_at) < $hourAgo ? true : false;
    }

}
