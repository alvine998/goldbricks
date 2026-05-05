@extends('layouts.admin')
@section('title', 'Kelola Galeri')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Kelola Galeri</div>
        <div class="page-subtitle">Kelola foto-foto untuk halaman galeri</div>
    </div>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Upload Foto
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($galleries->count())
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4 py-3">Foto</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th class="text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galleries as $gallery)
                    <tr>
                        <td class="px-4">
                            <img src="{{ asset('storage/' . $gallery->image) }}" style="width:60px;height:45px;object-fit:cover;border-radius:6px" alt="">
                        </td>
                        <td class="fw-medium">{{ $gallery->title ?? '-' }}</td>
                        <td class="text-muted small">{{ Str::limit($gallery->description, 60) ?? '-' }}</td>
                        <td>{{ $gallery->sort_order }}</td>
                        <td class="text-end px-4">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus foto ini?')">
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
            {{ $galleries->links() }}
        </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-images text-muted" style="font-size:3rem;opacity:0.3"></i>
                <p class="text-muted mt-2">Belum ada foto. <a href="{{ route('admin.galleries.create') }}">Upload sekarang</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
