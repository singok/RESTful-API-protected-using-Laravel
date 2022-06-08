<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(Request $request) 
    {
        // validation
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:8 | confirmed',
        ]);

        $feedback = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($feedback) {
            return response(['success' => 'User Registered Successfully.']);
        } else {
            return response(['failure' => 'Something went wrong.']);
        }
    }

    public function signin(Request $request) 
    {
        // validate
        $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:8'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['failure' => 'Credentials doesnot match.']);
        } else {

            // generate token
            $token = $user->createToken($request->email);
            return response([
                'success' => 'Logged in Successfully.',
                'token' => $token->plainTextToken
            ]);
        }
    }

    public function signout(Request $request)
    {
        $info = $request->user()->tokens()->delete();
        if ($info) {
            return response([
                'success' => 'Logged Out Successfully.'
            ]);
        } else {
            return response([
                'failure' => 'Something went wrong.'
            ]);
        }
    }
}
