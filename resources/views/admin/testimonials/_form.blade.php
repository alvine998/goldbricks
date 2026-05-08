<div class="mb-3">
    <label class="form-label fw-medium">Nama <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $testimonial->name ?? '') }}" placeholder="Contoh: Budi Santoso" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-medium">Posisi/Jabatan</label>
            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                   value="{{ old('position', $testimonial->position ?? '') }}" placeholder="Contoh: Direktur">
            @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-medium">Perusahaan</label>
            <input type="text" name="company" class="form-control @error('company') is-invalid @enderror"
                   value="{{ old('company', $testimonial->company ?? '') }}" placeholder="Contoh: PT Maju Jaya">
            @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-medium">Pesan Testimoni <span class="text-danger">*</span></label>
    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5"
              placeholder="Tulis testimoni pelanggan..." required>{{ old('message', $testimonial->message ?? '') }}</textarea>
    <div class="form-text">Minimal deskripsi pengalaman pelanggan dengan properti atau layanan kami.</div>
    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-medium">Foto Profil</label>
            @if(isset($testimonial) && $testimonial->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" class="img-thumbnail rounded-circle" style="height:80px;width:80px;object-fit:cover" alt="{{ $testimonial->name }}">
                    <div class="form-text">Foto saat ini. Upload baru untuk mengganti.</div>
                </div>
            @endif
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                   accept="image/jpeg,image/jpg,image/png,image/webp">
            <div class="form-text">Format: JPG, PNG, WEBP. Maks 2 MB. Gunakan foto profil atau wajah pelanggan.</div>
            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label fw-medium">Rating</label>
            <div class="d-flex gap-2">
                @for($i = 1; $i <= 5; $i++)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}" 
                               {{ old('rating', $testimonial->rating ?? 5) == $i ? 'checked' : '' }}>
                        <label class="form-check-label" for="rating{{ $i }}">
                            <i class="bi bi-star-fill" style="color:var(--gold);font-size:1.2rem"></i>
                        </label>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<div class="mb-0">
    <label class="form-label fw-medium">Urutan Tampil</label>
    <input type="number" name="sort_order" class="form-control" style="max-width:120px"
           value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" min="0">
    <div class="form-text">Angka kecil tampil lebih awal.</div>
</div>
