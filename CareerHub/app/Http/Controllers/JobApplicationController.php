<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
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
}
