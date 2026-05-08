@extends('layouts.public')
@section('title', $project->title)

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menu_home ?? 'Home' }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('project') }}">{{ $menu_project ?? 'Project' }}</a></li>
                <li class="breadcrumb-item active">{{ $project->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" class="img-fluid rounded-3 w-100 mb-4" style="max-height:450px;object-fit:cover" alt="{{ $project->title }}">
                @elseif(!empty($project->images) && is_array($project->images) && count($project->images) > 0)
                    <img src="{{ asset('storage/' . $project->images[0]) }}" class="img-fluid rounded-3 w-100 mb-4" style="max-height:450px;object-fit:cover" alt="{{ $project->title }}">
                @else
                    <div class="rounded-3 mb-4 d-flex align-items-center justify-content-center" style="height:350px;background:linear-gradient(135deg,var(--primary),var(--primary-light))">
                        <i class="bi bi-building text-white opacity-25" style="font-size:6rem"></i>
                    </div>
                @endif
                
                <!-- Image Gallery -->
                @if(!empty($project->images) && is_array($project->images) && count($project->images) > 0)
                <div class="row g-2 mb-4">
                    @foreach($project->images as $idx => $img)
                    <div class="col-md-3 col-4">
                        <img src="{{ asset('storage/' . $img) }}" class="img-fluid rounded-2" style="height:100px;object-fit:cover;cursor:pointer" onclick="document.querySelector('img.img-fluid.rounded-3').src='{{ asset('storage/' . $img) }}';" alt="{{ $project->title }}">
                    </div>
                    @endforeach
                </div>
                @endif
                
                <h2 class="mb-3" style="color:var(--primary)">Deskripsi Proyek</h2>
                <div class="divider-gold"></div>
                <div class="text-muted" style="line-height:1.9">
                    {!! nl2br(e($project->description ?? 'Tidak ada deskripsi tersedia.')) !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top:80px;z-index:10">
                    <div class="card-body p-4">
                        <h5 class="mb-1" style="color:var(--primary)">{{ $project->title }}</h5>
                        @if($project->price)
                            <p class="price fs-5 mb-3">{{ $project->price }}</p>
                        @endif
                        <hr>
                        @if($project->location)
                        <div class="d-flex gap-3 mb-3">
                            <div class="contact-icon" style="width:38px;height:38px;font-size:1rem"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <div class="text-muted small">Lokasi</div>
                                <div class="fw-medium">{{ $project->location }}</div>
                            </div>
                        </div>
                        @endif
                        @if($project->type)
                        <div class="d-flex gap-3 mb-3">
                            <div class="contact-icon" style="width:38px;height:38px;font-size:1rem"><i class="bi bi-tag"></i></div>
                            <div>
                                <div class="text-muted small">Tipe</div>
                                <div class="fw-medium">{{ ucfirst($project->type) }}</div>
                            </div>
                        </div>
                        @endif
                        <div class="d-flex gap-3 mb-4">
                            <div class="contact-icon" style="width:38px;height:38px;font-size:1rem"><i class="bi bi-circle"></i></div>
                            <div>
                                <div class="text-muted small">Status</div>
                                <span class="badge {{ $project->status === 'available' ? 'bg-success' : ($project->status === 'upcoming' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                    {{ $project->status === 'available' ? 'Tersedia' : ($project->status === 'upcoming' ? 'Segera Hadir' : 'Terjual') }}
                                </span>
                            </div>
                        </div>
                        @if($project->pic_name)
                        <div class="d-flex gap-3 mb-4">
                            <div class="contact-icon" style="width:38px;height:38px;font-size:1rem"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="text-muted small">Person In Charge</div>
                                <div class="fw-medium">{{ $project->pic_name }}</div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Chat Buttons -->
                        @php $agents = $project->agents()->limit(5)->get(); @endphp
                        @if($agents->count() > 0)
                            <!-- Multiple PICs Dropdown -->
                            <div class="dropdown mb-2">
                                <button class="btn btn-gold w-100 dropdown-toggle" type="button" id="picDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-whatsapp me-2"></i>Chat dengan Tim Kami
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="picDropdown" style="min-width:250px">
                                    @foreach($agents as $agent)
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2" href="https://wa.me/{{ $agent->whatsapp ?? \App\Models\Setting::get('social_whatsapp', '') }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($project->title) }}" target="_blank">
                                                @if($agent->photo)
                                                    <img src="{{ str_starts_with($agent->photo, 'http') ? $agent->photo : asset('storage/' . $agent->photo) }}" class="rounded-circle" style="width:36px;height:36px;object-fit:cover" alt="{{ $agent->name }}">
                                                @else
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:var(--primary);color:white;font-size:0.9rem">
                                                        {{ substr($agent->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-medium" style="color:var(--primary)">{{ $agent->name }}</div>
                                                    <small class="text-muted">{{ $agent->position }}</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif($project->pic_phone)
                            <!-- Single PIC (legacy) -->
                            <a href="https://wa.me/{{ $project->pic_phone }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($project->title) }}" target="_blank" class="btn btn-gold w-100 mb-2">
                                <i class="bi bi-whatsapp me-2"></i>Chat dengan {{ $project->pic_name }}
                            </a>
                        @else
                            <!-- Default WhatsApp -->
                            @php $whatsapp = \App\Models\Setting::get('social_whatsapp'); @endphp
                            @if($whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($project->title) }}" target="_blank" class="btn btn-gold w-100 mb-2">
                                <i class="bi bi-whatsapp me-2"></i>Chat via WhatsApp
                            </a>
                            @endif
                        @endif
                        <a href="{{ route('contact') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-envelope me-2"></i>Kirim Pesan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Unit/Properti -->
        @if($properties->count())
        <div class="mt-5 pt-4 border-top">
            <h3 class="mb-4" style="color:var(--primary)">Daftar Unit/Properti</h3>
            <div class="row g-4">
                @foreach($properties as $property)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top" style="height:200px;object-fit:cover" alt="{{ $property->title }}">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height:200px;background:linear-gradient(135deg,rgba(26,92,58,0.1),rgba(42,138,82,0.1))">
                                <i class="bi bi-image text-muted" style="font-size:3rem;opacity:0.3"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex gap-2 mb-2">
                                <span class="badge" style="background:rgba(26,92,58,0.1);color:var(--primary)">{{ $property->getTypeLabel() }}</span>
                                <span class="badge {{ $property->status === 'available' ? 'bg-success' : ($property->status === 'reserved' ? 'bg-warning text-dark' : 'bg-danger') }}">{{ $property->getStatusLabel() }}</span>
                            </div>
                            <h5 class="card-title" style="color:var(--primary)">{{ $property->title }}</h5>
                            @if($property->price)
                                <p class="price mb-2" style="color:var(--gold);font-weight:600">Rp {{ number_format($property->price, 0, ',', '.') }}</p>
                            @endif
                            @if($property->description)
                                <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit($property->description, 80) }}</p>
                            @endif
                            @if($property->location)
                                <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1"></i>{{ $property->location }}</p>
                            @endif
                            <!-- Agent Dropdown for Property -->
                            @php $agentsList = $project->agents()->limit(5)->get(); @endphp
                            @if($agentsList->count() > 0)
                                <div class="dropdown mb-2 w-100">
                                    <button class="btn btn-sm btn-gold w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-whatsapp me-1"></i>Hubungi
                                    </button>
                                    <ul class="dropdown-menu w-100" style="min-width:200px">
                                        @foreach($agentsList as $agent)
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="https://wa.me/{{ $agent->whatsapp ?? \App\Models\Setting::get('social_whatsapp', '') }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($property->title) }}%20di%20proyek%20{{ urlencode($project->title) }}" target="_blank">
                                                    @if($agent->photo)
                                                        <img src="{{ str_starts_with($agent->photo, 'http') ? $agent->photo : asset('storage/' . $agent->photo) }}" class="rounded-circle" style="width:28px;height:28px;object-fit:cover" alt="{{ $agent->name }}">
                                                    @else
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px;height:28px;background:var(--primary);color:white;font-size:0.75rem;flex-shrink:0">
                                                            {{ substr($agent->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div class="text-start" style="font-size:0.9rem">
                                                        <div class="fw-medium" style="color:var(--primary)">{{ $agent->name }}</div>
                                                        <small class="text-muted">{{ $agent->position }}</small>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <a href="https://wa.me/{{ $project->pic_phone ?? \App\Models\Setting::get('social_whatsapp', '') }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($property->title) }}%20di%20proyek%20{{ urlencode($project->title) }}" target="_blank" class="btn btn-sm btn-gold w-100 mb-2">
                                    <i class="bi bi-whatsapp me-1"></i>Hubungi
                                </a>
                            @endif
                            <a href="{{ route('property.show', $property->slug) }}" class="btn btn-sm btn-outline-secondary w-100 mt-2">
                                <i class="bi bi-eye me-1"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Related Projects -->
        @if($related->count())
        <div class="mt-5 pt-4 border-top">
            <h3 class="mb-4" style="color:var(--primary)">Proyek Terkait</h3>
            <div class="row g-4">
                @foreach($related as $rel)
                <div class="col-md-4">
                    <div class="card project-card">
                        @if($rel->image)
                            <img src="{{ asset('storage/' . $rel->image) }}" class="card-img-top" alt="{{ $rel->title }}">
                        @elseif(!empty($rel->images) && is_array($rel->images) && count($rel->images) > 0)
                            <img src="{{ asset('storage/' . $rel->images[0]) }}" class="card-img-top" alt="{{ $rel->title }}">
                        @else
                            <div class="card-img-placeholder"><i class="bi bi-building"></i></div>
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $rel->title }}</h6>
                            @if($rel->price)<p class="price small">{{ $rel->price }}</p>@endif
                            <a href="{{ route('project.show', $rel->slug) }}" class="btn btn-sm btn-gold w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
