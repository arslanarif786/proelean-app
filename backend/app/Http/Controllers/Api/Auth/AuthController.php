<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ProfileResource;
use App\Models\FcmToken;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Traits\MediaTrait;

class AuthController extends Controller
{
    use MediaTrait;

    public function Register(RegisterRequest $request, AuthService $service)
    {
        $user = $service->createUser((object)$request->validated());
        if ($user) {
            return response()->json(['message' => 'Activation link sent successfully please check your email'], 201);
        } else {
            return response()->json(['message' => 'Oops internal server error'], 500);
        }
    }

    public function login(LoginRequest $request, AuthService $service)
    {
        return $service->login($request->only('email', 'password'));
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->save();
        //$user->tokens()->delete();
        $request->user()->currentAccessToken()->delete();

        FcmToken::where('user_id', $user->id)
            ->where('device_id', $this->getDeviceId())
            ->delete();

        return response()->json(['message' => 'Logged Out Successfully']);
    }

    public function UserProfile()
    {
        $user = auth()->user();
        $userID = isset($_GET['user']) && !is_null($_GET['user']) ? customDecrypt($_GET['user']) : $user->id;
        $user = User::findOrFail($userID);
        return new ProfileResource($user);
    }
    // update user profile
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $oldPhoto = $user->image;
        if ($request->hasFile('image')) {
            $user->image = $this->uploadFile($request, 'uploads/user_snaps', 'image');
        }
        $isUpdated = $user->update($request->only(['name', 'address', 'email', 'description' , 'phone', 'fcm_token', 'latitude', 'longitude']) + ['image' => $user->image]);
        if ($isUpdated) {
            if ($oldPhoto && $user->image && $oldPhoto != $user->image) {
                unlink($oldPhoto);
            }
            return new ProfileResource(User::find($user->id));
        }
        return response()->json(['message' => 'Request failed'], 400);
    }


    public function updatepassword(UpdatePasswordRequest $request)
    {
        $request = request();
        $user = auth()->user();
        $user->password = bcrypt($request->password);
        $password = $user->save();
        if ($password) {
            return response()->json(['message' => 'Password Update Successfuly']);
        }
    }

    // change password
    public function changePassword(ChangePasswordRequest $request, AuthService $service)
    {
        $password = $service->changepassword($request);

        if ($password == "true") {
            return response()->json(['message' => 'Password Update Successfuly']);
        } else if ($password == "not found") {
            return response()->json(['message' => 'Invalid Token'], 400);
        } else {
            return response()->json(['message' => 'Token is expired'], 400);
        }
    }
    // forgot password
    public function forgotPassword(ForgetPasswordRequest $request, AuthService $service)
    {
        $password = $service->forgetpassword((object)$request);
        if ($password)
            return response()->json(['message' => 'Reset Password Token Has Been Sent To Email']);
        else
            return response()->json(['message' => 'Processing Error']);
    }
}
