<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function getAllCompanies()
    {
        $companies = Company::all();
        return view('home.index', ['companies' => $companies]);
    }

    private function validateUpdateCompanyProfile(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return null;
    }

    public function updateCompanyProfile(Request $req)
    {
        $validationErrors = $this->validateUpdateCompanyProfile($req);

        if ($validationErrors) {
            return redirect()->back()
                ->with('message-title', 'Update Company failed')
                ->with('message', $validationErrors->first())
                ->withInput();
        }

        $updatedCompany = Company::where('id', $req->id)->first();

        $updatedCompany->name = $req->name;
        $updatedCompany->city = $req->city;
        $updatedCompany->country = $req->country;
        $updatedCompany->description = $req->description;
        $updatedCompany->save();

        return redirect('/profile')
            ->with('message-title', 'Update Company success')
            ->with('message', 'Company profile updated successfully!');
    }
}
