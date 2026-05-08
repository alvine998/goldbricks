@extends('layouts.admin')
@section('title', 'Edit Bank KPR')

@section('content')
<div class="mb-4">
    <h1 class="mb-0">Edit Bank KPR</h1>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.banks._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-check-lg me-2"></i>Perbarui Bank
                </button>
                <a href="{{ route('admin.banks.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
