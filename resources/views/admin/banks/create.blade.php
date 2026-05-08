@extends('layouts.admin')
@section('title', 'Tambah Bank KPR')

@section('content')
<div class="mb-4">
    <h1 class="mb-0">Tambah Bank KPR</h1>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.banks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.banks._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-check-lg me-2"></i>Simpan Bank
                </button>
                <a href="{{ route('admin.banks.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
