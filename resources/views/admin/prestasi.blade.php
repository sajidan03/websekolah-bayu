@extends('Layouts-Admin.app')
@section('title', 'Kelola Prestasi')
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
        <h2>Kelola Prestasi</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPrestasiModal">
            <i class="fas fa-plus"></i> Tambah Prestasi
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Prestasi</th>
                            <th>Kategori</th>
                            <th>Isi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prestasis as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($item->foto)
                                        <img src="{{ asset('assets/' . $item->foto) }}" alt="{{ $item->nama_prestasi }}"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    @else
                                        <div style="width:60px;height:60px;background:#ddd;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $item->nama_prestasi }}</td>
                                <td>
                                    <span class="badge {{ $item->kategori == 'Akademik' ? 'bg-primary' : 'bg-warning text-dark' }}">
                                        {{ $item->kategori ?? 'Non-Akademik' }}
                                    </span>
                                </td>
                                <td>{{ Str::limit($item->isi, 50) }}</td>
                                <td>
                                    @if ($item->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                       data-bs-target="#editPrestasiModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus prestasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editPrestasiModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Prestasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.prestasi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Prestasi</label>
                                                    <input type="text" name="nama_prestasi" class="form-control"
                                                        value="{{ $item->nama_prestasi }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori</label>
                                                    <select name="kategori" class="form-select" required>
                                                        <option value="Akademik" {{ ($item->kategori ?? '') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                                        <option value="Non-Akademik" {{ ($item->kategori ?? 'Non-Akademik') == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                                        <option value="Olahraga" {{ ($item->kategori ?? '') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                                        <option value="Seni" {{ ($item->kategori ?? '') == 'Seni' ? 'selected' : '' }}>Seni</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Isi / Deskripsi</label>
                                                    <textarea name="isi" class="form-control" rows="4" required>{{ $item->isi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Foto</label>
                                                    @if ($item->foto)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('assets/' . $item->foto) }}" alt="{{ $item->nama_prestasi }}"
                                                                 style="width:100px;height:100px;object-fit:cover;border-radius:8px;">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <div class="form-check form-switch mt-1">
                                                        <input class="form-check-input" type="checkbox" name="status"
                                                            id="editStatus{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="editStatus{{ $item->id }}">Aktif (tampil di halaman utama)</label>
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
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data prestasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Prestasi Modal -->
<div class="modal fade" id="addPrestasiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Prestasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Prestasi</label>
                        <input type="text" name="nama_prestasi" class="form-control" placeholder="Masukkan nama prestasi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Akademik">Akademik</option>
                            <option value="Non-Akademik" selected>Non-Akademik</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Seni">Seni</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi / Deskripsi</label>
                        <textarea name="isi" class="form-control" rows="4" placeholder="Deskripsi prestasi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" name="status" id="addStatusPrestasi" checked>
                            <label class="form-check-label" for="addStatusPrestasi">Aktif (tampil di halaman utama)</label>
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

@endsection
