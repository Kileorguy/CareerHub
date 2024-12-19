<?php

namespace App\Http\Controllers;

use App\Models\UserExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserExperienceController extends Controller
{
    public function create(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'company' => 'required',
            'job' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        UserExperience::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'company' => $req->company,
            'position' => $req->job,
            'description' => $req->description,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
        ]);

        return redirect('/profile');
    }

    public function update(Request $req, $id)
    {
        $user = Auth::user();
        $req->validate([
            'company' => 'required',
            'job' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $experience = UserExperience::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        $experience->company = $req->company;
        $experience->position = $req->job;
        $experience->description = $req->description;
        $experience->start_date = $req->start_date;
        $experience->end_date = $req->end_date;

        $experience->save();

        return redirect('/profile');
    }

    public function delete(Request $req, $id)
    {
        $user = Auth::user();

        $experience = UserExperience::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ($experience) {
            $experience->delete();
        }

        return redirect('/profile');
    }
}
