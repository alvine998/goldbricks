@extends('layouts.admin')
@section('title', 'Edit Testimoni')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-link btn-sm text-decoration-none mb-3">
        <i class="bi bi-chevron-left"></i> Kembali ke Daftar
    </a>
    <h1 class="mb-0">Edit Testimoni</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.testimonials._form')
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-gold">
                            <i class="bi bi-check-lg me-2"></i>Perbarui Testimoni
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
