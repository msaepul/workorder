<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $UserCount = User::count();
        return view('Admin.dashboard', ['jumlah_user' => $UserCount]);
    }

    public function Gallery()
    {
        $UserCount = User::count();
        return view('Admin.gallery');
    }

    public function profile()
    {
        // $UserCount = User::count();
        return view('Admin.profile');
    }
}
