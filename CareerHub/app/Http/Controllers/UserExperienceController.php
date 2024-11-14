<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $data = $user->experience;
        return view('profile', ['experience' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::User();
        $experience = $user->Experience()->create([
            'id' => Str::uuid()->toString(),
            'company' => 'hehe',
            'position' => 'mak lo',

        ]);
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
    public function show(UserExperience $userExperience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserExperience $userExperience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserExperience $userExperience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserExperience $userExperience)
    {
        //
    }
}
