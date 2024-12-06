<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShowDashboard extends Controller
{
  public function __invoke(): View
  {
    if (Auth::user()->role == 'Company') {
      //TODO: fetch applied employee from DB
      return view('dashboard.index');
    } else if (Auth::user()->role == 'Employee') {
      $url = env('FLASK_HOST');
      $response = Http::accept('application/json')->get($url . '/get_user_recommendation', ['user_id' => Auth::user()->id]);
      $data = json_decode($response->body(), true);

      $companies = Company::where(function ($query) use ($data) {
        // foreach ($data as $id) {
        //   $query->orWhere('id', 'LIKE', "%$id%");
        // }
      })->get();

      return view('home.index', ['companies' => $companies]);
    }
  }
}
