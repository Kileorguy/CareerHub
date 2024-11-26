<?php

namespace App\Http\Controllers;

use App\Models\UserExperience;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    public function InsertExperience(Request $req){
        $user = Auth::user();
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
    public function updateExperience(Request $req, $id)
    {
        $user = Auth::user();

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
}