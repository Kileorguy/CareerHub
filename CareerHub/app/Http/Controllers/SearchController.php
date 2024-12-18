<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    $query = $request->input('query');

    $allCompanies = Company::with('user')->where('name', 'like', '%' . $query . '%')->get();
    $allJobs = Job::with('company.user')->where('job_name', 'like', '%' . $query . '%')->get();

    $companies = $allCompanies->take(3);
    $jobs = $allJobs->take(3);

    $moreCompanies = $allCompanies->count() > 3;
    $moreJobs = $allJobs->count() > 3;

    return view('search.index', compact('companies', 'jobs', 'moreCompanies', 'moreJobs'));
  }
}
