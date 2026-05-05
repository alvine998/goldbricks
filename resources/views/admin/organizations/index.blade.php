@extends('layouts.admin')
@section('title', 'Kelola Organisasi')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Kelola Organisasi</div>
        <div class="page-subtitle">Manajemen anggota organisasi untuk halaman Tentang Kami</div>
    </div>
    <a href="{{ route('admin.organizations.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Anggota
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($organizations->count())
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4 py-3">Foto</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th class="text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizations as $org)
                    <tr>
                        <td class="px-4">
                            @if($org->photo)
                                <img src="{{ asset('storage/' . $org->photo) }}" style="width:50px;height:50px;object-fit:cover;border-radius:50%" alt="">
                            @else
                                <div style="width:50px;height:50px;background:rgba(26,92,58,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-person" style="color:var(--primary)"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $org->name }}</td>
                        <td><span class="badge bg-light text-dark">{{ $org->position }}</span></td>
                        <td class="text-muted small">{{ Str::limit($org->description, 50) ?? '-' }}</td>
                        <td>{{ $org->sort_order }}</td>
                        <td class="text-end px-4">
                            <a href="{{ route('admin.organizations.edit', $org) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.organizations.destroy', $org) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus anggota ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top">
            {{ $organizations->links() }}
        </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people text-muted" style="font-size:3rem;opacity:0.3"></i>
                <p class="text-muted mt-2">Belum ada anggota organisasi. <a href="{{ route('admin.organizations.create') }}">Tambah sekarang</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
