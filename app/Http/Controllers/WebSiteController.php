<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
