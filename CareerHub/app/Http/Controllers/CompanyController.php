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

      Validator::make($request->all(), $rules)->validate();
  }

  public function updateCompanyProfile(Request $req)
  {
    $this->validateUpdateCompanyProfile($req);
    $updatedCompany = Company::where('id', $req->id)->first();

    $updatedCompany->name = $req->name;
    $updatedCompany->city = $req->city;
    $updatedCompany->country = $req->country;
    $updatedCompany->description = $req->description;
    $updatedCompany->save();

    return redirect('/profile');
  }

}
