<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class RegisterUserController extends Controller
{
    public function register(Request $request)
    {
//        dd($request);
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
            $user = User::create([
                'id' => Str::uuid(),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
            ]);
            Auth::login($user);
        }
        else {
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

            $company = Company::create([
                'company_name' => $request->input('company_name'),
                'country' => $request->input('country'),
                'location' => $request->input('location'),
                'city' => $request->input('city'),
                'position_name' => $request->input('position_name'),
                'job_level' => $request->input('job_level'),
                'job_summary' => $request->input('job_summary'),
            ]);
        }

        echo "User registered successfully!";

        return redirect('/login');

    }

    public function test(){
        $response = Http::accept('application/json')->get('http://127.0.0.1:5000/csv_data');
//        dd($response->body());
        $data = json_decode($response->body(), true);
        // Now you can use $data as an array
        dd($data);
//        dd($response->json());
        // Check if the request was successful
        if ($response->successful()) {
            // Get the raw body of the response and decode it manually
            $data = json_decode($response->body(), true);

            // Check if the data was decoded successfully
            if ($data !== null) {
                dd($data); // Display the data
            } else {
                dd("ARGHH", $response->body());
            }
        } else {
            // Handle the error
            dd("Error fetching data from Flask API", $response->status(), $response->body());
        }
    }
}

