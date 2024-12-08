<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyJob;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    $query = $request->input('query');

    $companies = Company::where('name', 'like', '%' . $query . '%')->get();
    // $jobs = CompanyJob::where('job_name', '%' . $query . '%')->get() ;

    $jobs = null;

    return view('search.index', compact('companies', 'jobs'));
  }
}
