<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index()
    {
        return view('pesan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:245',
            'email' => 'required|email|max:100',
            'comment' => 'required|string',
        ]);

        Pesan::create([
            'nama' => $validated['author'],
            'email' => $validated['email'],
            'pesan' => $validated['comment'],
        ]);

        return redirect()->route('pesan.index')->with('success', 'Pesan Anda telah dikirim!');
    }
}
