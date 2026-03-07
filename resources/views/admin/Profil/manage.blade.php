@extends('Layouts-Admin.app')
@section('title', 'Kelola Profil')
@section('content')

<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Profil</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfilModal">
            <i class="fas fa-plus"></i> Tambah Profil
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Menu</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($profils as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($item->gambar)
                                        <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    @elseif($item->nama_menu == 'sejarah' && $item->historyImages->count() > 0)
                                        <img src="{{ asset('storage/' . $item->historyImages->first()->image_path) }}" alt="Sejarah"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    @else
                                        <div style="width:60px;height:60px;background:#ddd;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->nama_menu }}</span>
                                </td>
                                <td>
                                    {{ $item->judul }}
                                    @if ($item->nama_menu == 'struktur-organisasi' && $item->jabatan)
                                        <div class="text-muted" style="font-size:12px;">{{ $item->jabatan }} - {{ $item->nama }}</div>
                                    @elseif ($item->nama_menu == 'sambutan' && $item->nama_kepala_sekolah)
                                        <div class="text-muted" style="font-size:12px;">{{ $item->nama_kepala_sekolah }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                       data-bs-target="#editProfilModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.profil.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus profil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editProfilModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Profil — {{ $item->judul }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.profil.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Menu</label>
                                                            <select name="nama_menu" class="form-select" id="editMenu{{ $item->id }}" required onchange="toggleEditFields{{ $item->id }}()">
                                                                <option value="">-- Pilih Menu --</option>
                                                                <option value="sambutan" {{ $item->nama_menu == 'sambutan' ? 'selected' : '' }}>Sambutan Kepala Sekolah</option>
                                                                <option value="visi-misi" {{ $item->nama_menu == 'visi-misi' ? 'selected' : '' }}>Visi & Misi</option>
                                                                <option value="sejarah" {{ $item->nama_menu == 'sejarah' ? 'selected' : '' }}>Sejarah</option>
                                                                <option value="struktur-organisasi" {{ $item->nama_menu == 'struktur-organisasi' ? 'selected' : '' }}>Struktur Organisasi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Judul</label>
                                                            <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Nama Kepala Sekolah (khusus sambutan) -->
                                                <div class="mb-3" id="editKepsekContainer{{ $item->id }}" style="{{ $item->nama_menu == 'sambutan' ? '' : 'display:none;' }}">
                                                    <label class="form-label">Nama Kepala Sekolah</label>
                                                    <input type="text" name="nama_kepala_sekolah" class="form-control"
                                                        value="{{ $item->nama_kepala_sekolah }}" placeholder="Nama lengkap kepala sekolah">
                                                </div>

                                                <!-- Konten biasa (sambutan, default) - NOT for struktur-organisasi anymore -->
                                                <div class="mb-3" id="editKontenContainer{{ $item->id }}" style="{{ in_array($item->nama_menu, ['visi-misi', 'sejarah', 'struktur-organisasi']) ? 'display:none;' : '' }}">
                                                    <label class="form-label">Konten</label>
                                                    <textarea name="konten" class="form-control" rows="5">{{ $item->konten }}</textarea>
                                                </div>

                                                <!-- Jabatan dan Nama untuk struktur-organisasi -->
                                                <div id="editJabatanNamaContainer{{ $item->id }}" style="{{ $item->nama_menu == 'struktur-organisasi' ? '' : 'display:none;' }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">Jabatan</label>
                                                        <input type="text" name="jabatan" class="form-control" value="{{ $item->jabatan ?? '' }}" placeholder="Contoh: Kepala Sekolah, Wakili Kepala Sekolah, dll">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="nama" class="form-control" value="{{ $item->nama ?? '' }}" placeholder="Nama lengkap personil">
                                                    </div>
                                                </div>

                                                <!-- Visi Misi -->
                                                <div id="editVisiMisiContainer{{ $item->id }}" style="{{ $item->nama_menu == 'visi-misi' ? '' : 'display:none;' }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">Isi Visi</label>
                                                        <textarea name="isi_visi" class="form-control" rows="4" placeholder="Visi sekolah">{{ $item->isi_visi }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Isi Misi</label>
                                                        <textarea name="isi_misi" class="form-control" rows="4" placeholder="Misi sekolah">{{ $item->isi_misi }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- Sejarah -->
                                                <div id="editSejarahContainer{{ $item->id }}" style="{{ $item->nama_menu == 'sejarah' ? '' : 'display:none;' }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">Deskripsi Sejarah</label>
                                                        <textarea name="description" class="form-control" rows="6" placeholder="Cerita sejarah sekolah">{{ $item->description }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tambah Foto Sejarah</label>
                                                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                                                        <small class="text-muted">Bisa pilih beberapa foto sekaligus</small>
                                                    </div>
                                                    @if ($item->nama_menu == 'sejarah' && isset($item->historyImages) && $item->historyImages->count() > 0)
                                                        <div class="mb-3">
                                                            <label class="form-label">Foto Tersimpan</label>
                                                            <div class="row g-2">
                                                                @foreach($item->historyImages as $image)
                                                                    <div class="col-6 col-md-4 col-lg-3">
                                                                        <div class="position-relative border rounded p-1">
                                                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Foto Sejarah"
                                                                                class="img-fluid rounded" style="width:100%;height:100px;object-fit:cover;">
                                                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                                                onclick="deleteHistoryImage({{ $image->id }})" style="padding:2px 6px;font-size:10px;">
                                                                                <i class="fas fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Gambar (sambutan & struktur-organisasi) -->
                                                <div class="mb-3" id="editImageContainer{{ $item->id }}" style="{{ in_array($item->nama_menu, ['sambutan', 'struktur-organisasi']) ? '' : 'display:none;' }}">
                                                    <label class="form-label" id="editImageLabel{{ $item->id }}">
                                                        {{ $item->nama_menu == 'struktur-organisasi' ? 'Foto Anggota' : 'Foto Kepala Sekolah' }}
                                                    </label>
                                                    @if ($item->gambar)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                                                 style="width:120px;height:120px;object-fit:cover;border-radius:8px;">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                                </div>

                                                <!-- Urutan (untuk struktur-organisasi) - Auto Increment -->
                                                <div class="mb-3" id="editUrutanContainer{{ $item->id }}" style="{{ $item->nama_menu == 'struktur-organisasi' ? '' : 'display:none;' }}">
                                                    <label class="form-label">Urutan (Otomatis)</label>
                                                    <input type="text" class="form-control" value="{{ $item->urutan ?? 'Auto' }}" readonly>
                                                    <small class="text-muted">Urutan akan diatur otomatis</small>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <div class="form-check form-switch mt-1">
                                                        <input class="form-check-input" type="checkbox" name="status"
                                                            id="editStatus{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="editStatus{{ $item->id }}">Aktif</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function toggleEditFields{{ $item->id }}() {
                                var val = document.getElementById('editMenu{{ $item->id }}').value;
                                var konten   = document.getElementById('editKontenContainer{{ $item->id }}');
                                var vm       = document.getElementById('editVisiMisiContainer{{ $item->id }}');
                                var sejarah  = document.getElementById('editSejarahContainer{{ $item->id }}');
                                var img      = document.getElementById('editImageContainer{{ $item->id }}');
                                var kepsek   = document.getElementById('editKepsekContainer{{ $item->id }}');
                                var imgLabel = document.getElementById('editImageLabel{{ $item->id }}');
                                var urutan   = document.getElementById('editUrutanContainer{{ $item->id }}');
                                var jabatan  = document.getElementById('editJabatanNamaContainer{{ $item->id }}');

                                konten.style.display  = 'none';
                                vm.style.display      = 'none';
                                sejarah.style.display = 'none';
                                img.style.display     = 'none';
                                kepsek.style.display  = 'none';
                                urutan.style.display  = 'none';
                                jabatan.style.display = 'none';

                                if (val === 'visi-misi') {
                                    vm.style.display = 'block';
                                } else if (val === 'sejarah') {
                                    sejarah.style.display = 'block';
                                } else if (val === 'sambutan') {
                                    konten.style.display  = 'block';
                                    img.style.display     = 'block';
                                    kepsek.style.display  = 'block';
                                    imgLabel.textContent  = 'Foto Kepala Sekolah';
                                } else if (val === 'struktur-organisasi') {
                                    jabatan.style.display = 'block';
                                    img.style.display     = 'block';
                                    imgLabel.textContent  = 'Foto Anggota Struktur';
                                    urutan.style.display  = 'block';
                                } else {
                                    konten.style.display = 'block';
                                }
                            }
                            </script>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data profil</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Profil Modal -->
<div class="modal fade" id="addProfilModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Profil Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.profil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Menu</label>
                                <select name="nama_menu" class="form-select" id="addMenu" required onchange="toggleAddFields()">
                                    <option value="">-- Pilih Menu --</option>
                                    <option value="sambutan">Sambutan Kepala Sekolah</option>
                                    <option value="visi-misi">Visi & Misi</option>
                                    <option value="sejarah">Sejarah</option>
                                    <option value="struktur-organisasi">Struktur Organisasi</option>
                                </select>
                                <small class="text-muted">Pilih sesuai menu yang tersedia di website</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul halaman" required>
                            </div>
                        </div>
                    </div>

                    <!-- Nama Kepala Sekolah (khusus sambutan) -->
                    <div class="mb-3" id="addKepsekContainer" style="display:none;">
                        <label class="form-label">Nama Kepala Sekolah</label>
                        <input type="text" name="nama_kepala_sekolah" class="form-control" placeholder="Nama lengkap kepala sekolah">
                    </div>

                    <!-- Konten biasa (sambutan, default) -->
                    <div class="mb-3" id="addKontenContainer" style="display:none;">
                        <label class="form-label">Konten</label>
                        <textarea name="konten" class="form-control" rows="5" placeholder="Isi konten"></textarea>
                    </div>

                    <!-- Jabatan dan Nama untuk struktur-organisasi -->
                    <div id="addJabatanNamaContainer" style="display:none;">
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Kepala Sekolah, Wakili Kepala Sekolah, dll">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama lengkap personil">
                        </div>
                    </div>

                    <!-- Visi Misi -->
                    <div id="addVisiMisiContainer" style="display:none;">
                        <div class="mb-3">
                            <label class="form-label">Isi Visi</label>
                            <textarea name="isi_visi" class="form-control" rows="4" placeholder="Visi sekolah"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Misi</label>
                            <textarea name="isi_misi" class="form-control" rows="4" placeholder="Misi sekolah"></textarea>
                        </div>
                    </div>

                    <!-- Sejarah -->
                    <div id="addSejarahContainer" style="display:none;">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Sejarah</label>
                            <textarea name="description" class="form-control" rows="6" placeholder="Cerita sejarah sekolah"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Sejarah (bisa lebih dari 1)</label>
                            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                        </div>
                    </div>

                    <!-- Gambar (sambutan & struktur) -->
                    <div class="mb-3" id="addImageContainer" style="display:none;">
                        <label class="form-label" id="addImageLabel">Foto</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>

                    <!-- Urutan (untuk struktur-organisasi) - Auto Increment - displayed only -->
                    <div class="mb-3" id="addUrutanContainer" style="display:none;">
                        <label class="form-label">Urutan (Otomatis)</label>
                        <input type="text" class="form-control" value="Akan diatur otomatis" readonly>
                        <small class="text-muted">Urutan akan diatur secara otomatis</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" name="status" id="addStatusProfil" checked>
                            <label class="form-check-label" for="addStatusProfil">Aktif</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleAddFields() {
    var val = document.getElementById('addMenu').value;
    var konten   = document.getElementById('addKontenContainer');
    var vm       = document.getElementById('addVisiMisiContainer');
    var sejarah  = document.getElementById('addSejarahContainer');
    var img      = document.getElementById('addImageContainer');
    var kepsek   = document.getElementById('addKepsekContainer');
    var imgLabel = document.getElementById('addImageLabel');
    var urutan   = document.getElementById('addUrutanContainer');
    var jabatan  = document.getElementById('addJabatanNamaContainer');

    konten.style.display  = 'none';
    vm.style.display      = 'none';
    sejarah.style.display = 'none';
    img.style.display     = 'none';
    kepsek.style.display  = 'none';
    urutan.style.display  = 'none';
    jabatan.style.display = 'none';

    if (val === 'visi-misi') {
        vm.style.display = 'block';
    } else if (val === 'sejarah') {
        sejarah.style.display = 'block';
    } else if (val === 'sambutan') {
        konten.style.display  = 'block';
        img.style.display     = 'block';
        kepsek.style.display  = 'block';
        imgLabel.textContent  = 'Foto Kepala Sekolah';
    } else if (val === 'struktur-organisasi') {
        jabatan.style.display = 'block';
        img.style.display     = 'block';
        imgLabel.textContent  = 'Foto Anggota Struktur';
        urutan.style.display  = 'block';
    }
}

function deleteHistoryImage(imageId) {
    if (confirm('Hapus foto ini?')) {
        fetch('{{ route("admin.history-images.destroy", ":id") }}'.replace(':id', imageId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) { window.location.reload(); }
            else { alert('Gagal menghapus foto!'); }
        }).catch(() => alert('Terjadi kesalahan!'));
    }
}
</script>

@endsection
