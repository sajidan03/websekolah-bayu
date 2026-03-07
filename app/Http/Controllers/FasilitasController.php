<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index() {
        $fasilitas = Fasilitas::where('status', true)->get();
        return view('Fasilitas.index', compact('fasilitas'));
    }
}
