<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class UsersPengurusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $users = DB::table('users as a')->join('pendaftarans as b', 'b.username', '=', 'a.username')
            ->where('b.verifikasi', '=', '3')->where('b.status_bayar', '=', '2')->get();

        $pemilik = DB::table('users as a')->where('role', '=', 'Pemilik')->get();

        $pengurus = DB::table('users as a')->where('role', '=', 'Pengurus')->get();

        $data = [
            $users->count(),
            $pemilik->count(),
            $pengurus->count(),
        ];

        $label = [
            'Penghuni',
            'Pemilik',
            'Pengurus',
        ];

        return $this->chart->pieChart()
            ->setTitle('Jumlah User Terdaftar')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setLabels($label);
    }
}
