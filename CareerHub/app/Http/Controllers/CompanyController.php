<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
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

  public function moreCompanies(Request $request)
  {
    $query = $request->input('query');
    $companies = Company::with('user')
      ->where('name', 'like', '%' . $query . '%')
      ->paginate(5)
      ->appends(['query' => $query]);

    return view('company.index', compact('companies'));
  }

  public function update(Request $req)
  {
    $validationErrors = $this->validateUpdateCompanyProfile($req);
    if ($validationErrors) {
      return redirect()->back()
        ->with('message-title', 'Update Company failed')
        ->with('message', $validationErrors->first())
        ->withInput();
    }
    $updatedCompany = Company::where('id', $req->id)->first();
    $updatedCompany->update([
      'name' => $req->name,
      'city' => $req->city,
      'country' => $req->country,
      'description' => $req->description,
    ]);
    return redirect('/profile')
      ->with('message-title', 'Update Company success')
      ->with('message', 'Company profile updated successfully!');
  }

  public function show(Company $company)
  {
    if (Auth::user()->company && $company->id == Auth::user()->company->id) {
      return redirect()->action([AuthorizedUserController::class, 'profile']);
    }

    $jobs = $company->jobs()->paginate(3);

    return view('company.detail', compact('company', 'jobs'));
  }
}
