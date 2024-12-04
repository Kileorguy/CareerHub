<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\user;
use Illuminate\Support\Facades\Hash;


class LoginUserController extends Controller
{
  public function login(Request $request)
  {
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
      $user = Auth::user();

      return redirect('/');
    } else {
      return redirect('/login')
      ->withErrors(['login' => 'Invalid credentials'])
      ->withInput();
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('/login');
  }

  public function profile()
  {
    $user = Auth::user();

    if ($user->role == 'Employee') {
      $data = $user->experiences;
      $educations = $user->educations;
      $certificates = $user->certificates;
      return view('profile.employee.index', ['experiences' => $data, 'educations' => $educations, 'certificates' => $certificates]);
    } else if ($user->role == 'Company') {
      $company = $user->company;
      return view('profile.company.index', compact('company'));
    }
  }

  public function updateProfile(Request $req)
  {
    $user = Auth::user();

    $updatedUser = User::where('id', $user->id)->first();

    $updatedUser->first_name = $req->first;
    $updatedUser->last_name = $req->lastName;
    $updatedUser->short_description = $req->desc;
    $updatedUser->portfolio_link = $req->porto;
    $updatedUser->github_link = $req->github;
    $updatedUser->profile_link = $req->profile_image;

    $updatedUser->save();

    return redirect('/profile');
  }


  public function changePassword(Request $req)
  {
    $user = Auth::user();

    $req->validate([
      'old' => 'required',
      'new' => 'required|min:8',
      'confirm' => 'required|same:new',
    ]);

    if (Hash::check($req->old, $user->password)) {
      $user->password = bcrypt($req->new);
      $user->save();

      return redirect('/profile')->with('message', 'Password changed successfully!');
    } else {
      return redirect('/profile')->with('message', 'The old password is incorrect.');
    }
  }
}
