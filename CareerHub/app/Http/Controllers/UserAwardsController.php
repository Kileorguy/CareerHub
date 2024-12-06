<?php

namespace App\Http\Controllers;

use App\Models\UserAwards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserAwardsController extends Controller
{
    public function create(Request $request)
    {
        $awards = UserAwards::create([
            'id' => Str::uuid()->toString(),
            'user_id' => Auth::user()->id,
            'award_name' => $request->input('award_name'),
            'award_detail' => $request->input('award_detail'),
            'company' => $request->input('company'),
            'image_link' => $request->input('image_link'),
            'issued_date' => $request->input('issued_date'),

        ]);

        return redirect()->back();
    }
}
