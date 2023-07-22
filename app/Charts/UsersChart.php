<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $users = DB::table('users as a')->join('pendaftarans as b','b.username', '=', 'a.username')
        ->join('kos as c', 'c.id', '=', 'b.id_kos')->join('users as d', 'd.username', '=', 'c.username')
        ->where('b.verifikasi', '=', '3')->where('b.status_bayar', '=', '2')
        ->where('c.username', '=', Auth::user()->username)->get();
        
        $data = [
            $users->count(),
        ];

        $label = [
            'Penghuni',
        ];
        
        return $this->chart->donutChart()
            ->setTitle('Jumlah Penghuni Kos')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setLabels($label);
    }
}