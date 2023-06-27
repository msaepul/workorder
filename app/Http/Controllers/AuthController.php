<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Departemen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        $departemen = Departemen::all();
        $cabang = Cabang::all();
        return view('register', compact('departemen', 'cabang'));
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);



        //login valid?

        if (Auth::attempt($credentials)) {

            $user = auth()->user();
            session(['cabang'=> $user->cabang],['dept'=>$user->dept],['id'=>$user->id]);
            return redirect('/Dashboard');

           

            // return redirect()->intended('dashboard');


        }
        return back()->withErrors('password')->with('failed', 'Email atau Password Salah !!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registerProses(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'username' => 'required|email|max:255|unique:users',
            'password' => 'required|max:255',
            'cabang_id' => 'required',
            'departemen_id' => 'required'

        ]);

        $request['password'] = Hash::make($request->password);

        $user = User::create($request->all());

        session()->flash('status', 'Data berhasil ditambahkan, Silahkan Login!');
        return redirect('/login');
    }
}
