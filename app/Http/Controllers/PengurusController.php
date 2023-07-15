<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengurusController extends Controller
{
    public function showNotify()
    {
        $notif = pendaftaran::where('verifikasi', '=', '1')
            ->count();
        
        return json_encode($notif);
    }

    public function showPaymentNotify()
    {
        $notif = pendaftaran::where('bukti_bayar', '!=', NULL)
            ->where('status_bayar', '=', NULL)
            ->count();
        
        return json_encode($notif);
    }

    public function index()
    {
        $jml_user = User::where('role', '=', 'Anak Kos')
            ->get();
        
        $jml_pengurus = User::where('role', '=', 'Pengurus')
            ->get();

        $penghuni = pendaftaran::join('kos', 'kos.id', '=', 'pendaftarans.id_kos')
            ->join('users', 'users.username', '=', 'kos.username')
            ->where('pendaftarans.status_bayar', '=', 2)
            ->get();    

        $sql = DB::table('pendaftarans')->where('status_bayar', '=', NULL)->orWhere('status_bayar', '=', '1')->get();

        return view('pages.pengurus.dashboard.main')->with([
            'title'         => 'Dashboard',
            'menu'          => 'Dashboard',
            'submenu'       => '',
            'jml_user'      => $jml_user,
            'jml_pengurus'  => $jml_pengurus,
            'penghuni'      => $penghuni,
            'pendaftar'     => $sql,
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
            
        return redirect()->back()->with('success', 'Pendaftaran Disetujui!');
    }

    public function tolakVerifikasi(Request $request, $id)
    {
        $pendaftaran = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->update([
                'verifikasi'    => 4,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('failed', 'Pendaftaran Ditolak!');
    }

    public function deleteVerifikasi(Request $request, $id)
    {
        $pendaftaran = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->delete();
            
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function showPembayaran()
    {
        $pendaftaran = DB::table('pendaftarans')
            ->select('pendaftarans.id', 'pendaftarans.updated_at', 'pendaftarans.bukti_bayar', 'pendaftarans.status_bayar', 'users.nama', 'kos.nama_kos')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->join('kos', 'kos.id', '=', 'pendaftarans.id_kos')
            ->where('pendaftarans.bukti_bayar', '!=', NULL)
            ->where('pendaftarans.status_bayar', '=', NULL)
            ->get();

        $selesai = DB::table('pendaftarans')
            ->join('users', 'users.username', '=', 'pendaftarans.username')
            ->join('kos', 'kos.id', '=', 'pendaftarans.id_kos')
            ->where('pendaftarans.status_bayar', '!=', NULL)
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
                'status_bayar'  => 1,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('success', 'Pembayaran Diterima!');
    }

    public function tolakPembayaran($id)
    {
        $pendaftaran = DB::table('pendaftarans')
            ->where('id', '=', $id)
            ->update([
                'status_bayar'  => 3,
                'updated_at'    => now(),
            ]);
            
        return redirect()->back()->with('failed', 'Pembayaran ditolak!');
    }
}