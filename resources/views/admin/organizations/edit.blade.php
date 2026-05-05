@extends('layouts.admin')
@section('title', 'Edit Anggota Organisasi')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.organizations.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <div class="page-title">Edit Anggota Organisasi</div>
        <div class="page-subtitle">{{ $organization->name }}</div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.organizations.update', $organization) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.organizations._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check2 me-2"></i>Perbarui Anggota
                </button>
                <a href="{{ route('admin.organizations.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
