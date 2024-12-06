<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringKeuanganController extends Controller
{
    public function index()
    {
        return view('monitoring.keuangan.index',);
    }
}
