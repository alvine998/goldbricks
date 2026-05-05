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
                         data-img="{{ asset('storage/' . $item->image) }}"
                         data-title="{{ $item->title }}"
                         data-desc="{{ $item->description }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Galeri' }}" loading="lazy" width="300" height="250">
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
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-white" id="galleryModalTitle"></h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="galleryModalImg" src="" class="img-fluid rounded" alt="">
                <p id="galleryModalDesc" class="text-white-50 small mt-2 mb-0"></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.gallery-item').forEach(el => {
    el.addEventListener('click', function() {
        document.getElementById('galleryModalImg').src = this.dataset.img;
        document.getElementById('galleryModalTitle').textContent = this.dataset.title || '';
        document.getElementById('galleryModalDesc').textContent = this.dataset.desc || '';
    });
});
</script>
@endpush
@endsection
