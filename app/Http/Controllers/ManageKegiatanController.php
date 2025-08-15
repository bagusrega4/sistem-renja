<?php

namespace App\Http\Controllers;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class ManageKegiatanController extends Controller
{
    public function index()
    {
        $kegiatanList = Kegiatan::all();
        return view('manage.kegiatan.index');
    }
}
