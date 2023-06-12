<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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