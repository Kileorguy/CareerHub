<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\JobSkill;
use Illuminate\Support\Facades\Hash;


class AuthorizedUserController extends Controller
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
            return redirect('/');
        } else {
            return redirect('/login')
                ->withErrors(['login' => 'Invalid credentials'])
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
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

    public function profile()
    {

        $user = Auth::user();

        if ($user->role == 'Employee') {
            $experiences = $user->experiences;
            $educations = $user->educations;
            $certificates = $user->certificates;
            $skills = $user->skills;
            $projects = $user->projects;
            $jobSkills = JobSkill::all();
            return view('profile.employee_profile', compact('experiences', 'educations', 'certificates', 'skills', 'projects', 'jobSkills'));
        } else if ($user->role == 'Company') {
            $company = $user->company;
            $jobs = $company->jobs;
            $jobs->load(['jobApplications' => function($query) {
                $query->where('status', 'Pending')->with('user');
            }]);
            return view('profile.company_profile', compact('company', 'jobs'));
        }
    }

    public function updateProfile(Request $req)
    {
        $user = Auth::user();

        $req->validate([
            'first' => 'required',
            'lastName' => 'required',
            'desc' => 'required',
            'porto' => 'required',
            'github' => 'required',
            'profile_image' => 'required',
        ]);

        $user->update([
            'first_name' => $req->first,
            'last_name' => $req->lastName,
            'short_description' => $req->desc,
            'portfolio_link' => $req->porto,
            'github_link' => $req->github,
            'profile_link' => $req->profile_image,
        ]);

        return redirect('/profile');
    }

    public function jobDetail(Request $req, $id)
    {
        $job = Job::find($id);
        $jobApplication = $job == null ? null : $job->jobApplications->where('user_id', Auth::user()->id)->first();
        return view('job_detail', compact('job', 'jobApplication'));
    }
}
