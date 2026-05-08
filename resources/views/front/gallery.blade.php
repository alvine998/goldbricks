@extends('layouts.public')
@section('title', $menu_gallery ?? 'Gallery')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>{{ $page->hero_title ?? ($menu_gallery ?? 'Galeri') }}</h1>
        @if($page && $page->hero_subtitle)
            <p style="color:rgba(255,255,255,0.75)">{{ $page->hero_subtitle }}</p>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menu_home ?? 'Home' }}</a></li>
                <li class="breadcrumb-item active">{{ $menu_gallery ?? 'Gallery' }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if($gallery->count())
            <div class="row g-3">
                @foreach($gallery as $item)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal"
                         data-title="{{ $item->title }}"
                         data-desc="{{ $item->description }}"
                         data-images="{{ json_encode(!empty($item->images) && is_array($item->images) ? $item->images : [$item->image]) }}"
                         onclick="showGalleryModal(this)">
                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Galeri' }}" loading="lazy" width="300" height="250">
                        <div class="gallery-overlay">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                    </div>
                    @if($item->title)
                        <p class="text-muted small mt-1 text-center">{{ $item->title }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-images text-muted" style="font-size:4rem;opacity:0.3"></i>
                <p class="text-muted mt-3">Belum ada foto di galeri.</p>
            </div>
        @endif
    </div>
</section>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-dark" id="galleryModalTitle"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center position-relative">
                <img id="galleryModalImg" src="" class="img-fluid rounded" alt="" style="max-height:70vh;object-fit:cover">
                <p id="galleryModalDesc" class="text-muted small mt-2 mb-0"></p>
                <!-- Image counter -->
                <small class="text-muted" id="imageCounter" style="display:none;margin-top:0.5rem"></small>
                <!-- Navigation buttons -->
                <button type="button" id="prevBtn" class="btn btn-sm btn-dark position-absolute start-0 top-50 translate-middle-y ms-2" style="display:none;z-index:10">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" id="nextBtn" class="btn btn-sm btn-dark position-absolute end-0 top-50 translate-middle-y me-2" style="display:none;z-index:10">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentGalleryImages = [];
let currentImageIndex = 0;

function showGalleryModal(element) {
    const images = JSON.parse(element.dataset.images || '[]');
    const title = element.dataset.title || '';
    const desc = element.dataset.desc || '';
    
    currentGalleryImages = images;
    currentImageIndex = 0;
    
    document.getElementById('galleryModalTitle').textContent = title;
    document.getElementById('galleryModalDesc').textContent = desc;
    document.getElementById('galleryModalImg').src = images[0] || '';
    
    // Show/hide navigation
    if (images.length > 1) {
        document.getElementById('prevBtn').style.display = 'block';
        document.getElementById('nextBtn').style.display = 'block';
        document.getElementById('imageCounter').style.display = 'block';
        document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${images.length}`;
    } else {
        document.getElementById('prevBtn').style.display = 'none';
        document.getElementById('nextBtn').style.display = 'none';
        document.getElementById('imageCounter').style.display = 'none';
    }
}

document.getElementById('prevBtn')?.addEventListener('click', function() {
    if (currentImageIndex > 0) {
        currentImageIndex--;
        document.getElementById('galleryModalImg').src = currentGalleryImages[currentImageIndex];
        document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${currentGalleryImages.length}`;
    }
});

document.getElementById('nextBtn')?.addEventListener('click', function() {
    if (currentImageIndex < currentGalleryImages.length - 1) {
        currentImageIndex++;
        document.getElementById('galleryModalImg').src = currentGalleryImages[currentImageIndex];
        document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${currentGalleryImages.length}`;
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('galleryModal').classList.contains('show')) {
        if (e.key === 'ArrowLeft') document.getElementById('prevBtn').click();
        if (e.key === 'ArrowRight') document.getElementById('nextBtn').click();
    }
});
</script>
@endpush
@endsection
