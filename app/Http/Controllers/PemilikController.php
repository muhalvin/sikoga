<?php

namespace App\Http\Controllers;

use App\Models\kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PemilikController extends Controller
{
    public function index()
    {
        return view('pages.pemilik.dashboard.main')->with([
            'title'     => 'Dashboard',
            'menu'      => 'Dashboard',
            'submenu'   => '',
        ]);
    }
    
    public function showKos()
    {
        $kos = DB::table('kos')
            ->get();

        return view('pages.pemilik.kos.main')->with([
            'title'     => 'KOS',
            'menu'      => 'Kos',
            'submenu'   => '',
            'kos'       => $kos,
        ]);
    }

    public function detailKos($id)
    {
        $kos = DB::table('kos')
            ->where('id', '=', $id)
            ->get();

        return view('pages.pemilik.kos.detail')->with([
            'title'     => 'KOS',
            'menu'      => 'Kos',
            'submenu'   => '',
            'kos'       => $kos,
            'id'        => $id,
        ]);
    }

    public function storeKos(Request $request)
    {
        $validates = Validator::make($request->all(), [   
            'nama_kos'      => 'required|string',
            'alamat'        => 'required|string',
            'biaya'         => 'required|numeric',
            'nomor'         => 'required|numeric',
            'ukuran'        => 'required|string',
            'penghuni'      => 'required|string',
        ],
        [
            'nama_kos.required'     => 'Kolom harus diisi!',
            'alamat.required'       => 'Kolom harus diisi!',
            'biaya.required'        => 'Kolom harus diisi!',
            'nomor.required'        => 'Kolom harus diisi!',
            'ukuran.required'       => 'Kolom harus diisi!',
            'penghuni.required'     => 'Kolom harus diisi!',
        ]);

        $errors = $validates->errors();

        if ($validates->fails()) {
            return redirect()->back()->withErrors($validates->messages())->withInput();

        } else { 
            
            $user = DB::table('kos')
                ->insert([
                    'username'      => Auth::user()->username,
                    'nama_kos'      => $request->nama_kos,
                    'alamat'        => $request->alamat,
                    'biaya'         => $request->biaya,
                    'nomor'         => $request->nomor,
                    'ukuran'        => $request->ukuran,
                    'penghuni'      => $request->penghuni,
                    'created_at'    => now(),
                ]);
            
            return redirect()->back()->with('success', 'Kos berhasil ditambahkan!');
        }
    }

    public function updateKos (Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama_kos'          => 'required|string',
            'alamat'            => 'required|string',
            'biaya'             => 'required|numeric',
            'nomor'             => 'required|numeric',
            'nomor_alt'         => 'nullable|numeric',
            'ukuran'            => 'required|string',
            'status'            => 'required|string',
            'fasilitas'         => 'nullable|string',
            'peraturan'         => 'nullable|string',
            'penghuni'          => 'required|string',
        ],
        [
            'nama_kos.required'          => 'Kolom harus diisi!',
            'alamat.required'            => 'Kolom harus diisi!',
            'biaya.required'             => 'Kolom harus diisi!',
            'nomor.required'             => 'Kolom harus diisi!',
            'ukuran.required'            => 'Kolom harus diisi!',
            'status.required'            => 'Kolom harus diisi!',
            'penghuni.required'          => 'Kolom harus diisi!',
        ]);

        $errors = $validate->errors();

        if ($validate->fails()) {
            
            return redirect()->back()->withErrors($validate->messages())->withInput();
        } else {
            
            $kos = DB::table('kos')
                ->where('id', '=', $id)
                ->update([
                    'nama_kos'          => $request->nama_kos,
                    'alamat'            => $request->alamat,
                    'biaya'             => $request->biaya,
                    'nomor'             => $request->nomor,
                    'nomor_alt'         => $request->nomor_alt,
                    'ukuran'            => $request->ukuran,
                    'status'            => $request->status,
                    'fasilitas'         => $request->fasilitas,
                    'peraturan'         => $request->peraturan,
                    'penghuni'          => $request->penghuni,
                    'updated_at'    => now(),
                ]);
    
            return redirect()->back()->with('success', 'Berhasil memperbarui data!');
        }
    }

    public function updateFotoKos(Request $request, $id)
    {
        $validates = Validator::make($request->all(), [
            'f_depan'       => 'required|mimes:png,jpg,jpeg|max:1024',
            'f_samping'     => 'required|mimes:png,jpg,jpeg|max:1024',
            'f_kamar_1'     => 'required|mimes:png,jpg,jpeg|max:1024',
            'f_kamar_2'     => 'nullable|mimes:png,jpg,jpeg|max:1024',
            'f_kamar_3'     => 'nullable|mimes:png,jpg,jpeg|max:1024',
        ],
        [
            'f_depan.required'      => 'Silahkan pilih file terlebih dulu!',
            'f_samping.required'    => 'Silahkan pilih file terlebih dulu!',
            
            'f_depan.mimes'     => 'File yang diunggah berupa Foto (jpg/jpeg/png)',
            'f_samping.mimes'   => 'File yang diunggah berupa Foto (jpg/jpeg/png)',
            'f_kamar_1.mimes'   => 'File yang diunggah berupa Foto (jpg/jpeg/png)',
            'f_kamar_2.mimes'   => 'File yang diunggah berupa Foto (jpg/jpeg/png)',
            'f_kamar_3.mimes'   => 'File yang diunggah berupa Foto (jpg/jpeg/png)',

            'f_depan.max'       => 'Ukuran Foto Maksimal 2 MB',
            'f_samping.max'     => 'Ukuran Foto Maksimal 2 MB',
            'f_kamar_1.max'     => 'Ukuran Foto Maksimal 2 MB',
            'f_kamar_2.max'     => 'Ukuran Foto Maksimal 2 MB',
            'f_kamar_3.max'     => 'Ukuran Foto Maksimal 2 MB',
        ]);

        $errors = $validates->errors();

        if ($validates->fails()) {
            return redirect()->back()->withErrors($validates->messages())->withInput();

        } else { 

            // getFile
            $file1      = $request->file('f_depan');
            $file2      = $request->file('f_samping');
            $file3      = $request->file('f_kamar_1');
            $file4      = $request->file('f_kamar_2');
            $file5      = $request->file('f_kamar_3');

            // getClientName
            if ($file1 != NULL) {
                $name1  = date('Y-m-d').('-').$file1->getClientOriginalName();
            } else {
                $name1  = '';
            }

            if ($file2 != NULL) {
                $name2  = date('Y-m-d').('-').$file2->getClientOriginalName();
            } else {
                $name2  = '';
            }

            if ($file3 != NULL) {
                $name3  = date('Y-m-d').('-').$file3->getClientOriginalName();
            } else {
                $name3  = '';
            }

            if ($file4 != NULL) {
                $name4  = date('Y-m-d').('-').$file4->getClientOriginalName();
            } else {
                $name4  = '';
            }

            if ($file5 != NULL) {
                $name5  = date('Y-m-d').('-').$file5->getClientOriginalName();
            } else {
                $name5  = '';
            }
                
            // getPath
            $path1  = 'KOS/Foto/'.$name1;                  
            $path2  = 'KOS/Foto/'.$name2;                  
            $path3  = 'KOS/Foto/'.$name3;                  
            $path4  = 'KOS/Foto/'.$name4;                  
            $path5  = 'KOS/Foto/'.$name5;                  
            

            if ($file1 != NULL) {
                Storage::disk('public')->put($path1, file_get_contents($file1));
            }

            if ($file2 != NULL) {
                Storage::disk('public')->put($path2, file_get_contents($file2));
            }

            if ($file3 != NULL) {
                Storage::disk('public')->put($path3, file_get_contents($file3));
            }

            if ($file4 != NULL) {
                Storage::disk('public')->put($path4, file_get_contents($file4));
            }

            if ($file5 != NULL) {
                Storage::disk('public')->put($path5, file_get_contents($file5));
            }
            
        }
        
        $user = DB::table('kos')
            ->where('id', '=', $id)
            ->update([
                'f_depan'       => $name1,
                'f_samping'     => $name2,
                'f_kamar_1'     => $name3,
                'f_kamar_2'     => $name4,
                'f_kamar_3'     => $name5,
                'updated_at'    => now(),
            ]);

        return redirect()->back()->with('success', 'Foto berhasil diunggah!');
    }

    public function showVerifikasi()
    {
        $list = DB::table('pendaftarans')
            ->select('users.nama', 'pendaftarans.id', 'pendaftarans.surat_ket', 'pendaftarans.verifikasi', 'pendaftarans.created_at')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->where('pendaftarans.verifikasi', '=', 2)
            ->get();

        $riwayat = DB::table('pendaftarans')
            ->select('users.nama', 'pendaftarans.id', 'pendaftarans.surat_ket', 'pendaftarans.verifikasi', 'pendaftarans.created_at')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->where('pendaftarans.verifikasi', '=', 3)
            ->orWhere('pendaftarans.verifikasi', '=', 4)
            ->orderByDesc('pendaftarans.id')
            ->get();

        return view('pages.pemilik.pendaftaran.verifikasi.main')->with([
            'title'         => 'Verifikasi',
            'menu'          => 'Pendaftaran',
            'submenu'       => 'Verifikasi',
            'pendaftaran'   => $list,
            'riwayat'       => $riwayat,
        ]);
    }

    public function updateVerifikasi(Request $request, $id)
    {
        $pendaftaran = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->update([
                'verifikasi'    => 3,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('success', 'Data telah diperbarui!');
    }

    public function tolakVerifikasi(Request $request, $id)
    {
        $pendaftaran = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->update([
                'verifikasi'    => 4,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('success', 'Data telah diperbarui!');
    }

    public function showPembayaran()
    {
        $pendaftaran = DB::table('pendaftarans')
            ->select('pendaftarans.id', 'pendaftarans.updated_at', 'pendaftarans.bukti_bayar', 'pendaftarans.status_bayar', 'users.nama')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->where('pendaftarans.status_bayar', '=', 2)
            ->get();

        $selesai = DB::table('pendaftarans')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->where('pendaftarans.status_bayar', '=', 3)
            ->orderByDesc('pendaftarans.id')
            ->get();

        return view('pages.pemilik.pendaftaran.pembayaran.main')->with([
            'title'     => 'Pembayaran',
            'menu'      => 'Pendaftaran',
            'submenu'   => 'Pembayaran',
            'daftar'    => $pendaftaran,
            'riwayat'   => $selesai,
        ]);
    }

    public function accPembayaran($id)
    {
        $pendaftaran = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->update([
                'status_bayar'  => 3,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('success', 'Pembayaran diverifikasi!');
    }

    public function tolakPembayaran($id)
    {
        $pendaftaran = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->update([
                'status_bayar'  => NULL,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('success', 'Pembayaran ditolak!');
    }

    public function showTagihan()
    {
        $now = DB::table('tagihans')
            ->select('users.nama', 'users.username', 'tagihans.id', 'tagihans.created_at', 'tagihans.bukti_bayar', 'tagihans.status')
            ->join('users', 'users.username', '=', 'tagihans.username')
            ->join('kos', 'kos.id', '=', 'tagihans.id_kos')
            ->join('pendaftarans', 'pendaftarans.id_kos', '=', 'tagihans.id_kos')
            ->where('tagihans.status', '=', 1)
            ->where('kos.username', '=', Auth::user()->username)
            ->get();

        $done = DB::table('tagihans')
            ->select('users.nama', 'users.username', 'tagihans.id', 'tagihans.created_at', 'tagihans.bukti_bayar', 'tagihans.status')
            ->join('users', 'users.username', '=', 'tagihans.username')
            ->join('kos', 'kos.id', '=', 'tagihans.id_kos')
            ->join('pendaftarans', 'pendaftarans.id_kos', '=', 'tagihans.id_kos')
            ->where('tagihans.status', '!=', 1)
            ->where('kos.username', '=', Auth::user()->username)
            ->orderByDesc('tagihans.id')
            ->get();

        return view('pages.pemilik.tagihan.main')->with([
            'title'     => 'Tagihan',
            'menu'      => 'Tagihan',
            'submenu'   => '',
            'tagihan'   => $now,
            'riwayat'   => $done,
        ]);
    }

    public function accTagihan ($id)
    {
        $pendaftaran = DB::table('tagihans')
            ->where('id', '=', $id)
            ->update([
                'status'        => 2,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('success', 'Pembayaran diverifikasi!');
    }

    public function tolakTagihan ($id)
    {
        $pendaftaran = DB::table('tagihans')
            ->where('id', '=', $id)
            ->update([
                'status'        => 3,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('success', 'Pembayaran ditolak!');
    }
}