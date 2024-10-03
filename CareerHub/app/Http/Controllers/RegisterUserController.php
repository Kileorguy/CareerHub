<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterUserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // $first_name = $request->first_name;
        // $last_name = $request->last_name;
        // $email = $request->email;
        // $password = $request->password;
        // $role = $request->role;

        // User::create([
        //     'first_name' => $first_name,
        //     'last_name' => $last_name,
        //     'email' => $email,
        //     'password' => bcrypt($password),
        //     'role' => $role,
        // ]);

        // return redirect()->route('login')->with('success', 'Registration successful!');
    }
}

