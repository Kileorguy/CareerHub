<?php

namespace App\Http\Controllers;

use App\Models\UserProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserProjectsController extends Controller
{
    public function InsertProject(Request $req){
        $user = Auth::user();
        UserProjects::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'project_name' => $req->project_name,
            'project_detail' => $req->project_detail,
        ]);

        return redirect('/profile');
    }
    public function updateProject(Request $req, $id)
    {
        $user = Auth::user();

        $project = UserProjects::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->first();

        $project->project_name = $req->project_name;
        $project->project_detail = $req->project_detail;

        $project->save();

        return redirect('/profile');
    }
}
