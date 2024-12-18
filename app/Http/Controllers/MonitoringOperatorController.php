<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPengajuan;

class MonitoringOperatorController extends Controller
{
    public function index()
    {
        $formPengajuan = FormPengajuan::get();
        return view('monitoring.operator.index', compact('formPengajuan'));
    
    }
    
}
