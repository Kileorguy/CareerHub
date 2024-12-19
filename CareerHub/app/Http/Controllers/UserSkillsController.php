<?php

namespace App\Http\Controllers;

use App\Models\UserSkills;
use App\Models\JobSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserSkillsController extends Controller
{
    public function create(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'skill_name' => 'required',
        ]);
        UserSkills::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'skill_name' => $req->skill_name,
        ]);

        $jobSkill = JobSkill::where('skill_name', $req->skill_name)
            ->first();

        if ($jobSkill == null) {
            JobSkill::create([
                'id' => Str::uuid(),
                'skill_name' => $req->skill_name,
            ]);
        }

        return redirect('/profile');
    }

    public function update(Request $req, $id)
    {
        $user = Auth::user();
        $req->validate([
            'skill_name' => 'required',
        ]);
        $skill = UserSkills::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        $skill->skill_name = $req->skill_name;

        $skill->save();

        $jobSkill = JobSkill::where('skill_name', $req->skill_name)
            ->first();

        if ($jobSkill == null) {
            JobSkill::create([
                'id' => Str::uuid(),
                'skill_name' => $req->skill_name,
            ]);
        }

        return redirect('/profile');
    }

    public function delete(Request $req, $id)
    {
        $user = Auth::user();

        $skill = UserSkills::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ($skill) {
            $skill->delete();
        }

        return redirect('/profile');
    }

}
