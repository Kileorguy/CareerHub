<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginUserController extends Controller
{
    public function login(Request $request) {

//        dd(Auth::user());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }else{
            return redirect('/login');
        }

//        return redirect('/');

    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

    public function profile(){
        $user = Auth::user();
        $data = $user->experiences;
        return view('profile', ['experiences' => $data]);
    }
}
