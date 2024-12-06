<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageFormController extends Controller
{
    public function index()
    {
        return view('manage.form.index',);
    }
}
