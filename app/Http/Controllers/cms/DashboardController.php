<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  // Dashboard - Analytics
  public function dashboard()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('cms.dashboard', ['pageConfigs' => $pageConfigs]);
  }
}
