@extends('layouts.admin')
@section('title', 'Bank KPR')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-0">Bank KPR</h1>
        <p class="text-muted small">Kelola bank partner untuk layanan KPR</p>
    </div>
    <a href="{{ route('admin.banks.create') }}" class="btn btn-gold">
        <i class="bi bi-plus-lg me-2"></i>Tambah Bank
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($banks->count())
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Logo</th>
                <th>Nama Bank</th>
                <th>Link KPR</th>
                <th>Urutan</th>
                <th style="width:150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banks as $bank)
            <tr>
                <td>
                    @if($bank->logo)
                    <img src="{{ asset('storage/' . $bank->logo) }}"
                        style="height:50px;object-fit:contain;max-width:120px;background:#f8f9fa;padding:2px;border-radius:4px"
                        alt="{{ $bank->name }}"> @else
                    <div style="height:50px;width:120px;background:#f8f9fa;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#999;font-size:0.85rem">
                        <i class="bi bi-image text-muted me-2"></i>No logo
                    </div>
                    @endif
                </td>
                <td><strong>{{ $bank->name }}</strong></td>
                <td>
                    @if($bank->link)
                    <a href="{{ $bank->link }}" target="_blank" class="text-primary text-decoration-none">
                        <i class="bi bi-box-arrow-up-right me-1"></i>{{ Str::limit($bank->link, 40) }}
                    </a>
                    @else
                    <span class="text-muted small">-</span>
                    @endif
                </td>
                <td><span class="badge bg-secondary">{{ $bank->sort_order }}</span></td>
                <td>
                    <a href="{{ route('admin.banks.edit', $bank->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.banks.destroy', $bank->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus bank ini?')">
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

{{ $banks->links() }}
@else
<div class="alert alert-info">
    <i class="bi bi-info-circle me-2"></i>Tidak ada bank. <a href="{{ route('admin.banks.create') }}">Tambah bank pertama Anda</a>
</div>
@endif
@endsection