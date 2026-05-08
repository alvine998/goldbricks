@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Dashboard</div>
        <div class="page-subtitle">Selamat datang di CMS Goldbricks Realtors</div>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary">
        <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Website
    </a>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(15,45,94,0.1)">
                    <i class="bi bi-buildings" style="color:var(--primary)"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['total_projects'] }}</div>
                    <div class="stat-label">Total Proyek</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(201,168,76,0.1)">
                    <i class="bi bi-star" style="color:var(--gold)"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['featured'] }}</div>
                    <div class="stat-label">Proyek Unggulan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(34,197,94,0.1)">
                    <i class="bi bi-check-circle" style="color:#22c55e"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['available'] }}</div>
                    <div class="stat-label">Properti Tersedia</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(99,102,241,0.1)">
                    <i class="bi bi-images" style="color:#6366f1"></i>
                </div>
                <div>
                    <div class="stat-number">{{ $stats['gallery'] }}</div>
                    <div class="stat-label">Foto Galeri</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-3">
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-3" style="color:var(--primary)"><i class="bi bi-lightning me-2 text-warning"></i>Aksi Cepat</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary btn-sm text-start">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Proyek Baru
                    </a>
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-outline-primary btn-sm text-start">
                        <i class="bi bi-image-fill me-2"></i>Upload Foto Galeri
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-primary btn-sm text-start">
                        <i class="bi bi-pencil me-2"></i>Edit Menu Navigasi
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary btn-sm text-start">
                        <i class="bi bi-file-text me-2"></i>Edit Konten Halaman
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-3" style="color:var(--primary)"><i class="bi bi-info-circle me-2"></i>Panduan Penggunaan</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2 d-flex gap-2">
                        <i class="bi bi-check2-circle text-success mt-1"></i>
                        <span>Gunakan menu <strong>Pengaturan</strong> untuk mengubah teks navigasi (Home, Project, Gallery, dll.)</span>
                    </li>
                    <li class="mb-2 d-flex gap-2">
                        <i class="bi bi-check2-circle text-success mt-1"></i>
                        <span>Gunakan menu <strong>Halaman</strong> untuk mengedit konten tiap halaman (hero, deskripsi, dll.)</span>
                    </li>
                    <li class="mb-2 d-flex gap-2">
                        <i class="bi bi-check2-circle text-success mt-1"></i>
                        <span>Gunakan menu <strong>Proyek</strong> untuk menambah, mengedit, atau menghapus proyek properti.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="bi bi-check2-circle text-success mt-1"></i>
                        <span>Gunakan menu <strong>Galeri</strong> untuk mengelola foto-foto yang ditampilkan di halaman galeri.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
