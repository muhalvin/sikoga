<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user.dashboard.main')->with([
            'title'     => 'Dashboard',
            'menu'      => 'Dashboard',
            'submenu'   => '',
        ]);
    }

    public function showProfile()
    {
        $user = DB::table('users')
            ->where('username', '=', Auth::user()->username)
            ->get();
                
        return view('pages.user.profile.main')->with([
            'title'     => 'Profile',
            'menu'      => 'Profile',
            'submenu'   => '', 
            'user'      => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama'          => 'required|string',
            'jk'            => 'required|string',
            'tgl_lahir'     => 'required|date',
            'alamat'        => 'required|string',
            'no_hp'         => 'required|numeric',
            'kota_asal'     => 'required|string',
        ],
        [
            'nama.required'         => 'Kolom harus diisi!',
            'jk.required'           => 'Kolom harus diisi!',
            'tgl_lahir.required'    => 'Kolom harus diisi!',
            'no_hp.required'        => 'Kolom harus diisi!',
            'kota_asal.required'    => 'Kolom harus diisi!',
            'alamat.required'       => 'Kolom harus diisi!',
        ]);

        $errors = $validate->errors();

        if ($validate->fails()) {
            
            return redirect()->back()->withErrors($validate->messages())->withInput();
        } else {
            
            $user = DB::table('users')
                ->where('username', '=', Auth::user()->username)
                ->update([
                    'nama'          => $request->nama,
                    'jk'            => $request->jk,
                    'tgl_lahir'     => $request->tgl_lahir,
                    'alamat'        => $request->alamat,
                    'no_hp'         => $request->no_hp,
                    'kota_asal'     => $request->kota_asal,
                    'updated_at'    => now(),
                ]);
    
            return redirect()->back()->with('success', 'Profile anda telah diperbarui!');
        }
    }

    public function updateFoto(Request $request)
    {
        $validates = Validator::make($request->all(), [
            'foto'          => 'required|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            'foto.required' => 'Silahkan pilih file terlebih dulu!',
            
            'foto.max'      => 'Ukuran Foto Maksimal 2 MB',
        ]);

        $errors = $validates->errors();

        if ($validates->fails()) {
            return redirect()->back()->withErrors($validates->messages())->withInput();

        } else { 

            $foto           = $request->file('foto');

            if ($foto == NULL) {
                $fileFoto   = '';
            } else {
                $fileFoto   = date('Y-m-d').$foto->getClientOriginalName();
            }

            $foto_path      = 'profiles/pict/'.$fileFoto;                   
            
            if ($foto != NULL) {
                Storage::disk('public')->put($foto_path, file_get_contents($foto));
            }
            
        }
        
        $user = DB::table('users')
            ->where('username', '=', Auth::user()->username)
            ->update([
                'foto'          => $fileFoto,
                'updated_at'    => now(),
            ]);

        return redirect()->back()->with('success', 'Profile anda telah diperbarui!');
    }

    public function showVerifikasi()
    {
        $username = Auth::user()->username;
        
        $pendaftaran = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->orderBy('id', 'DESC')
            ->get();
            
        return view('pages.user.pendaftaran.verifikasi.main')->with([
            'title'         => 'Verifikasi',
            'menu'          => 'Pendaftaran',
            'submenu'       => 'Verifikasi',
            'username'      => $username, 
            'pendaftaran'   => $pendaftaran,  
        ]);
    }

    public function createVerifikasi(Request $request)
    {
        $validates = Validator::make($request->all(), [
            'username'          => 'required|string',   
            'surat_ket'         => 'required|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            'username'          => 'Username anda kosong, silahkan reload halaman!',
            'surat_ket.required'=> 'Silahkan pilih file terlebih dulu!',
            
            'surat_ket.max'     => 'Ukuran Maksimal 2 MB',
        ]);

        $errors = $validates->errors();

        if ($validates->fails()) {
            return redirect()->back()->withErrors($validates->messages())->withInput();

        } else { 

            $surat_ket          = $request->file('surat_ket');

            if ($surat_ket == NULL) {
                $fileSurat      = '';
            } else {
                $fileSurat      = date('Y-m-d').$surat_ket->getClientOriginalName();
            }

            $surat_ket_path     = 'Pendaftaran/SRT/'.$fileSurat;                   
            
            if ($surat_ket != NULL) {
                Storage::disk('public')->put($surat_ket_path, file_get_contents($surat_ket));
            }
            
        }
        
        $user = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->insert([
                'username'      => $request->username,
                'surat_ket'     => $fileSurat,
                'verifikasi'    => 1,
                'created_at'    => now(),
            ]);

        return redirect()->back()->with('success', 'Pendaftaran diri telah dikirim!');
    }

    public function updateVerifikasi(Request $request, $id)
    {
        $validates = Validator::make($request->all(), [
            'username'          => 'required|string',   
            'surat_ket'         => 'required|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            'username'          => 'Username anda kosong, silahkan reload halaman!',
            'surat_ket.required'=> 'Silahkan pilih file terlebih dulu!',
            
            'surat_ket.max'     => 'Ukuran Maksimal 2 MB',
        ]);

        $errors = $validates->errors();

        if ($validates->fails()) {
            return redirect()->back()->withErrors($validates->messages())->withInput();

        } else { 

            $surat_ket          = $request->file('surat_ket');

            if ($surat_ket == NULL) {
                $fileSurat      = '';
            } else {
                $fileSurat      = date('Y-m-d').$surat_ket->getClientOriginalName();
            }

            $surat_ket_path     = 'Pendaftaran/SRT/'.$fileSurat;                   
            
            if ($surat_ket != NULL) {
                Storage::disk('public')->put($surat_ket_path, file_get_contents($surat_ket));
            }   
        }
        
        $user = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->update([
                'username'      => $request->username,
                'surat_ket'     => $fileSurat,
                'verifikasi'    => 1,
                'updated_at'    => now(),
            ]);

        return redirect()->back()->with('success', 'Data telah diperbarui!');
    }

    public function showPembayaran()
    {
        return view('pages.user.pendaftaran.pembayaran.main')->with([
            'title'     => 'Pembayaran',
            'menu'      => 'Pendaftaran',
            'submenu'   => 'Pembayaran',   
        ]);
    }
}