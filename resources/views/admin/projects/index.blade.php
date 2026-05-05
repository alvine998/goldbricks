@extends('layouts.admin')
@section('title', 'Kelola Proyek')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Kelola Proyek</div>
        <div class="page-subtitle">Daftar semua proyek properti</div>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Proyek
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($projects->count())
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="px-4 py-3">Proyek</th>
                        <th>Lokasi</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Unggulan</th>
                        <th class="text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex align-items-center gap-3">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" style="width:45px;height:45px;object-fit:cover;border-radius:6px" alt="">
                                @else
                                    <div style="width:45px;height:45px;background:rgba(26,92,58,0.08);border-radius:6px;display:flex;align-items:center;justify-content:center">
                                        <i class="bi bi-building" style="color:var(--primary)"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-medium" style="color:var(--primary)">{{ $project->title }}</div>
                                    <div class="text-muted" style="font-size:0.78rem">{{ $project->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted small">{{ $project->location ?? '-' }}</td>
                        <td><span class="badge bg-light text-dark border">{{ ucfirst($project->type ?? '-') }}</span></td>
                        <td class="fw-medium" style="color:var(--gold)">{{ $project->price ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $project->status === 'available' ? 'bg-success' : ($project->status === 'upcoming' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                {{ $project->status === 'available' ? 'Tersedia' : ($project->status === 'upcoming' ? 'Segera' : 'Terjual') }}
                            </span>
                        </td>
                        <td>
                            @if($project->featured)
                                <i class="bi bi-star-fill text-warning"></i>
                            @else
                                <i class="bi bi-star text-muted"></i>
                            @endif
                        </td>
                        <td class="text-end px-4">
                            <a href="{{ route('admin.properties.index', $project->slug) }}" class="btn btn-sm btn-outline-info me-1" title="Kelola Properti">
                                <i class="bi bi-houses"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus proyek ini?')">
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
            {{ $projects->links() }}
        </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-buildings text-muted" style="font-size:3rem;opacity:0.3"></i>
                <p class="text-muted mt-2">Belum ada proyek. <a href="{{ route('admin.projects.create') }}">Tambah sekarang</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
