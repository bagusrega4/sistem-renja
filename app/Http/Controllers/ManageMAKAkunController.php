<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageMAKAkunController extends Controller
{
    public function index()
    {
        return view('manage.mak.akun.index',);
    }
}
