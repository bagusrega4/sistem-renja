<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageMAKKomponenController extends Controller
{
    public function index()
    {
        return view('manage.mak.komponen.index',);
    }
}
