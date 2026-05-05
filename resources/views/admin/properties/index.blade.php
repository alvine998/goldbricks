@extends('layouts.admin')
@section('title', 'Kelola Properti - ' . $project->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.projects.index') }}" class="text-decoration-none text-muted small">
            <i class="bi bi-chevron-left"></i> Kembali ke Proyek
        </a>
        <h1 class="h3 mt-2">{{ $project->title }}</h1>
        <p class="text-muted mb-0">Kelola properti di proyek ini</p>
    </div>
    <a href="{{ route('admin.properties.create', $project->slug) }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Tambah Properti
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background:var(--light-bg)">
                <tr>
                    <th style="width:40px">
                        <i class="bi bi-image"></i>
                    </th>
                    <th>Nama Properti</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th style="width:100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td>
                            @if($property->image)
                                <img src="{{ asset('storage/' . $property->image) }}" style="width:40px;height:40px;object-fit:cover;border-radius:4px" alt="">
                            @else
                                <div style="width:40px;height:40px;background:var(--light-bg);border-radius:4px;display:flex;align-items:center;justify-content:center">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $property->title }}</strong>
                        </td>
                        <td>
                            <span class="badge" style="background:rgba(26,92,58,0.1);color:var(--primary)">{{ $property->getTypeLabel() }}</span>
                        </td>
                        <td>
                            @if($property->price)
                                Rp {{ number_format($property->price, 0, ',', '.') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $property->status === 'available' ? 'bg-success' : ($property->status === 'sold' ? 'bg-danger' : 'bg-warning') }}">
                                {{ $property->getStatusLabel() }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $property->location ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.properties.edit', [$project->slug, $property->id]) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.properties.destroy', [$project->slug, $property->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus properti ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size:2rem;opacity:0.3"></i>
                            <p class="mb-0">Belum ada properti di proyek ini</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($properties->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $properties->links() }}
    </div>
@endif
@endsection
