<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShowDashboard extends Controller
{
  public function __invoke(): View
  {
    if (Auth::user()->role == 'Company') {
      $jobs = call_user_func(
        [JobController::class, 'getJobById'],
        Auth::user()->company_id,
        ['job_skills', 'company', 'company_user']
    );
      return view('dashboard.index', compact('jobs'));
    } else if (Auth::user()->role == 'Employee') {
        $url = env('FLASK_HOST');
        $response = Http::accept('application/json')->get($url.'/get_user_recommendation', ['user_id'=>Auth::user()->id]);
        $data = json_decode($response->body(), true);

        dd($data);

        $companies = Company::where(function ($query) use ($data) {
            foreach ($data as $id) {
                $query->orWhere('id', 'LIKE', "%$id%");
            }
        })->get();
        return view('home.index', ['companies' => $companies]);
    }
  }
}
