<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        // Hanya tampilkan prestasi yang aktif
        $prestasis = Prestasi::where('status', true)->orderBy('id', 'desc')->get();

        return view('Prestasi.index', compact('prestasis'));
    }
}
