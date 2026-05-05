@extends('layouts.admin')
@section('title', 'Edit Halaman: ' . ucfirst($slug))

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.pages.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <div class="page-title">Edit Halaman: {{ ucfirst($slug) }}</div>
        <div class="page-subtitle">Kelola konten untuk halaman {{ ucfirst($slug) }}</div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.pages.update', $slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-medium">Judul Hero / Banner</label>
                    <input type="text" name="hero_title" class="form-control"
                           value="{{ old('hero_title', $page->hero_title ?? '') }}"
                           placeholder="Contoh: Temukan Properti Impian Anda">
                    <div class="form-text">Judul besar yang tampil di bagian atas halaman.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Subjudul Hero</label>
                    <input type="text" name="hero_subtitle" class="form-control"
                           value="{{ old('hero_subtitle', $page->hero_subtitle ?? '') }}"
                           placeholder="Contoh: Bersama Midland Properti">
                    <div class="form-text">Teks pendamping di bawah judul utama.</div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Video Hero URL (YouTube/MP4)</label>
                    <input type="url" name="video_url" class="form-control"
                           value="{{ old('video_url', $page->video_url ?? '') }}"
                           placeholder="https://videos.pexels.com/video-files/...mp4">
                    <div class="form-text">Masukkan URL video (MP4, YouTube). Video akan di-autoplay, muted, dan loop di background hero. Jika kosong, akan menampilkan gambar hero.</div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Gambar Hero / Banner</label>
                    @if(!empty($page->hero_image))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $page->hero_image) }}" class="img-thumbnail" style="height:100px;object-fit:cover" alt="Hero">
                            <div class="form-text">Gambar saat ini. Upload baru untuk mengganti.</div>
                        </div>
                    @endif
                    <input type="file" name="hero_image" class="form-control @error('hero_image') is-invalid @enderror"
                           accept="image/jpeg,image/jpg,image/png,image/webp">
                    <div class="form-text">Format: JPEG, PNG, WEBP. Maks 3 MB.</div>
                    @error('hero_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Judul Seksi</label>
                    <input type="text" name="section_title" class="form-control"
                           value="{{ old('section_title', $page->section_title ?? '') }}"
                           placeholder="Contoh: Tentang Midland Properti">
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Konten / Deskripsi</label>
                    <textarea name="content" class="form-control" rows="8"
                              placeholder="Masukkan konten atau deskripsi halaman...">{{ old('content', $page->content ?? '') }}</textarea>
                    <div class="form-text">Teks ini akan ditampilkan sebagai deskripsi utama pada halaman {{ ucfirst($slug) }}.</div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check2 me-2"></i>Simpan Konten
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
