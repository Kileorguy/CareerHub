<?php

namespace App\Http\Controllers;

use App\Models\UserAwards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserAwardsController extends Controller
{
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
        $awards = UserAwards::create([
            'id'=> Str::uuid()->toString(),
            'user_id'=> Auth::user()->id,
            'award_name'=> $request->input('award_name'),
            'award_detail'=> $request->input('award_detail'),
            'company'=> $request->input('company'),
            'image_link'=> $request->input('image_link'),
            'issued_date'=> $request->input('issued_date'),

        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAwards $userAwards)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAwards $userAwards)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAwards $userAwards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAwards $userAwards)
    {
        //
    }
}
