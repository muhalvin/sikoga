<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        return view('pages.pemilik.dashboard.main')->with([
            'title'     => 'Dashboard'
        ]);
    }
}