<?php

namespace App\Http\Controllers;

use App\Models\kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'title'     => 'Kos',
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
            'title'     => 'Kos',
            'menu'      => 'Kos',
            'submenu'   => '',
            'kos'       => $kos,
        ]);
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
        return view('pages.pemilik.pendaftaran.pembayaran.main')->with([
            'title'     => 'Pembayaran',
            'menu'      => 'Pendaftaran',
            'submenu'   => 'Pembayaran',
        ]);
    }
}