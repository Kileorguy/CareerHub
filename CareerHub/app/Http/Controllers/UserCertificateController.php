<?php

namespace App\Http\Controllers;

use App\Models\UserCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserCertificateController extends Controller
{

    public function create(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'name' => 'required',
            'image' => 'required',
            'detail' => 'required',
            'company' => 'required',
            'issued_date' => 'required',
        ]);
        UserCertificate::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'certificate_name' => $req->name,
            'image_link' => $req->image,
            'detail' => $req->detail,
            'company' => $req->company,
            'issued_date' => $req->issued_date,
        ]);

        return redirect('/profile');
    }

    public function update(Request $req, $id)
    {
        $user = Auth::user();
        $req->validate([
            'name' => 'required',
            'image' => 'required',
            'detail' => 'required',
            'company' => 'required',
            'issued_date' => 'required',
        ]);
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

    public function delete(Request $req, $id)
    {
        $user = Auth::user();

        $certificate = UserCertificate::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ($certificate) {
            $certificate->delete();
        }

        return redirect('/profile');
    }
}
