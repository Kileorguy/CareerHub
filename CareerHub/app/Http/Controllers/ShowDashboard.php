<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShowDashboard extends Controller
{
  public function __invoke(): View
  {
    //TODO: fetch applied employee from DB
    return view('dashboard.index');
  }
}
