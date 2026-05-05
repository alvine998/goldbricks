@extends('layouts.admin')
@section('title', 'Tambah Properti - ' . $project->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.properties.index', $project->slug) }}" class="text-decoration-none text-muted small">
        <i class="bi bi-chevron-left"></i> Kembali ke Properti
    </a>
    <h1 class="h3 mt-2">Tambah Properti Baru</h1>
    <p class="text-muted">Proyek: <strong>{{ $project->title }}</strong></p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.properties.store', $project->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.properties._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i> Simpan Properti
                </button>
                <a href="{{ route('admin.properties.index', $project->slug) }}" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
