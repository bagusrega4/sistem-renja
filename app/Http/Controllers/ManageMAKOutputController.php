<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageMAKOutputController extends Controller
{
    public function index()
    {
        return view('manage.mak.output.index',);
    }
}
