@extends('layouts.public')
@section('title', $menu_about ?? 'About Us')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>{{ $page->hero_title ?? ($menu_about ?? 'Tentang Kami') }}</h1>
        @if($page && $page->hero_subtitle)
        <p style="color:rgba(255,255,255,0.75);max-width:600px">{{ $page->hero_subtitle }}</p>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menu_home ?? 'Beranda' }}</a></li>
                <li class="breadcrumb-item active">{{ $menu_about ?? 'Tentang Kami' }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="section-badge">Tentang Kami</span>
                <h2 class="section-title">{{ $page->section_title ?? 'Goldbricks Realtors' }}</h2>
                <div class="divider-gold"></div>
                <div class="text-muted" style="line-height:1.9">
                    {!! nl2br(e($page->content ?? 'Goldbricks Realtors Indonesia adalah agen properti terpercaya yang telah melayani kebutuhan properti Indonesia selama lebih dari 15 tahun. Kami berkomitmen untuk memberikan pelayanan terbaik dalam membantu Anda menemukan properti impian dengan lokasi strategis dan harga terbaik.')) !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    @foreach([
                    ['icon' => 'shield-check', 'title' => 'Terpercaya', 'desc' => 'Agen properti berlisensi dengan rekam jejak yang terbukti.'],
                    ['icon' => 'graph-up', 'title' => 'Berpengalaman', 'desc' => 'Lebih dari 15 tahun pengalaman di industri properti Indonesia.'],
                    ['icon' => 'people', 'title' => 'Profesional', 'desc' => 'Tim agen profesional yang siap melayani kebutuhan Anda.'],
                    ['icon' => 'heart', 'title' => 'Berorientasi Klien', 'desc' => 'Kepuasan klien adalah prioritas utama kami.'],
                    ] as $item)
                    <div class="col-6">
                        <div class="p-4 rounded-3 h-100" style="background:var(--light-bg)">
                            <div class="contact-icon mb-3">
                                <i class="bi bi-{{ $item['icon'] }}"></i>
                            </div>
                            <h6 style="color:var(--primary)">{{ $item['title'] }}</h6>
                            <p class="text-muted small mb-0">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision Mission -->
<section class="py-5 bg-light-custom">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Visi & Misi</span>
            <h2 class="section-title">Komitmen Kami</h2>
            <div class="divider-gold center"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="contact-icon mb-3" style="background:rgba(26,60,94,0.1);color:var(--primary)">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h4 style="color:var(--primary)">Visi</h4>
                        <div class="divider-gold" style="width:40px"></div>
                        <p class="text-muted">Menjadi agen properti terkemuka dan terpercaya di Indonesia yang memberikan solusi properti terbaik bagi setiap keluarga dan bisnis.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="contact-icon mb-3" style="background:rgba(26,60,94,0.1);color:var(--primary)">
                            <i class="bi bi-flag"></i>
                        </div>
                        <h4 style="color:var(--primary)">Misi</h4>
                        <div class="divider-gold" style="width:40px"></div>
                        <ul class="text-muted ps-3">
                            <li class="mb-2">Menyediakan properti berkualitas tinggi di lokasi strategis.</li>
                            <li class="mb-2">Memberikan pelayanan profesional dan transparan.</li>
                            <li class="mb-2">Membangun kepercayaan melalui integritas dan konsistensi.</li>
                            <li>Menghadirkan kemudahan dalam setiap transaksi properti.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Organisasi -->
@if($organizations->count())
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Tim Kami</span>
            <h2 class="section-title">Struktur Organisasi</h2>
            <div class="divider-gold center"></div>
            <p class="text-muted mx-auto" style="max-width:500px">Kami memiliki tim profesional yang berpengalaman dan berkomitmen untuk memberikan pelayanan terbaik kepada Anda.</p>
        </div>
        <div class="row g-4">
            @foreach($organizations as $org)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 h-100 text-center shadow-sm" style="transition:all 0.3s">
                    <div class="card-body p-4">
                        @if($org->photo)
                        <img src="{{ asset('storage/' . $org->photo) }}" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;border:3px solid var(--gold)" alt="{{ $org->name }}">
                        @else
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:100px;height:100px;background:linear-gradient(135deg,var(--primary),var(--primary-light));font-size:2rem;color:rgba(255,255,255,0.3)">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        @endif
                        <h5 class="card-title fw-semibold" style="color:var(--primary)">{{ $org->name }}</h5>
                        <p class="text-gold fw-medium small mb-2" style="letter-spacing:0.5px">{{ $org->position }}</p>
                        @if($org->description)
                        <p class="text-muted small" style="line-height:1.6">{{ $org->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Meet Our Agents -->
@if($agents->count())
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Tim Agen Kami</span>
            <h2 class="section-title">Meet Our Agents</h2>
            <div class="divider-gold center"></div>
            <p class="text-muted mx-auto" style="max-width:480px">Be Sure, You are with Us</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($agents as $agent)
            <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                <div class="agent-card text-center">
                    <div class="agent-photo-wrap">
                        @if($agent->photo)
                        <img src="{{ asset('storage/' . $agent->photo) }}" alt="{{ $agent->name }}">
                        @else
                        <div class="agent-photo-placeholder">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        @endif
                        <!-- Social overlay -->
                        <div class="agent-social-overlay">
                            @if($agent->facebook)
                            <a href="{{ $agent->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if($agent->twitter)
                            <a href="{{ $agent->twitter }}" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            @endif
                            @if($agent->linkedin)
                            <a href="{{ $agent->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                            @endif
                            @if($agent->pinterest)
                            <a href="{{ $agent->pinterest }}" target="_blank"><i class="bi bi-pinterest"></i></a>
                            @endif
                            @if($agent->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/\D/','',$agent->whatsapp) }}" target="_blank"><i class="bi bi-whatsapp"></i></a>
                            @endif
                        </div>
                        <!-- Name on photo -->
                        <div class="agent-name-bar">
                            <div class="agent-name">{{ $agent->name }}</div>
                            @if($agent->position)<div class="agent-pos">{{ $agent->position }}</div>@endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
    .agent-card {
        padding: 0 0.5rem;
    }

    .agent-photo-wrap {
        position: relative;
        border-radius: 50%;
        overflow: hidden;
        aspect-ratio: 1/1;
        width: 100%;
        max-width: 220px;
        margin: 0 auto;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
        cursor: pointer;
    }

    .agent-photo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s;
    }

    .agent-photo-wrap:hover img {
        transform: scale(1.06);
    }

    .agent-photo-placeholder {
        width: 100%;
        height: 100%;
        background: var(--gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: rgba(0, 0, 0, 0.2);
    }

    /* name bar at bottom of circle */
    .agent-name-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.72) 70%, transparent);
        padding: 1.5rem 0.5rem 0.75rem;
        text-align: center;
    }

    .agent-name {
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        line-height: 1.2;
    }

    .agent-pos {
        color: var(--gold);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-top: 2px;
    }

    /* social overlay on hover */
    .agent-social-overlay {
        position: absolute;
        inset: 0;
        background: rgba(201, 168, 76, 0.88);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 50%;
        flex-direction: column;
    }

    .agent-photo-wrap:hover .agent-social-overlay {
        opacity: 1;
    }

    .agent-social-overlay a {
        color: #fff;
        font-size: 1.4rem;
        transition: transform 0.2s;
    }

    .agent-social-overlay a:hover {
        transform: scale(1.2);
    }

    /* when no socials, hide overlay */
    .agent-social-overlay:empty {
        display: none;
    }

    @media (max-width: 575px) {
        .agent-name {
            font-size: 0.85rem;
        }
    }
</style>
@endpush
@endif
@endsection