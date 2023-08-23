<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function deleteUser(Request $request)
    {
        User::find(CustomDecrypt($request->user_id))->delete();
        return redirect()->back()->with('message', 'User Deleted  Successfuly!');
    }

    public function updateUser(Request $request)
    {
        $users=User::where('id',$request->user_id)->first();

        return response()->json([$users]);
    }

    public function editUser (Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'string', 'max:255'],

        ]);
        $user= User::where('id',$request->user_id)->first();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('message', 'User Update is Successfuly!');
    }


}
