<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSiteController extends Controller
{
    public function index()
    {
        return view('webpages.index');
    }
    public function digitalPrint()
    {
        return view('webpages.digital-offset-printing');
    }
}
