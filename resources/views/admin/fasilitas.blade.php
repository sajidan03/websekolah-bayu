@extends('Layouts-Admin.app')
@section('title', 'Kelola Fasilitas')
@section('content')

<div class="container-fluid">
    <!-- Alert Messages -->
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
        <h2>Kelola Fasilitas</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFasilitasModal">
            <i class="fas fa-plus"></i> Tambah Fasilitas
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
                            <th>Nama Fasilitas</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fasilitas as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($item->gambar)
                                        <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->nama_fasilitas }}" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background: #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $item->nama_fasilitas }}</td>
                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                       data-bs-target="#editFasilitasModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" 
                                        class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editFasilitasModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Fasilitas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.fasilitas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Fasilitas</label>
                                                    <input type="text" name="nama_fasilitas" class="form-control" 
                                                        value="{{ $item->nama_fasilitas }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $item->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Gambar</label>
                                                    @if ($item->gambar)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->nama_fasilitas }}" 
                                                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
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
                                <td colspan="5" class="text-center">Tidak ada data fasilitas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Fasilitas Modal -->
<div class="modal fade" id="addFasilitasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Fasilitas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Fasilitas</label>
                        <input type="text" name="nama_fasilitas" class="form-control" placeholder="Masukkan nama fasilitas" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi fasilitas" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
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
