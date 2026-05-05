@extends('layouts.admin')
@section('title', 'Pengaturan')

@section('content')
<div class="mb-4">
    <div class="page-title">Pengaturan Website</div>
    <div class="page-subtitle">Kelola pengaturan umum dan teks menu navigasi</div>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <!-- Menu Navigation -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary)">
                        <i class="bi bi-list-ul me-2 text-gold" style="color:var(--gold)"></i>Teks Menu Navigasi
                    </h6>
                    <small class="text-muted">Ubah label yang tampil di menu website</small>
                </div>
                <div class="card-body p-4">
                    @foreach([
                        ['key' => 'menu_home',    'label' => 'Menu Home',       'default' => 'Beranda'],
                        ['key' => 'menu_project', 'label' => 'Menu Project',    'default' => 'Proyek'],
                        ['key' => 'menu_gallery', 'label' => 'Menu Gallery',    'default' => 'Galeri'],
                        ['key' => 'menu_about',   'label' => 'Menu About Us',   'default' => 'Tentang Kami'],
                        ['key' => 'menu_contact', 'label' => 'Menu Contact Us', 'default' => 'Kontak'],
                    ] as $menu)
                    <div class="mb-3">
                        <label class="form-label fw-medium small">{{ $menu['label'] }}</label>
                        <input type="text" name="{{ $menu['key'] }}" class="form-control @error($menu['key']) is-invalid @enderror"
                               value="{{ old($menu['key'], $settings[$menu['key']] ?? $menu['default']) }}"
                               placeholder="{{ $menu['default'] }}" required maxlength="50">
                        @error($menu['key'])<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Site Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary)">
                        <i class="bi bi-building me-2" style="color:var(--gold)"></i>Informasi Website
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Nama Website</label>
                        <input type="text" name="site_name" class="form-control" maxlength="100"
                               value="{{ old('site_name', $settings['site_name'] ?? 'Midland Properti') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Tagline</label>
                        <input type="text" name="site_tagline" class="form-control" maxlength="200"
                               value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Your Trusted Property Partner') }}"
                               placeholder="Your Trusted Property Partner">
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold" style="color:var(--primary)">
                        <i class="bi bi-telephone me-2" style="color:var(--gold)"></i>Informasi Kontak
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Email</label>
                        <input type="email" name="contact_email" class="form-control" maxlength="100"
                               value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                               placeholder="info@midlandproperti.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Telepon</label>
                        <input type="text" name="contact_phone" class="form-control" maxlength="30"
                               value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                               placeholder="+62 21-xxxx-xxxx">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Alamat</label>
                        <textarea name="contact_address" class="form-control" rows="2" maxlength="300"
                                  placeholder="Jl. Sudirman No. 1, Jakarta">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium small">WhatsApp <span class="text-muted">(format: 628xxxxxxxxxx)</span></label>
                        <input type="text" name="social_whatsapp" class="form-control" maxlength="20"
                               value="{{ old('social_whatsapp', $settings['social_whatsapp'] ?? '') }}"
                               placeholder="628123456789">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Instagram URL</label>
                        <input type="text" name="social_instagram" class="form-control"
                               value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                               placeholder="https://instagram.com/midlandproperti">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-medium small">Facebook URL</label>
                        <input type="text" name="social_facebook" class="form-control"
                               value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                               placeholder="https://facebook.com/midlandproperti">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check2 me-2"></i>Simpan Pengaturan
        </button>
    </div>
</form>
@endsection
