<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengurusController extends Controller
{
    public function index()
    {
        return view('pages.pengurus.dashboard.main')->with([
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
            ->where('pendaftarans.verifikasi', '=', 1)
            ->get();

        $riwayat = DB::table('pendaftarans')
            ->select('users.nama', 'pendaftarans.id', 'pendaftarans.surat_ket', 'pendaftarans.verifikasi', 'pendaftarans.created_at')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->where('pendaftarans.verifikasi', '!=', 1)
            ->orderByDesc('pendaftarans.id')
            ->get();

        return view('pages.pengurus.pendaftaran.verifikasi.main')->with([
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
                'verifikasi'    => 2,
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
            ->where('pendaftarans.status_bayar', '=', 1)
            ->get();

        $selesai = DB::table('pendaftarans')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->where('pendaftarans.status_bayar', '!=', 1)
            ->orderByDesc('pendaftarans.id')
            ->get();

        return view('pages.pengurus.pendaftaran.pembayaran.main')->with([
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
                'status_bayar'  => 2,
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
}