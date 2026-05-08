@extends('layouts.admin')
@section('title', 'Testimoni')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Testimoni</h1>
        <p class="text-muted small">Kelola testimoni pelanggan</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-gold">
        <i class="bi bi-plus-lg me-2"></i>Tambah Testimoni
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($testimonials->count())
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th style="width:60px">Foto</th>
                <th>Nama</th>
                <th>Posisi/Perusahaan</th>
                <th style="width:100px">Rating</th>
                <th style="width:80px">Urutan</th>
                <th style="width:150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
            <tr>
                <td>
                    @if($testimonial->photo)
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" class="rounded-circle" style="height:45px;width:45px;object-fit:cover" alt="{{ $testimonial->name }}">
                    @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="height:45px;width:45px;background:#f0f0f0;color:#999;font-size:1.2rem">
                            <i class="bi bi-person"></i>
                        </div>
                    @endif
                </td>
                <td><strong>{{ $testimonial->name }}</strong></td>
                <td>
                    <small>
                        @if($testimonial->position)
                            <div>{{ $testimonial->position }}</div>
                        @endif
                        @if($testimonial->company)
                            <div class="text-muted">{{ $testimonial->company }}</div>
                        @endif
                    </small>
                </td>
                <td>
                    <div style="color:var(--gold);font-size:0.9rem">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <i class="bi bi-star-fill"></i>
                        @endfor
                        @for($i = $testimonial->rating; $i < 5; $i++)
                            <i class="bi bi-star" style="opacity:0.3"></i>
                        @endfor
                    </div>
                </td>
                <td><span class="badge bg-secondary">{{ $testimonial->sort_order }}</span></td>
                <td>
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus testimoni ini?')">
                        @csrf
                        @method('DELETE')
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

{{ $testimonials->links() }}
@else
<div class="alert alert-info">
    <i class="bi bi-info-circle me-2"></i>Tidak ada testimoni. <a href="{{ route('admin.testimonials.create') }}">Tambah testimoni pertama Anda</a>
</div>
@endif
@endsection
