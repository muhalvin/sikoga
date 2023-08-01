<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class GenderpenghuniChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $L = User::where('role', '=', 'Anak Kos')->join('pendaftarans', 'pendaftarans.username', '=', 'users.username')->where('pendaftarans.status_bayar', '=', '2')->where('users.jk', '=', 'L')->get();

        $P = User::where('role', '=', 'Anak Kos')->join('pendaftarans', 'pendaftarans.username', '=', 'users.username')->where('pendaftarans.status_bayar', '=', '2')->where('users.jk', '=', 'P')->get();

        $data = [
            $laki = $L->count(),
            $perempaun = $P->count(),
        ];

        $label = [
            'Laki - laki',
            'Perempuan'
        ];

        return $this->chart->donutChart()
            ->setTitle('Gender Penghuni')
            ->setSubtitle('Total')
            ->addData($data)
            ->setLabels($label);
    }
}
