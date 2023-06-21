<?php

namespace App\Http\Controllers;

use App\Models\kos;
use App\Models\pendaftaran;
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
        $sql = DB::table('kos')
            ->where('status', '=', 'Tersedia')
            ->get();

        return view('pages.user.dashboard.main')->with([
            'title'     => 'Dashboard',
            'menu'      => 'Dashboard',
            'submenu'   => '',
            'list'      => $sql,
        ]);
    }

    public function showKos($id)
    {
        $sql = DB::table('kos')
            ->join('users', 'users.username', '=', 'kos.username')
            ->where('kos.status', '=', 'Tersedia')
            ->where('kos.id', '=', $id)
            ->get();

        return view('pages.user.dashboard.more')->with([
            'title'     => 'Dashboard',
            'menu'      => 'Dashboard',
            'submenu'   => '',
            'kos'       => $sql,
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

        $verify = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->orderBy('id', 'DESC')
            ->first();
        
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
            'verify'        => $verify,  
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

        $kos = DB::table('kos')
            ->get();

        $sql = DB::table('kos')
            ->where('status', '=', 'Tersedia')
            ->get();   
            
        $kos_terdaftar = DB::table('kos')
            ->join('pendaftarans', 'pendaftarans.id_kos', '=', 'kos.id')
            ->where('pendaftarans.username', '=', Auth::user()->username)
            ->get();

        $verif = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->where('verifikasi', '=', 3)
            ->where('id_kos', '=', NULL)
            ->where('status_bayar', '=', NULL)
            ->first();

        $verify = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->where('verifikasi', '=', 3)
            ->where('id_kos', '!=', NULL)
            ->where('status_bayar', '=', NULL)
            ->orWhere('status_bayar', '=', 1)
            ->first();

        $verified = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->where('verifikasi', '=', 3)
            ->where('status_bayar', '=', 2)
            ->first();

        $tolak = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->where('verifikasi', '=', 3)
            ->where('status_bayar', '=', 3)
            ->first();

        $pendaftaran = DB::table('pendaftarans')
            ->select('pendaftarans.bukti_bayar', 'kos.nama_kos', 'users.nama', 'pendaftarans.status_bayar')
            ->join('kos', 'kos.id', '=', 'pendaftarans.id_kos')
            ->join('users', 'users.username', '=', 'kos.username')
            ->where('pendaftarans.username', '=', Auth::user()->username)
            ->get();    

        return view('pages.user.pendaftaran.pembayaran.main')->with([
            'title'     => 'Pembayaran',
            'menu'      => 'Pendaftaran',
            'submenu'   => 'Pembayaran',
            'kos'       => $kos, 
            'verif'     => $verif,  
            'verify'    => $verified,  
            'tolak'     => $tolak,  
            'verifikasi'=> $verify,  
            'daftar'    => $pendaftaran,
            'list'      => $sql,  
            'kos_in'    => $kos_terdaftar,  
        ]);
    }

    public function storePembayaran(Request $request)
    {
        $validates = Validator::make($request->all(), [
            'kos_id'            => 'required|numeric',
            'bukti_bayar'       => 'required|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            'kos_id.required'       => 'Kolom harus diisi!',
            'bukti_bayar.required'  => 'Kolom harus diisi!',
            
            'bukti_bayar.max'       => 'Ukuran Maksimal 2 MB',
        ]);

        $errors = $validates->errors();

        if ($validates->fails()) {
            return redirect()->back()->withErrors($validates->messages())->withInput();

        } else { 

            $file   = $request->file('bukti_bayar');
            
            $name   = date('Y-m-d').('-').$file->getClientOriginalName();
            
            $path   = 'Pembayaran/'.$name;                   

            Storage::disk('public')->put($path, file_get_contents($file));
        
        
        $user = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->update([
                'id_kos'        => $request->kos_id,
                'bukti_bayar'   => $name,
                'status_bayar'  => NULL,
                'updated_at'    => now(),
            ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil diunggah!');
        }
    }

    public function showTagihan()
    {
        $riwayat = DB::table('tagihans')
            ->where('username', '=', Auth::user()->username)
            ->orderBy('id', 'DESC')
            ->get();

        $biaya = DB::table('pendaftarans')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->join('kos', 'kos.id', '=', 'pendaftarans.id_kos')
            ->where('users.username', '=', Auth::user()->username)
            ->first();

        $kos = DB::table('pendaftarans')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->where('users.username', '=', Auth::user()->username)
            ->first();   
            
        $pendaftaran = DB::table('pendaftarans')
            ->where('username', '=', Auth::user()->username)
            ->where('status_bayar', '=', '2')
            ->first();

        if ($pendaftaran) {
            return view('pages.user.tagihan.main')->with([
                'title'     => 'Tagihan',
                'menu'      => 'Tagihan',
                'submenu'   => '',
                'biaya'     => $biaya->biaya,
                'riwayat'   => $riwayat,
                'kos'       => $kos->id_kos,
            ]);
        } else {
            return view('errors.403');
        } 
    }

    public function storeTagihan(Request $request)
    {
        $validates = Validator::make($request->all(), [
            'id_kos'            => 'required|numeric',
            'tanggal_bayar'     => 'required|string',
            'total_bayar'       => 'required|string',
            'bukti_bayar'       => 'required|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            'id_kos.required'       => 'Kolom harus diisi!',
            'tanggal_bayar.required'=> 'Kolom harus diisi!',
            'total_bayar.required'  => 'Kolom harus diisi!',
            'bukti_bayar.required'  => 'Kolom harus diisi!',
            
            'bukti_bayar.max'       => 'Ukuran Maksimal 2 MB',
        ]);

        $errors = $validates->errors();

        if ($validates->fails()) {
            return redirect()->back()->withErrors($validates->messages())->withInput();

        } else { 

            $file   = $request->file('bukti_bayar');
            
            $name   = date('Y-m-d').('-').$file->getClientOriginalName();
            
            $path   = 'Tagihan/KOS/'.$name;                   

            Storage::disk('public')->put($path, file_get_contents($file));
        
        
        $user = DB::table('tagihans')
            ->insert([
                'username'      => Auth::user()->username,
                'id_kos'        => $request->id_kos,
                'tanggal_bayar' => $request->tanggal_bayar,
                'total_bayar'   => $request->total_bayar,
                'bukti_bayar'   => $name,
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

        return redirect()->back()->with('success', 'Anda Telah Membayar Tagihan Bulan Ini!');
        }
    }

    public function showInvoice($id)
    {
        $sql = DB::table('tagihans')
            ->select('users.nama', 'users.alamat', 'users.no_hp', 'tagihans.id', 'tagihans.tanggal_bayar', 'tagihans.status', 'kos.nama_kos', 'kos.alamat as alamat_kos', 'kos.nomor', 'tagihans.total_bayar')
            ->join('kos', 'kos.id', '=', 'tagihans.id_kos')
            ->join('users', 'users.username', '=', 'tagihans.username')
            ->where('tagihans.id', '=', $id)
            ->get();

        return view('pages.user.tagihan.invoice')->with([
            'title'     => 'Invoice',
            'invoice'   => $sql,
        ]);
    }
}