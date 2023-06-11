<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username'          => 'required',
            'password'          => 'required',
        ],[
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        $data = [
            'username'          => $request->username,
            'password'          => $request->password,
        ];

        if (Auth::attempt($data)){
            if (Auth::user()->role == 'Pemilik') {

                $user = Auth::user();
                Session::put('id', $user->id);
                Session::put('username', $user->username);
                Session::put('nama', $user->nama);
                Session::put('role', $user->role);
                
                return redirect()->route('pemilik/dashboard')->with('success', 'Login Berhasil');

            } elseif (Auth::user()->role == 'Pengurus') {

                $user = Auth::user();
                Session::put('id', $user->id);
                Session::put('username', $user->username);
                Session::put('nama', $user->nama);
                Session::put('role', $user->role);
                
                return redirect()->route('pengurus/dashboard')->with('success', 'Anda berhasil login');
            
            } elseif (Auth::user()->role == 'Anak Kos') {

                $user = Auth::user();
                Session::put('id', $user->id);
                Session::put('username', $user->username);
                Session::put('nama', $user->nama);
                Session::put('role', $user->role);
                
                return redirect()->route('dashboard')->with('success', 'Anda berhasil login');
                
            } else {
                return redirect()->route('login')->with('failed', 'Kamu tidak memiliki akses!');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Username Atau Password Yang Anda Masukkan Salah!');
        }
    }

    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil Logout');
    }
}