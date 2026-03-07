<?php

namespace App\Http\Controllers;

use App\Models\profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function vm()
    {
        $profil = profil::where('nama_menu', 'visi-misi')->where('status', true)->first();
        return view('Profil.vm', compact('profil'));
    }

    public function sejarah()
    {
        $profil = profil::where('nama_menu', 'sejarah')
            ->with('historyImages')
            ->where('status', true)
            ->first();
        return view('Profil.sejarah', compact('profil'));
    }

    public function dashboard()
    {
        $profils = profil::where('status', true)->orderBy('urutan')->get();
        
        // Get visi-misi data
        $visimisi = profil::where('nama_menu', 'visi-misi')->where('status', true)->first();
        
        // Get struktur organisasi data
        $strukturs = profil::where('nama_menu', 'struktur-organisasi')->where('status', true)->orderBy('urutan')->get();
        
        return view('Profil.dashboard', compact('profils', 'visimisi', 'strukturs'));
    }

    public function menu($slug)
    {
        // Handle dynamic profil from database based on slug
        if ($slug === 'visi-misi') {
            $profil = profil::where('nama_menu', 'visi-misi')->where('status', true)->first();
            return view('Profil.vm', compact('profil'));
        } elseif ($slug === 'sambutan') {
            $profil = profil::where('nama_menu', 'sambutan')->where('status', true)->first();
            return view('Profil.sambutan', compact('profil'));
        } elseif ($slug === 'sejarah') {
            $profil = profil::where('nama_menu', 'sejarah')->where('status', true)->first();
            return view('Profil.sejarah', compact('profil'));
        } elseif ($slug === 'struktur-organisasi') {
            $profil = profil::where('nama_menu', 'struktur-organisasi')->where('status', true)->first();
            $profils = profil::where('nama_menu', 'struktur-organisasi')->where('status', true)->orderBy('urutan')->get();
            return view('Profil.struktur', compact('profil', 'profils'));
        } else {
            // For other dynamic menu items
            $profil = profil::where('nama_menu', $slug)->where('status', true)->first();
            if ($profil) {
                return view('Profil.struktur', compact('profil'));
            }
            abort(404);
        }
    }

    public function sambut()
    {
        $profil = profil::where('nama_menu', 'sambutan')->where('status', true)->first();
        return view('Profil.sambutan', compact('profil'));
    }

    public function struktur()
    {
        $profil = profil::where('nama_menu', 'struktur-organisasi')->where('status', true)->first();
        $profils = profil::where('nama_menu', 'struktur-organisasi')->where('status', true)->orderBy('urutan')->get();
        return view('Profil.struktur', compact('profil', 'profils'));
    }
}
