<?php

namespace App\Http\Controllers;

use App\Models\UserProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserProjectsController extends Controller
{
    public function create(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'project_name' => 'required',
            'project_detail' => 'required',
        ]);
        UserProjects::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'project_name' => $req->project_name,
            'project_detail' => $req->project_detail,
        ]);

        return redirect('/profile');
    }

    public function update(Request $req, $id)
    {
        $user = Auth::user();
        $req->validate([
            'project_name' => 'required',
            'project_detail' => 'required',
        ]);
        $project = UserProjects::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        $project->project_name = $req->project_name;
        $project->project_detail = $req->project_detail;

        $project->save();

        return redirect('/profile');
    }

    public function delete(Request $req, $id)
    {
        $user = Auth::user();

        $project = UserProjects::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ($project) {
            $project->delete();
        }

        return redirect('/profile');
    }
}
