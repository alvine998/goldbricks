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
                           placeholder="Contoh: Bersama Goldbricks Realtors">
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
                           placeholder="Contoh: Tentang Goldbricks Realtors">
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

@if($slug === 'home')
<form method="POST" action="{{ route('admin.pages.update', $slug) }}" class="mt-4">
    @csrf
    @method('PUT')

    {{-- Hidden fields to re-send page fields unchanged --}}
    <input type="hidden" name="hero_title"    value="{{ $page->hero_title ?? '' }}">
    <input type="hidden" name="hero_subtitle" value="{{ $page->hero_subtitle ?? '' }}">
    <input type="hidden" name="video_url"     value="{{ $page->video_url ?? '' }}">
    <input type="hidden" name="section_title" value="{{ $page->section_title ?? '' }}">
    <input type="hidden" name="content"       value="{{ $page->content ?? '' }}">

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold" style="color:var(--primary)">
                <i class="bi bi-bar-chart me-2" style="color:var(--gold)"></i>Stats Bar
            </h6>
            <small class="text-muted">Angka & label statistik di bawah hero</small>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Properti Terjual (angka)</label>
                    <input type="number" name="stat_properties_sold" class="form-control" min="0"
                           value="{{ old('stat_properties_sold', $settings['stat_properties_sold'] ?? '500') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Label Properti Terjual</label>
                    <input type="text" name="stat_label_properties" class="form-control" maxlength="50"
                           value="{{ old('stat_label_properties', $settings['stat_label_properties'] ?? 'Properti Terjual') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Label Proyek Aktif</label>
                    <input type="text" name="stat_label_projects" class="form-control" maxlength="50"
                           value="{{ old('stat_label_projects', $settings['stat_label_projects'] ?? 'Proyek Aktif') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Tahun Pengalaman (angka)</label>
                    <input type="number" name="stat_years_experience" class="form-control" min="0"
                           value="{{ old('stat_years_experience', $settings['stat_years_experience'] ?? '15') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Label Tahun Pengalaman</label>
                    <input type="text" name="stat_label_experience" class="form-control" maxlength="50"
                           value="{{ old('stat_label_experience', $settings['stat_label_experience'] ?? 'Tahun Pengalaman') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Klien Puas (angka)</label>
                    <input type="number" name="stat_clients" class="form-control" min="0"
                           value="{{ old('stat_clients', $settings['stat_clients'] ?? '1000') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Label Klien Puas</label>
                    <input type="text" name="stat_label_clients" class="form-control" maxlength="50"
                           value="{{ old('stat_label_clients', $settings['stat_label_clients'] ?? 'Klien Puas') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold" style="color:var(--primary)">
                <i class="bi bi-patch-check me-2" style="color:var(--gold)"></i>Seksi "Mengapa Kami"
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-medium small">Badge</label>
                    <input type="text" name="whyus_badge" class="form-control" maxlength="80"
                           value="{{ old('whyus_badge', $settings['whyus_badge'] ?? 'Mengapa Kami') }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-medium small">Judul</label>
                    <input type="text" name="whyus_title" class="form-control" maxlength="200"
                           value="{{ old('whyus_title', $settings['whyus_title'] ?? 'Dipercaya oleh Ribuan Keluarga Indonesia') }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium small">Deskripsi</label>
                    <textarea name="whyus_desc" class="form-control" rows="2" maxlength="400">{{ old('whyus_desc', $settings['whyus_desc'] ?? 'Goldbricks Realtors telah melayani pelanggan selama lebih dari satu dekade dengan komitmen terhadap kualitas, kepercayaan, dan kepuasan klien.') }}</textarea>
                </div>
                @foreach([
                    ['n' => '1', 'dt' => 'Terpercaya & Berpengalaman', 'dd' => 'Lebih dari 15 tahun melayani kebutuhan properti Indonesia.'],
                    ['n' => '2', 'dt' => 'Lokasi Strategis',           'dd' => 'Properti di lokasi terbaik dengan aksesibilitas tinggi.'],
                    ['n' => '3', 'dt' => 'Tim Profesional',             'dd' => 'Agen berpengalaman siap membantu Anda 24/7.'],
                    ['n' => '4', 'dt' => 'Penghargaan Bergengsi',       'dd' => 'Meraih berbagai penghargaan sebagai agen properti terbaik.'],
                ] as $wi)
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Item {{ $wi['n'] }} — Judul</label>
                    <input type="text" name="whyus_{{ $wi['n'] }}_title" class="form-control" maxlength="100"
                           value="{{ old('whyus_'.$wi['n'].'_title', $settings['whyus_'.$wi['n'].'_title'] ?? $wi['dt']) }}">
                </div>
                <div class="col-md-9">
                    <label class="form-label fw-medium small">Item {{ $wi['n'] }} — Deskripsi</label>
                    <input type="text" name="whyus_{{ $wi['n'] }}_desc" class="form-control" maxlength="200"
                           value="{{ old('whyus_'.$wi['n'].'_desc', $settings['whyus_'.$wi['n'].'_desc'] ?? $wi['dd']) }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold" style="color:var(--primary)">
                <i class="bi bi-bank me-2" style="color:var(--gold)"></i>Seksi "Dukungan Finansial"
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Badge</label>
                    <input type="text" name="bank_badge" class="form-control" maxlength="80"
                           value="{{ old('bank_badge', $settings['bank_badge'] ?? 'Dukungan Finansial') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium small">Judul</label>
                    <input type="text" name="bank_title" class="form-control" maxlength="200"
                           value="{{ old('bank_title', $settings['bank_title'] ?? 'Bank Partner KPR Kami') }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-medium small">Sub-judul</label>
                    <input type="text" name="bank_subtitle" class="form-control" maxlength="300"
                           value="{{ old('bank_subtitle', $settings['bank_subtitle'] ?? 'Kami bekerja sama dengan bank-bank terpercaya untuk memudahkan Anda mendapatkan pembiayaan properti impian.') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold" style="color:var(--primary)">
                <i class="bi bi-chat-quote me-2" style="color:var(--gold)"></i>Seksi "Kepercayaan Klien"
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-medium small">Badge</label>
                    <input type="text" name="testimonial_badge" class="form-control" maxlength="80"
                           value="{{ old('testimonial_badge', $settings['testimonial_badge'] ?? 'Kepercayaan Klien') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium small">Judul</label>
                    <input type="text" name="testimonial_title" class="form-control" maxlength="200"
                           value="{{ old('testimonial_title', $settings['testimonial_title'] ?? 'Testimoni Pelanggan Kami') }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-medium small">Sub-judul</label>
                    <input type="text" name="testimonial_subtitle" class="form-control" maxlength="300"
                           value="{{ old('testimonial_subtitle', $settings['testimonial_subtitle'] ?? 'Ribuan pelanggan puas telah menemukan properti impian mereka bersama Goldbricks Realtors.') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check2 me-2"></i>Simpan Konten Beranda
        </button>
    </div>
</form>
@endif
@endsection
