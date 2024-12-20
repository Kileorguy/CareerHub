<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
  public function create($id)
  {
    $user_id = Auth::user()->id;
    $job_id = $id;
    JobApplication::insert([
      'user_id' => $user_id,
      'job_id' => $job_id,
    ]);
    return redirect()->back()->with('message', 'Job application submitted successfully');
  }

  public function update(Request $req, $job_id, $user_id)
  {
    $status = $req->status;
    JobApplication::where('job_id', $job_id)
      ->where('user_id', $user_id)
      ->update(['status' => $status]);
    return redirect()->back()->with('message', 'Job application updated successfully');
  }

  public function employeeDetail(User $employee)
  {
    $employee = User::with(['certificates', 'awards', 'experiences', 'skills', 'projects', 'educations'])->findOrFail($employee->id);

    return view('employee.applicant_detail', compact('employee'));
  }
}
