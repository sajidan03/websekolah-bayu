@extends('Layouts-Admin.app')
@section('title', 'Detail Pesan')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Pesan</h2>
        <a href="{{ route('admin.pesan') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pengirim</label>
                        <p>{{ $pesan->nama }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>
                            <a href="mailto:{{ $pesan->email }}">{{ $pesan->email }}</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Kirim</label>
                        <p>{{ $pesan->created_at->format('d F Y, H:i:s') }}</p>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Pesan</label>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($pesan->pesan)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="mailto:{{ $pesan->email }}" class="btn btn-primary">
                    <i class="fas fa-reply"></i> Balas Email
                </a>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPesanModal{{ $pesan->id }}">
                    <i class="fas fa-edit"></i> Edit Pesan
                </button>
                <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Pesan Modal -->
    <div class="modal fade" id="editPesanModal{{ $pesan->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.pesan.update', $pesan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $pesan->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $pesan->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" class="form-control" rows="5" required>{{ $pesan->pesan }}</textarea>
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
</div>

@endsection

