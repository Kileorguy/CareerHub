<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowDashboard extends Controller
{
  public function __invoke(): View
  {
    if (Auth::user()->role == 'Company') {
      //TODO: fetch applied employee from DB
      return view('dashboard.index');
    } else if (Auth::user()->role == 'Employee') {
      $companies = Company::all();
      return view('home.index', ['companies' => $companies]);
    }
  }
}
