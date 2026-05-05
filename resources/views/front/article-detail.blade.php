@extends('layouts.public')
@section('title', $article->title)

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menu_home ?? 'Home' }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('articles') }}">Artikel</a></li>
                <li class="breadcrumb-item active">{{ $article->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded-3 w-100 mb-4" style="max-height:450px;object-fit:cover" alt="{{ $article->title }}">
                @else
                    <div class="rounded-3 mb-4 d-flex align-items-center justify-content-center" style="height:350px;background:linear-gradient(135deg,var(--primary),var(--primary-light))">
                        <i class="bi bi-newspaper text-white opacity-25" style="font-size:6rem"></i>
                    </div>
                @endif

                <div class="mb-4">
                    <div class="d-flex gap-3 text-muted small mb-3">
                        @if($article->published_at)
                            <span><i class="bi bi-calendar me-1"></i>{{ $article->published_at->format('d M Y') }}</span>
                        @endif
                        @if($article->author)
                            <span><i class="bi bi-person me-1"></i>{{ $article->author }}</span>
                        @endif
                    </div>
                    <div class="divider-gold"></div>
                </div>

                <div class="article-content" style="line-height:1.9;color:#333;font-size:1rem">
                    {!! nl2br(e($article->content)) !!}
                </div>

                @if($related->count())
                <div class="mt-5 pt-4 border-top">
                    <h3 class="mb-4" style="color:var(--primary)">Artikel Terkait</h3>
                    <div class="row g-4">
                        @foreach($related as $rel)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($rel->image)
                                    <img src="{{ asset('storage/' . $rel->image) }}" class="card-img-top" style="height:150px;object-fit:cover" alt="{{ $rel->title }}">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height:150px;background:rgba(26,92,58,0.1)">
                                        <i class="bi bi-newspaper" style="color:rgba(26,92,58,0.3)"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title" style="color:var(--primary)">{{ $rel->title }}</h6>
                                    <p class="text-muted small mb-3">{{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}</p>
                                    <a href="{{ route('articles.show', $rel->slug) }}" class="btn btn-sm btn-gold w-100">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top:80px">
                    <div class="card-body p-4">
                        <h5 class="mb-3" style="color:var(--primary)">Tentang Artikel Ini</h5>
                        <hr>
                        @if($article->author)
                        <div class="d-flex gap-3 mb-4">
                            <div class="contact-icon" style="width:40px;height:40px;font-size:1rem"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="text-muted small">Penulis</div>
                                <div class="fw-medium">{{ $article->author }}</div>
                            </div>
                        </div>
                        @endif
                        @if($article->published_at)
                        <div class="d-flex gap-3 mb-4">
                            <div class="contact-icon" style="width:40px;height:40px;font-size:1rem"><i class="bi bi-calendar"></i></div>
                            <div>
                                <div class="text-muted small">Dipublikasikan</div>
                                <div class="fw-medium">{{ $article->published_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <a href="{{ route('articles') }}" class="btn btn-gold w-100 btn-sm">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
