<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eskul;

class EskulController extends Controller
{
    public function index() {
        $eskuls = Eskul::where('status', true)->orderBy('id', 'desc')->get();
        return view('Eskul.dashboard', compact('eskuls'));
    }
}
