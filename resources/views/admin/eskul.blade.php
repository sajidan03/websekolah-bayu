@extends('Layouts-Admin.app')
@section('title', 'Kelola Eskul')
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
        <h2>Kelola Eskul</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEskulModal">
            <i class="fas fa-plus"></i> Tambah Eskul
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
                            <th>Nama Eskul</th>
                            <th>Pembina</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($eskuls as $index => $eskul)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($eskul->gambar)
                                        <img src="{{ asset('assets/' . $eskul->gambar) }}" alt="{{ $eskul->nama_eskul }}" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background: #ddd; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $eskul->nama_eskul }}</td>
                                <td>{{ $eskul->pembina }}</td>
                                <td>{{ Str::limit($eskul->deskripsi, 50) }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                       data-bs-target="#editEskulModal{{ $eskul->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.eskul.destroy', $eskul->id) }}" method="POST" 
                                        class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus eskul ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editEskulModal{{ $eskul->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Eskul</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.eskul.update', $eskul->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Eskul</label>
                                                    <input type="text" name="nama_eskul" class="form-control" 
                                                        value="{{ $eskul->nama_eskul }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Pembina</label>
                                                    <input type="text" name="pembina" class="form-control" 
                                                        value="{{ $eskul->pembina }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $eskul->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Gambar</label>
                                                    @if ($eskul->gambar)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('assets/' . $eskul->gambar) }}" alt="{{ $eskul->nama_eskul }}" 
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
                                <td colspan="6" class="text-center">Tidak ada data eskul</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Eskul Modal -->
<div class="modal fade" id="addEskulModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Eskul Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.eskul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Eskul</label>
                        <input type="text" name="nama_eskul" class="form-control" placeholder="Masukkan nama eskul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pembina</label>
                        <input type="text" name="pembina" class="form-control" placeholder="Masukkan nama pembina" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi eskul" required></textarea>
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
