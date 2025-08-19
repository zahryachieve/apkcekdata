<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dana;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Rekapan
        $total_va = Dana::distinct('no_va')->count('no_va');
        $total_sudah = Dana::where('status', 'Sudah Dikembalikan')->count();
        $total_belum = Dana::where('status', 'Belum Dikembalikan')->count();

        return view('dashboard', compact('total_va', 'total_sudah', 'total_belum'));
    }
}
