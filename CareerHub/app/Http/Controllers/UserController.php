<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
  public function register(Request $request)
  {
    $role = $request->input('role');

    if ($role === "Employee") {
      $this->validateCreateEmployee($request);
      $user = $this->createEmployee($request);
    } else {
      $this->validateCreateCompany($request);
      $user = $this->createCompany($request);
    }

    Auth::login($user);

    return redirect('/login')->with('success', 'User registered successfully!');
  }

  private function validateCreateEmployee(Request $request)
  {
    $rules = [
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|confirmed|min:8',
      'role' => 'required|string',
    ];

    Validator::make($request->all(), $rules)->validate();
  }

  private function createEmployee(Request $request)
  {
    return User::create([
      'id' => Str::uuid(),
      'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password')),
      'role' => $request->input('role'),
    ]);
  }

  private function validateCreateCompany(Request $request)
  {
    $rules = [
      'email' => 'required|email|unique:users,email',
      'password' => 'required|confirmed|min:8',
      'name' => 'required|string|max:255',
      'country' => 'required|string|max:255',
      'city' => 'required|string|max:255',
    ];

    Validator::make($request->all(), $rules)->validate();
  }

  private function createCompany(Request $request)
  {
    $company_id = Str::uuid();

    Company::create([
      'id' => $company_id,
      'name' => $request->input('name'),
      'country' => $request->input('country'),
      'city' => $request->input('city'),
      'description' => $request->input('description'),
    ]);

    return User::create([
      'id' => Str::uuid(),
      'company_id' => $company_id,
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password')),
      'role' => $request->input('role'),
    ]);
  }
}
