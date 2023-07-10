<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register')->with(['title' => 'Register']);
    }

    public function create(Request $request)
    {
       
        $rules = [
            'username'          => 'required|string|lowercase|max:15',
            'nama'              => 'required|string|max:50',
            'password'          => [
                'required',
                'string',
                Password::min(7)
            ],
            'password-confirm'  => 'required|same:password|string'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->messages())->withInput();
        } else { 
            User::create([
                'username'          => $request->username,
                'nama'              => $request->nama,
                'role'              => 'Anak Kos',
                'password'          => Hash::make($request->password),
                'created_at'        => now(),
            ]);

            return redirect()->route('login')->with('success', 'Registrasi akun berhasil');
        }
    }
}