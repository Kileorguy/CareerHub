<?php

namespace App\Http\Controllers;

use App\Models\UserCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserCertificateController extends Controller
{

    public function InsertCertificate(Request $req){
        $user = Auth::user();
        UserCertificate::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'certificate_name' => $req->name,
            'image_link'=> $req->image,
            'detail' => $req->detail,
            'company' => $req->company,
            'issued_date' => $req->issued_date,
        ]);

        return redirect('/profile');
    }
    public function updateCertificate(Request $req, $id)
    {
        $user = Auth::user();

        $certificate = UserCertificate::where('id', $id)
                                    ->where('user_id', $user->id)
                                    ->first();

        $certificate->certificate_name = $req->name;
        $certificate->image_link = $req->image;
        $certificate->detail = $req->detail;
        $certificate->company = $req->company;
        $certificate->issued_date = $req->issued_date;

        $certificate->save();

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
    public function show(UserCertificate $userCertificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserCertificate $userCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserCertificate $userCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserCertificate $userCertificate)
    {
        //
    }
}
