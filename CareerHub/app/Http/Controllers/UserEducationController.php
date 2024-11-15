<?php

namespace App\Http\Controllers;

use App\Models\UserEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserEducationController extends Controller
{
    public function InsertEducation(Request $req){
        $user = Auth::user();
        UserEducation::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'education_name' => $req->school,
            'major'=> $req->major,
            'gpa' => $req->grade,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
        ]);

        return redirect('/profile');
    }
    public function updateEducation(Request $req, $id)
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserEducation $userEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserEducation $userEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserEducation $userEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserEducation $userEducation)
    {
        //
    }
}
