@extends('layouts.public')
@section('title', $menu_contact ?? 'Contact Us')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>{{ $page->hero_title ?? ($menu_contact ?? 'Hubungi Kami') }}</h1>
        @if($page && $page->hero_subtitle)
            <p style="color:rgba(255,255,255,0.75)">{{ $page->hero_subtitle }}</p>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menu_home ?? 'Home' }}</a></li>
                <li class="breadcrumb-item active">{{ $menu_contact ?? 'Contact Us' }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-4">
                <span class="section-badge">Kontak</span>
                <h2 class="section-title mb-2">Kami Siap Membantu</h2>
                <div class="divider-gold"></div>
                <p class="text-muted mb-4">{{ $page->content ?? 'Jangan ragu untuk menghubungi kami. Tim profesional kami siap membantu Anda menemukan properti terbaik.' }}</p>

                <div class="d-flex flex-column gap-3">
                    @php
                        $address = \App\Models\Setting::get('contact_address');
                        $phone   = \App\Models\Setting::get('contact_phone');
                        $email   = \App\Models\Setting::get('contact_email');
                        $wa      = \App\Models\Setting::get('social_whatsapp');
                    @endphp
                    @if($address)
                    <div class="d-flex gap-3 align-items-start">
                        <div class="contact-icon flex-shrink-0"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <div class="fw-semibold" style="color:var(--primary)">Alamat</div>
                            <div class="text-muted">{{ $address }}</div>
                        </div>
                    </div>
                    @endif
                    @if($phone)
                    <div class="d-flex gap-3 align-items-start">
                        <div class="contact-icon flex-shrink-0"><i class="bi bi-telephone"></i></div>
                        <div>
                            <div class="fw-semibold" style="color:var(--primary)">Telepon</div>
                            <a href="tel:{{ $phone }}" class="text-muted text-decoration-none">{{ $phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($email)
                    <div class="d-flex gap-3 align-items-start">
                        <div class="contact-icon flex-shrink-0"><i class="bi bi-envelope"></i></div>
                        <div>
                            <div class="fw-semibold" style="color:var(--primary)">Email</div>
                            <a href="mailto:{{ $email }}" class="text-muted text-decoration-none">{{ $email }}</a>
                        </div>
                    </div>
                    @endif
                    @if($wa)
                    <div class="d-flex gap-3 align-items-start">
                        <div class="contact-icon flex-shrink-0" style="background:rgba(37,211,102,0.1);color:#25d366"><i class="bi bi-whatsapp"></i></div>
                        <div>
                            <div class="fw-semibold" style="color:var(--primary)">WhatsApp</div>
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}" target="_blank" class="text-muted text-decoration-none">{{ $wa }}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="mb-4" style="color:var(--primary)">Kirim Pesan</h4>
                        @if(session('contact_sent'))
                            <div class="alert alert-success">Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.</div>
                        @endif
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nama Anda" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" placeholder="+62 8xx-xxxx-xxxx" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-medium">Email</label>
                                    <input type="email" class="form-control" placeholder="email@example.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-medium">Subjek</label>
                                    <select class="form-select">
                                        <option value="">Pilih Subjek</option>
                                        <option>Konsultasi Properti</option>
                                        <option>Tanya Harga</option>
                                        <option>Kunjungan Lokasi</option>
                                        <option>Kerjasama</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-medium">Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" placeholder="Ceritakan kebutuhan properti Anda..." required></textarea>
                                </div>
                                <div class="col-12">
                                    @php $wa = \App\Models\Setting::get('social_whatsapp'); @endphp
                                    @if($wa)
                                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}" target="_blank" class="btn btn-gold px-4">
                                        <i class="bi bi-whatsapp me-2"></i>Chat via WhatsApp
                                    </a>
                                    @else
                                    <button type="submit" class="btn btn-gold px-4">
                                        <i class="bi bi-send me-2"></i>Kirim Pesan
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
