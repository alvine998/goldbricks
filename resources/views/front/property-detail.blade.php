@extends('layouts.public')
@section('title', $property->title)

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>{{ $property->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menu_home ?? 'Home' }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('project') }}">{{ $menu_project ?? 'Project' }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('project.show', $project->slug) }}">{{ $project->title }}</a></li>
                <li class="breadcrumb-item active">{{ $property->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" role="tablist" style="border-bottom: 2px solid var(--gold)">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="lihat-tab" data-bs-toggle="tab" data-bs-target="#lihat" type="button" role="tab" aria-controls="lihat" aria-selected="true" style="color: var(--primary); font-weight: 600">
                    <i class="bi bi-eye me-2"></i>Lihat
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hubungi-tab" data-bs-toggle="tab" data-bs-target="#hubungi" type="button" role="tab" aria-controls="hubungi" aria-selected="false" style="color: var(--primary); font-weight: 600">
                    <i class="bi bi-chat-dots me-2"></i>Hubungi
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Lihat (View) Tab -->
            <div class="tab-pane fade show active" id="lihat" role="tabpanel" aria-labelledby="lihat-tab">
                <div class="row g-5">
                    <div class="col-lg-8">
                        <!-- Property Image -->
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" class="img-fluid rounded-3 w-100 mb-4 main-image" style="max-height:500px;object-fit:cover" alt="{{ $property->title }}">
                        @elseif(!empty($property->images) && is_array($property->images) && count($property->images) > 0)
                            <img src="{{ asset('storage/' . $property->images[0]) }}" class="img-fluid rounded-3 w-100 mb-4 main-image" style="max-height:500px;object-fit:cover" alt="{{ $property->title }}">
                        @else
                            <div class="rounded-3 mb-4 d-flex align-items-center justify-content-center" style="height:400px;background:linear-gradient(135deg,var(--primary),var(--primary-light))">
                                <i class="bi bi-building text-white opacity-25" style="font-size:6rem"></i>
                            </div>
                        @endif

                        <!-- Image Gallery -->
                        @if(!empty($property->images) && is_array($property->images) && count($property->images) > 0)
                        <div class="row g-2 mb-4">
                            @foreach($property->images as $idx => $img)
                            <div class="col-md-3 col-4">
                                <img src="{{ asset('storage/' . $img) }}" class="img-fluid rounded-2 gallery-thumb" style="height:100px;object-fit:cover;cursor:pointer;border:2px solid transparent;transition:all 0.3s" onclick="changeMainImage(this)" alt="{{ $property->title }}">
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Property Description -->
                        <h3 class="mb-3" style="color:var(--primary)">Deskripsi Properti</h3>
                        <div class="divider-gold mb-4"></div>
                        <div class="text-muted" style="line-height:1.9">
                            {!! nl2br(e($property->description ?? 'Tidak ada deskripsi tersedia.')) !!}
                        </div>

                        <!-- Property Details Grid -->
                        <div class="row mt-5 g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-3" style="background:rgba(26,92,58,0.05)">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="contact-icon" style="width:45px;height:45px;font-size:1.3rem"><i class="bi bi-tag"></i></div>
                                        <div>
                                            <div class="text-muted small fw-medium">Tipe Properti</div>
                                            <div class="fs-5 fw-bold" style="color:var(--primary)">{{ $property->getTypeLabel() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-3" style="background:rgba(26,92,58,0.05)">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="contact-icon" style="width:45px;height:45px;font-size:1.3rem"><i class="bi bi-circle"></i></div>
                                        <div>
                                            <div class="text-muted small fw-medium">Status</div>
                                            <span class="badge fs-6 {{ $property->status === 'available' ? 'bg-success' : ($property->status === 'reserved' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                {{ $property->getStatusLabel() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($property->price)
                            <div class="col-md-6">
                                <div class="p-4 rounded-3" style="background:rgba(26,92,58,0.05)">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="contact-icon" style="width:45px;height:45px;font-size:1.3rem"><i class="bi bi-cash-coin"></i></div>
                                        <div>
                                            <div class="text-muted small fw-medium">Harga</div>
                                            <div class="fs-5 fw-bold" style="color:var(--gold)">Rp {{ number_format($property->price, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($property->location)
                            <div class="col-md-6">
                                <div class="p-4 rounded-3" style="background:rgba(26,92,58,0.05)">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="contact-icon" style="width:45px;height:45px;font-size:1.3rem"><i class="bi bi-geo-alt"></i></div>
                                        <div>
                                            <div class="text-muted small fw-medium">Lokasi</div>
                                            <div class="fw-medium">{{ $property->location }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Project Info -->
                        <div class="mt-5 pt-4 border-top">
                            <h4 class="mb-3" style="color:var(--primary)">Proyek: {{ $project->title }}</h4>
                            <p class="text-muted">{{ Str::limit($project->description, 200) }}</p>
                            <a href="{{ route('project.show', $project->slug) }}" class="btn btn-outline-gold">
                                <i class="bi bi-arrow-right me-2"></i>Lihat Proyek Lengkap
                            </a>
                        </div>

                        <!-- Related Properties -->
                        @if($related->count())
                        <div class="mt-5 pt-4 border-top">
                            <h4 class="mb-4" style="color:var(--primary)">Properti Lainnya di Proyek Ini</h4>
                            <div class="row g-4">
                                @foreach($related as $item)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100 transition-all" style="cursor:pointer" onclick="window.location.href='{{ route('property.show', $item->slug) }}'">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" style="height:180px;object-fit:cover" alt="{{ $item->title }}">
                                        @elseif(!empty($item->images) && is_array($item->images) && count($item->images) > 0)
                                            <img src="{{ asset('storage/' . $item->images[0]) }}" class="card-img-top" style="height:180px;object-fit:cover" alt="{{ $item->title }}">
                                        @else
                                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height:180px;background:linear-gradient(135deg,rgba(26,92,58,0.1),rgba(42,138,82,0.1))">
                                                <i class="bi bi-image text-muted" style="font-size:2.5rem;opacity:0.3"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex gap-2 mb-2">
                                                <span class="badge" style="background:rgba(26,92,58,0.1);color:var(--primary)">{{ $item->getTypeLabel() }}</span>
                                                <span class="badge {{ $item->status === 'available' ? 'bg-success' : ($item->status === 'reserved' ? 'bg-warning text-dark' : 'bg-danger') }}">{{ $item->getStatusLabel() }}</span>
                                            </div>
                                            <h6 class="card-title" style="color:var(--primary)">{{ $item->title }}</h6>
                                            @if($item->price)
                                                <p class="mb-2" style="color:var(--gold);font-weight:600;font-size:0.95rem">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                            @endif
                                            @if($item->location)
                                                <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1"></i>{{ Str::limit($item->location, 30) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm sticky-top" style="top:80px;z-index:10">
                            <div class="card-body p-4">
                                <h5 class="mb-1" style="color:var(--primary)">{{ $property->title }}</h5>
                                @if($property->price)
                                    <p class="price fs-4 mb-3" style="color:var(--gold);font-weight:700">Rp {{ number_format($property->price, 0, ',', '.') }}</p>
                                @endif
                                <hr>

                                <!-- Quick Info -->
                                @if($property->type)
                                <div class="d-flex gap-3 mb-3">
                                    <div class="contact-icon" style="width:38px;height:38px;font-size:1rem"><i class="bi bi-tag"></i></div>
                                    <div>
                                        <div class="text-muted small">Tipe</div>
                                        <div class="fw-medium">{{ $property->getTypeLabel() }}</div>
                                    </div>
                                </div>
                                @endif

                                @if($property->status)
                                <div class="d-flex gap-3 mb-3">
                                    <div class="contact-icon" style="width:38px;height:38px;font-size:1rem"><i class="bi bi-circle"></i></div>
                                    <div>
                                        <div class="text-muted small">Status</div>
                                        <span class="badge {{ $property->status === 'available' ? 'bg-success' : ($property->status === 'reserved' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                            {{ $property->getStatusLabel() }}
                                        </span>
                                    </div>
                                </div>
                                @endif

                                @if($property->location)
                                <div class="d-flex gap-3 mb-4">
                                    <div class="contact-icon" style="width:38px;height:38px;font-size:1rem"><i class="bi bi-geo-alt"></i></div>
                                    <div>
                                        <div class="text-muted small">Lokasi</div>
                                        <div class="fw-medium">{{ $property->location }}</div>
                                    </div>
                                </div>
                                @endif

                                <!-- Project Info -->
                                <div class="p-3 rounded-3 mb-4" style="background:rgba(26,92,58,0.05)">
                                    <div class="text-muted small mb-1">Bagian dari Proyek:</div>
                                    <div class="fw-bold" style="color:var(--primary)">{{ $project->title }}</div>
                                </div>
                                <a href="{{ route('project.show', $project->slug) }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Proyek
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hubungi (Contact) Tab -->
            <div class="tab-pane fade" id="hubungi" role="tabpanel" aria-labelledby="hubungi-tab">
                <div class="row g-5">
                    <div class="col-lg-8">
                        <h3 class="mb-4" style="color:var(--primary)">Hubungi Kami</h3>
                        <p class="text-muted mb-4" style="line-height:1.8">
                            Tertarik dengan properti <strong>{{ $property->title }}</strong>? 
                            Hubungi tim profesional kami melalui salah satu pilihan di bawah ini untuk mendapatkan informasi lebih lengkap dan konsultasi gratis.
                        </p>

                        <!-- Contact Methods -->
                        <div class="row g-4 mb-5">
                            <!-- Agents from Project -->
                            @php $agentsList = $project->agents()->limit(5)->get(); @endphp
                            @if($agentsList->count() > 0)
                                @foreach($agentsList as $agent)
                                <div class="col-md-6">
                                    <a href="https://wa.me/{{ $agent->whatsapp ?? \App\Models\Setting::get('social_whatsapp', '') }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($property->title) }}%20di%20proyek%20{{ urlencode($project->title) }}" target="_blank" style="text-decoration:none">
                                        <div class="card border-0 shadow-sm h-100 transition-all" style="cursor:pointer">
                                            <div class="card-body p-4 text-center">
                                                <div class="mb-3">
                                                    @if($agent->photo)
                                                        <img src="{{ str_starts_with($agent->photo, 'http') ? $agent->photo : asset('storage/' . $agent->photo) }}" class="rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid var(--gold)" alt="{{ $agent->name }}">
                                                    @else
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width:80px;height:80px;background:var(--primary);color:white;font-size:2rem;border:3px solid var(--gold)">
                                                            {{ substr($agent->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <h5 class="card-title mb-1" style="color:var(--primary)">{{ $agent->name }}</h5>
                                                <p class="text-muted small mb-3">{{ $agent->position }}</p>
                                                @if($agent->whatsapp)
                                                    <p class="text-muted small mb-0"><i class="bi bi-telephone me-2"></i>{{ substr($agent->whatsapp, -10) }}</p>
                                                @endif
                                                <div class="mt-3">
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-whatsapp me-1"></i>Chat
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            @elseif($project->pic_phone)
                                <!-- Fallback to PIC if no agents -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100 transition-all" style="cursor:pointer" onclick="window.open('https://wa.me/{{ $project->pic_phone }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($property->title) }}%20di%20proyek%20{{ urlencode($project->title) }}', '_blank')">
                                        <div class="card-body p-4 text-center">
                                            <div class="mb-3">
                                                <i class="bi bi-whatsapp" style="font-size:3rem;color:#25D366"></i>
                                            </div>
                                            <h5 class="card-title mb-1">{{ $project->pic_name ?? 'Tim Kami' }}</h5>
                                            <p class="text-muted small mb-3">Sales Professional</p>
                                            <p class="text-muted small mb-0"><i class="bi bi-telephone me-2"></i>{{ $project->pic_phone }}</p>
                                            <div class="mt-3">
                                                <span class="badge bg-success">Biasanya Online</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- WhatsApp Support -->
                            @php $whatsapp = \App\Models\Setting::get('social_whatsapp'); @endphp
                            @if($whatsapp)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100 transition-all" style="cursor:pointer" onclick="window.open('https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($property->title) }}%20di%20proyek%20{{ urlencode($project->title) }}', '_blank')">
                                    <div class="card-body p-4 text-center">
                                        <div class="mb-3">
                                            <i class="bi bi-whatsapp" style="font-size:3rem;color:#25D366"></i>
                                        </div>
                                        <h5 class="card-title mb-1">Goldbricks Realtors</h5>
                                        <p class="text-muted small mb-3">Customer Service</p>
                                        <p class="text-muted small mb-0"><i class="bi bi-telephone me-2"></i>{{ $whatsapp }}</p>
                                        <div class="mt-3">
                                            <span class="badge bg-success">Siap Membantu</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Contact Form -->
                        <h5 class="mb-3" style="color:var(--primary)">Atau Kirim Pesan Langsung</h5>
                        <div class="card border-0 shadow-sm p-4">
                            <form action="{{ route('contact') }}" method="POST">
                                @csrf
                                <input type="hidden" name="source" value="property_detail">
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <input type="hidden" name="property_title" value="{{ $property->title }}">

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Nomor Telepon</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="08123456789" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Pesan</label>
                                    <textarea name="message" class="form-control" rows="5" placeholder="Tulis pertanyaan atau komentar Anda tentang properti ini..." required></textarea>
                                </div>

                                <button type="submit" class="btn btn-gold w-100">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm sticky-top" style="top:80px;z-index:10">
                            <div class="card-body p-4">
                                <h5 class="mb-3" style="color:var(--primary)">Ringkasan Properti</h5>
                                <hr>

                                <div class="mb-4">
                                    <div class="text-muted small fw-medium mb-1">Properti</div>
                                    <div class="fw-bold">{{ $property->title }}</div>
                                </div>

                                @if($property->price)
                                <div class="mb-4">
                                    <div class="text-muted small fw-medium mb-1">Harga</div>
                                    <div class="fw-bold" style="color:var(--gold);font-size:1.1rem">Rp {{ number_format($property->price, 0, ',', '.') }}</div>
                                </div>
                                @endif

                                <div class="mb-4">
                                    <div class="text-muted small fw-medium mb-1">Tipe</div>
                                    <div class="fw-bold">{{ $property->getTypeLabel() }}</div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-muted small fw-medium mb-1">Status</div>
                                    <span class="badge {{ $property->status === 'available' ? 'bg-success' : ($property->status === 'reserved' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ $property->getStatusLabel() }}
                                    </span>
                                </div>

                                @if($property->location)
                                <div class="mb-4">
                                    <div class="text-muted small fw-medium mb-1">Lokasi</div>
                                    <div class="fw-bold">{{ $property->location }}</div>
                                </div>
                                @endif

                                <div class="p-3 rounded-3" style="background:rgba(26,92,58,0.05)">
                                    <div class="text-muted small mb-1">Bagian dari Proyek:</div>
                                    <div class="fw-bold mb-3" style="color:var(--primary)">{{ $project->title }}</div>
                                    <a href="{{ route('project.show', $project->slug) }}" class="btn btn-sm btn-outline-gold w-100">
                                        Lihat Proyek
                                    </a>
                                </div>

                                <hr class="my-4">

                                <div class="small text-muted">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Waktu respons kami biasanya dalam hitungan menit selama jam kerja.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS for transitions -->
<style>
    .transition-all {
        transition: all 0.3s ease;
    }
    .transition-all:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
    }
    .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }
    .nav-link.active {
        border-bottom-color: var(--gold) !important;
        background: transparent !important;
    }
    .nav-link:hover {
        background: rgba(26, 92, 58, 0.05);
    }
    .gallery-thumb {
        transition: all 0.3s ease;
    }
    .gallery-thumb:hover {
        border-color: var(--primary) !important;
        transform: scale(1.05);
    }
</style>

<script>
function changeMainImage(element) {
    const mainImage = document.querySelector('.main-image');
    const src = element.src;
    mainImage.src = src;
    
    // Update active state
    document.querySelectorAll('.gallery-thumb').forEach(thumb => {
        thumb.style.borderColor = 'transparent';
    });
    element.style.borderColor = 'var(--primary)';
}

function removeImage(button, imagePath) {
    button.parentElement.remove();
}
</script>
@endsection
