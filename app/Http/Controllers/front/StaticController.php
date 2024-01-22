<?php

namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticController extends Controller
{

  public function index()
  {
    $pageId = 'page-home';

    return view('/front/pages/index', ['pageId' => $pageId ]);
  }

  public function contact()
  {
    $pageId = 'page-contacto';

    return view('/front/pages/contacto', ['pageId' => $pageId ]);
  }

}
