<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
       return view('Cabang.dashboard');
    }
}
