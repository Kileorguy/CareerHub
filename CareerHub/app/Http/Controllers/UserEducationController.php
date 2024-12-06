<?php

namespace App\Http\Controllers;

use App\Models\UserEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserEducationController extends Controller
{
    public function create(Request $req)
    {
        $user = Auth::user();
        UserEducation::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'education_name' => $req->school,
            'major' => $req->major,
            'gpa' => $req->grade,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
        ]);

        return redirect('/profile');
    }
    
    public function update(Request $req, $id)
    {
        $user = Auth::user();

        $education = UserEducation::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        $education->education_name = $req->school;
        $education->major = $req->major;
        $education->gpa = $req->grade;
        $education->start_date = $req->start_date;
        $education->end_date = $req->end_date;

        $education->save();

        return redirect('/profile');
    }
}
