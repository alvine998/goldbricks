@extends('layouts.public')
@section('title', $menu_project ?? 'Project')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>{{ $page->hero_title ?? ($menu_project ?? 'Proyek Kami') }}</h1>
        @if($page && $page->hero_subtitle)
            <p style="color:rgba(255,255,255,0.75);max-width:600px">{{ $page->hero_subtitle }}</p>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menu_home ?? 'Home' }}</a></li>
                <li class="breadcrumb-item active">{{ $menu_project ?? 'Project' }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5 bg-light-custom">
    <div class="container">
        @if($projects->count())
            <div class="row g-4">
                @foreach($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <div class="card project-card h-100">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="{{ $project->title }}" loading="lazy" width="400" height="250">
                        @elseif(!empty($project->images) && is_array($project->images) && count($project->images) > 0)
                            <img src="{{ asset('storage/' . $project->images[0]) }}" class="card-img-top" alt="{{ $project->title }}" loading="lazy" width="400" height="250">
                        @else
                            <div class="card-img-placeholder"><i class="bi bi-building"></i></div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                @if($project->type)
                                    <span class="badge bg-primary bg-opacity-10 text-primary badge-status">{{ ucfirst($project->type) }}</span>
                                @else
                                    <span></span>
                                @endif
                                <span class="badge {{ $project->status === 'available' ? 'bg-success' : ($project->status === 'upcoming' ? 'bg-warning text-dark' : 'bg-secondary') }} badge-status">
                                    {{ $project->status === 'available' ? 'Tersedia' : ($project->status === 'upcoming' ? 'Segera' : 'Terjual') }}
                                </span>
                            </div>
                            <h5 class="card-title">{{ $project->title }}</h5>
                            @if($project->location)
                                <p class="location mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $project->location }}</p>
                            @endif
                            @if($project->price)
                                <p class="price mb-2"><span class="text-muted small">Mulai dari</span> {{ $project->price }}</p>
                            @endif
                            @if($project->description)
                                <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit($project->description, 100) }}</p>
                            @endif
                            @if($project->pic_name)
                                <div class="d-flex align-items-center gap-2 mb-3 pb-3 border-top">
                                    <i class="bi bi-person-circle text-gold"></i>
                                    <div style="font-size:0.85rem">
                                        <div class="fw-medium text-dark">{{ $project->pic_name }}</div>
                                        @if($project->pic_phone)
                                            <a href="https://wa.me/{{ $project->pic_phone }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($project->title) }}" target="_blank" class="text-gold text-decoration-none small">
                                                <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <a href="{{ route('project.show', $project->slug) }}" class="btn btn-gold btn-sm w-100 mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-building text-muted" style="font-size:4rem;opacity:0.3"></i>
                <p class="text-muted mt-3">Belum ada proyek yang tersedia.</p>
            </div>
        @endif
    </div>
</section>
@endsection
