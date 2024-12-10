<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringOperatorController extends Controller
{
    public function index()
    {
        return view('monitoring.operator.index',);
    }
}
