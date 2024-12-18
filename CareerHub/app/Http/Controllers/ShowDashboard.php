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
    $company = Auth::user()->company;
    $jobs = $company->jobs;
    $jobs->load(['jobApplications' => function ($query) {
      $query->where('status', 'Pending')->with('user');
    }]);
    return view('dashboard.company', compact('jobs'));
  }

  private function employeeDashBoard()
  {
    $url = env('FLASK_HOST');
    $response = Http::accept('application/json')->get($url . '/get_user_recommendation', ['user_id' => Auth::user()->id]);
    $data = json_decode($response->body(), true);

    $jobs = Job::where(function ($query) use ($data) {
      foreach ($data as $id) {
        $query->orWhere('id', 'LIKE', "%$id%");
      }
    })->get();
    //    $jobs = [];
    //      dd($jobs);
    return view('dashboard', compact('jobs'));
  }
}
