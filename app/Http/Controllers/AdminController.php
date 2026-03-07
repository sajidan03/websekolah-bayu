<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Eskul;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\profil;
use App\Models\HistoryImage;
use App\Models\Pesan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    // ==================== USER MANAGEMENT ====================

    public function userIndex()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,user',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan!');
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'role'     => 'required|in:admin,user',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
            'role'     => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        return redirect()->route('admin.user')->with('success', 'User berhasil diperbarui!');
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.user')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus!');
    }

    // ==================== ESKUL MANAGEMENT ====================

    public function eskulIndex()
    {
        $eskuls = Eskul::all();
        return view('admin.eskul', compact('eskuls'));
    }

    public function eskulStore(Request $request)
    {
        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'pembina'    => 'required|string|max:255',
            'deskripsi'  => 'required',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'nama_eskul' => $request->nama_eskul,
            'pembina'    => $request->pembina,
            'deskripsi'  => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            $image     = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets'), $imageName);
            $data['gambar'] = $imageName;
        }

        Eskul::create($data);

        return redirect()->route('admin.eskul')->with('success', 'Eskul berhasil ditambahkan!');
    }

    public function eskulUpdate(Request $request, $id)
    {
        $eskul = Eskul::findOrFail($id);

        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'pembina'    => 'required|string|max:255',
            'deskripsi'  => 'required',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'nama_eskul' => $request->nama_eskul,
            'pembina'    => $request->pembina,
            'deskripsi'  => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($eskul->gambar && file_exists(public_path('assets/' . $eskul->gambar))) {
                unlink(public_path('assets/' . $eskul->gambar));
            }
            $image     = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets'), $imageName);
            $data['gambar'] = $imageName;
        }

        $eskul->update($data);

        return redirect()->route('admin.eskul')->with('success', 'Eskul berhasil diperbarui!');
    }

    public function eskulDestroy($id)
    {
        $eskul = Eskul::findOrFail($id);

        if ($eskul->gambar && file_exists(public_path('assets/' . $eskul->gambar))) {
            unlink(public_path('assets/' . $eskul->gambar));
        }

        $eskul->delete();

        return redirect()->route('admin.eskul')->with('success', 'Eskul berhasil dihapus!');
    }

    // ==================== FASILITAS MANAGEMENT ====================

    public function fasilitasIndex()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.fasilitas', compact('fasilitas'));
    }

    public function fasilitasStore(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi'      => 'required',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi'      => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            $image     = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets'), $imageName);
            $data['gambar'] = $imageName;
        }

        Fasilitas::create($data);

        return redirect()->route('admin.fasilitas')->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function fasilitasUpdate(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi'      => 'required',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'nama_fasilitas' => $request->nama_fasilitas,
            'deskripsi'      => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar && file_exists(public_path('assets/' . $fasilitas->gambar))) {
                unlink(public_path('assets/' . $fasilitas->gambar));
            }
            $image     = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets'), $imageName);
            $data['gambar'] = $imageName;
        }

        $fasilitas->update($data);

        return redirect()->route('admin.fasilitas')->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function fasilitasDestroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        if ($fasilitas->gambar && file_exists(public_path('assets/' . $fasilitas->gambar))) {
            unlink(public_path('assets/' . $fasilitas->gambar));
        }

        $fasilitas->delete();

        return redirect()->route('admin.fasilitas')->with('success', 'Fasilitas berhasil dihapus!');
    }

    // ==================== PRESTASI MANAGEMENT ====================

    public function prestasiIndex()
    {
        $prestasis = Prestasi::orderBy('id', 'desc')->get();
        return view('admin.prestasi', compact('prestasis'));
    }

    public function prestasiStore(Request $request)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'isi'           => 'required',
            'kategori'      => 'nullable|string|max:100',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'        => 'nullable',
        ]);

        $data = [
            'nama_prestasi' => $request->nama_prestasi,
            'isi'           => $request->isi,
            'kategori'      => $request->kategori ?? 'Non-Akademik',
            'status'        => $request->has('status') ? true : false,
        ];

        if ($request->hasFile('foto')) {
            $image     = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets'), $imageName);
            $data['foto'] = $imageName;
        }

        Prestasi::create($data);

        return redirect()->route('admin.prestasi')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function prestasiUpdate(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'isi'           => 'required',
            'kategori'      => 'nullable|string|max:100',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'        => 'nullable',
        ]);

        $data = [
            'nama_prestasi' => $request->nama_prestasi,
            'isi'           => $request->isi,
            'kategori'      => $request->kategori ?? 'Non-Akademik',
            'status'        => $request->has('status') ? true : false,
        ];

        if ($request->hasFile('foto')) {
            if ($prestasi->foto && file_exists(public_path('assets/' . $prestasi->foto))) {
                unlink(public_path('assets/' . $prestasi->foto));
            }
            $image     = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets'), $imageName);
            $data['foto'] = $imageName;
        }

        $prestasi->update($data);

        return redirect()->route('admin.prestasi')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function prestasiDestroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto && file_exists(public_path('assets/' . $prestasi->foto))) {
            unlink(public_path('assets/' . $prestasi->foto));
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasi')->with('success', 'Prestasi berhasil dihapus!');
    }

    // ==================== PROFIL MANAGEMENT ====================

    public function profilIndex()
    {
        // load historyImages untuk sejarah
        $profils = profil::with('historyImages')->orderBy('urutan')->get();
        return view('admin.Profil.manage', compact('profils'));
    }

    public function profilStore(Request $request)
    {
        // Validasi unik untuk nama_menu, tapi izinkan duplikasi untuk struktur-organisasi
        $uniqueRule = 'required|string|max:255';
        if ($request->nama_menu !== 'struktur-organisasi') {
            $uniqueRule .= '|unique:profils,nama_menu';
        }

        $request->validate([
            'nama_menu'          => $uniqueRule,
            'judul'              => 'required|string|max:255',
            'nama_kepala_sekolah'=> 'nullable|string|max:255',
            'konten'             => 'nullable',
            'isi_visi'           => 'nullable',
            'isi_misi'           => 'nullable',
            'description'        => 'nullable|string',
            'gambar'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images'             => 'nullable',
            'images.*'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'             => 'nullable',
            'urutan'            => 'nullable|integer|min:1',
            'jabatan'            => 'nullable|string|max:255',
            'nama'               => 'nullable|string|max:255',
        ]);

        if ($request->nama_menu === 'sambutan') {
            $request->validate(['nama_kepala_sekolah' => 'required|string|max:255']);
        }

        // Urutan: jika diisi manual gunakan itu, jika tidak ambil max + 1
        $maxUrutan = profil::max('urutan') ?? 0;
        $urutan = $request->filled('urutan') ? $request->urutan : $maxUrutan + 1;

        $data = [
            'nama_menu'           => $request->nama_menu,
            'judul'               => $request->judul,
            'nama_kepala_sekolah' => $request->nama_menu === 'sambutan' ? $request->nama_kepala_sekolah : null,
            'konten'              => $request->konten,
            'isi_visi'            => $request->isi_visi,
            'isi_misi'            => $request->isi_misi,
            'description'         => $request->description,
            'urutan'              => $urutan,
            'status'              => $request->has('status'),
        ];

        // Jabatan dan Nama untuk struktur-organisasi
        if ($request->nama_menu === 'struktur-organisasi') {
            $data['jabatan'] = $request->jabatan;
            $data['nama'] = $request->nama;
        }

        // Gambar untuk sambutAN DAN struktur-organisasi
        if (in_array($request->nama_menu, ['sambutan', 'struktur-organisasi']) && $request->hasFile('gambar')) {
            $image     = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets'), $imageName);
            $data['gambar'] = $imageName;
        } else {
            $data['gambar'] = null;
        }

        $profil = profil::create($data);

        // Gambar multiple untuk sejarah
        if ($request->nama_menu === 'sejarah' && $request->hasFile('images')) {
            $this->storeHistoryImages($request->file('images'), $profil->id);
        }

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil ditambahkan!');
    }

    public function profilUpdate(Request $request, $id)
    {
        $profil = profil::findOrFail($id);

        // Validasi unik untuk nama_menu, tapi izinkan duplikasi untuk struktur-organisasi
        $uniqueRule = 'required|string|max:255';
        if ($request->nama_menu !== 'struktur-organisasi') {
            $uniqueRule .= '|unique:profils,nama_menu,' . $id;
        }

        $request->validate([
            'nama_menu'          => $uniqueRule,
            'judul'              => 'required|string|max:255',
            'nama_kepala_sekolah'=> 'nullable|string|max:255',
            'konten'             => 'nullable',
            'isi_visi'           => 'nullable',
            'isi_misi'           => 'nullable',
            'description'        => 'nullable|string',
            'gambar'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images'             => 'nullable',
            'images.*'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'             => 'nullable',
            'urutan'            => 'nullable|integer|min:1',
            'jabatan'            => 'nullable|string|max:255',
            'nama'               => 'nullable|string|max:255',
        ]);

        if ($request->nama_menu === 'sambutan') {
            $request->validate(['nama_kepala_sekolah' => 'required|string|max:255']);
        }

        // Urutan: jika diisi manual gunakan itu, jika tidak pertahankan urutan lama
        $urutan = $request->filled('urutan') ? $request->urutan : $profil->urutan;

        $data = [
            'nama_menu'           => $request->nama_menu,
            'judul'               => $request->judul,
            'nama_kepala_sekolah' => $request->nama_menu === 'sambutan' ? $request->nama_kepala_sekolah : null,
            'konten'              => $request->konten,
            'isi_visi'            => $request->isi_visi,
            'isi_misi'            => $request->isi_misi,
            'description'         => $request->description,
            'urutan'              => $urutan,
            'status'              => $request->has('status'),
        ];

        // Jabatan dan Nama untuk struktur-organisasi
        if ($request->nama_menu === 'struktur-organisasi') {
            $data['jabatan'] = $request->jabatan;
            $data['nama'] = $request->nama;
        }

        // Gambar untuk sambutAN DAN struktur-organisasi
        if (in_array($request->nama_menu, ['sambutan', 'struktur-organisasi'])) {
            if ($request->hasFile('gambar')) {
                if ($profil->gambar && file_exists(public_path('assets/' . $profil->gambar))) {
                    unlink(public_path('assets/' . $profil->gambar));
                }
                $image     = $request->file('gambar');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets'), $imageName);
                $data['gambar'] = $imageName;
            } else {
                $data['gambar'] = $profil->gambar; // pertahankan gambar lama
            }
        } else {
            // Menu lain tidak pakai gambar — hapus bila ada
            if ($profil->gambar && !in_array($profil->nama_menu, ['sambutan', 'struktur-organisasi']) && file_exists(public_path('assets/' . $profil->gambar))) {
                unlink(public_path('assets/' . $profil->gambar));
            }
            $data['gambar'] = null;
        }

        $profil->update($data);

        // Gambar multiple untuk sejarah
        if ($request->nama_menu === 'sejarah' && $request->hasFile('images')) {
            $this->storeHistoryImages($request->file('images'), $profil->id);
        }

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function profilDestroy($id)
    {
        $profil = profil::findOrFail($id);

        if ($profil->gambar && file_exists(public_path('assets/' . $profil->gambar))) {
            unlink(public_path('assets/' . $profil->gambar));
        }

        if ($profil->nama_menu === 'sejarah') {
            $this->deleteAllHistoryImages($profil->id);
        }

        $profil->delete();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil dihapus!');
    }

    // ==================== HISTORY IMAGE MANAGEMENT ====================

    protected function storeHistoryImages($images, $profilId)
    {
        foreach ($images as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('history', $imageName, 'public');

            HistoryImage::create([
                'profil_id'  => $profilId,
                'image_path' => $path,
            ]);
        }
    }

    protected function deleteAllHistoryImages($profilId)
    {
        $historyImages = HistoryImage::where('profil_id', $profilId)->get();

        foreach ($historyImages as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }
    }

    public function historyImageDestroy($id)
    {
        $historyImage = HistoryImage::findOrFail($id);

        if (Storage::disk('public')->exists($historyImage->image_path)) {
            Storage::disk('public')->delete($historyImage->image_path);
        }

        $historyImage->delete();

        return redirect()->route('admin.profil')->with('success', 'Foto berhasil dihapus!');
    }

    // ==================== PESAN MANAGEMENT ====================

    public function pesanIndex()
    {
        $pesans = Pesan::orderBy('created_at', 'desc')->get();
        return view('admin.pesan', compact('pesans'));
    }

    public function pesanShow($id)
    {
        $pesan = Pesan::findOrFail($id);
        return view('admin.pesan-show', compact('pesan'));
    }

    public function pesanUpdate(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);

        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required',
        ]);

        $pesan->update([
            'nama'  => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('admin.pesan')->with('success', 'Pesan berhasil diperbarui!');
    }

    public function pesanDestroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesan')->with('success', 'Pesan berhasil dihapus!');
    }
}
