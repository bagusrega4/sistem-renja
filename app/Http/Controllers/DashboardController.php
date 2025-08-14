<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $nipPengaju = $user->nip_lama;
        $idRole = $user->id_role;

        return view('dashboard');
    }

}
