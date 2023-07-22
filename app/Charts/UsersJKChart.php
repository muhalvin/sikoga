<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersJKChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $lk = DB::table('users as a')->join('pendaftarans as b','b.username', '=', 'a.username')
        ->join('kos as c', 'c.id', '=', 'b.id_kos')->join('users as d', 'd.username', '=', 'c.username')
        ->where('b.status_bayar', '=', '2')->where('a.role', '=', 'Anak Kos')->where('a.jk', '=', 'L')
        ->where('d.username', '=', Auth::user()->username)->get();
        
        $pr = DB::table('users as a')->join('pendaftarans as b','b.username', '=', 'a.username')
        ->join('kos as c', 'c.id', '=', 'b.id_kos')->join('users as d', 'd.username', '=', 'c.username')
        ->where('b.status_bayar', '=', '2')->where('a.role', '=', 'Anak Kos')->where('a.jk', '=', 'P')
        ->where('d.username', '=', Auth::user()->username)->get();
        
        $data = [
            $lk->count(),
            $pr->count(),
        ];

        $label = [
            'Laki - laki',
            'Perempuan',
        ];
        
        return $this->chart->donutChart()
            ->setTitle('Gender Penghuni')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setLabels($label);
    }
}