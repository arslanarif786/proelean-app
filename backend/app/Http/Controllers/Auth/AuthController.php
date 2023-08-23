<?php

namespace App\Http\Controllers\Auth;
// use Illuminate\Auth\Events\Registered;
// use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function VerifyEmail($id)
    {
        $user=User::where('id',customDecrypt($id))->update([
            'verified'=>1,
        ]);
        return $user
        ? view('Auth.verification-success')
        : redirect('/?user_not_updated');
        return redirect('/');
    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }


    public function index()
    {
        return view('Auth.login');
    }

    public function registerUser(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:50','unique:users'],
            'username' => ['bail', 'required', 'string', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:6'],
            'password_confirmation' => ['nullable', 'required_with:password', 'same:password'],
        ]);


        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('message', 'User Added  Successfuly!');
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withErrors(['auth' =>'Login details are not valid']);
    }

    public function forgotPassword(Request $request){
        $request->validate(['email' => 'required|email|exists:users,email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function ResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
