@extends('layouts.admin')
@section('title', 'Tambah Testimoni')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-link btn-sm text-decoration-none mb-3">
        <i class="bi bi-chevron-left"></i> Kembali ke Daftar
    </a>
    <h1 class="mb-0">Tambah Testimoni Baru</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.testimonials._form')
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-gold">
                            <i class="bi bi-check-lg me-2"></i>Simpan Testimoni
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
