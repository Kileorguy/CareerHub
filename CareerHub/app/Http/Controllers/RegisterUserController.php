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
        $user_validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|string',
        ]);

        if ($user_validator->fails()) {
            return redirect()->back()
                ->withErrors($user_validator)
                ->withInput();
        }

        if($request->input('role') == "Employee") {

            return;
        }

        $company_validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'country' => 'required',
            'location' => 'required',
            'city' => 'required',
            'position_name' => 'required',
            'job_level' => 'required',
            'job_summary' => 'required',
        ]);

        if ($company_validator->fails()) {
            return redirect()->back()
                ->withErrors($company_validator)
                ->withInput();
        }

        return redirect('/login');

    }
}

