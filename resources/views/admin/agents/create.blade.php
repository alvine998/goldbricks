@extends('layouts.admin')
@section('title', 'Tambah Agen')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Tambah Agen</div>
        <div class="page-subtitle">Agen baru akan ditampilkan di halaman Tentang Kami</div>
    </div>
    <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.agents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.agents._form')
            <hr class="mt-4">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-circle me-2"></i>Simpan Agen
                </button>
                <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
