<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShowDashboard extends Controller
{
  public function __invoke(): View
  {
    if (Auth::user()->role == 'Company') {
      return $this->companyDashBoard();
    } else if (Auth::user()->role == 'Employee') {
      return $this->employeeDashBoard();
    }
  }

  private function companyDashBoard()
  {
    $company_id = Auth::user()->company->id;
    $jobs = Job::where('company_id', $company_id)->get();
    return view('dashboard', compact('jobs'));
  }

  private function employeeDashBoard()
  {
    $url = env('FLASK_HOST');
    $response = Http::accept('application/json')->get($url . '/get_user_recommendation', ['user_id' => Auth::user()->id]);
    $data = json_decode($response->body(), true);
    $companies = Company::where(function ($query) use ($data) {
      foreach ($data as $id) {
        $query->orWhere('id', 'LIKE', "%$id%");
      }
    })->get();
    return view('dashboard', compact('companies'));
  }
}
