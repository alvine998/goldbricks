<div class="mb-3">
    <label class="form-label fw-medium">Foto <span class="text-danger">{{ isset($gallery) ? '' : '*' }}</span></label>
    @if(isset($gallery) && $gallery->image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $gallery->image) }}" class="img-thumbnail" style="height:120px;object-fit:cover" alt="">
            <div class="form-text">Gambar saat ini. Upload baru untuk mengganti.</div>
        </div>
    @endif
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
           accept="image/jpeg,image/jpg,image/png,image/webp" {{ isset($gallery) ? '' : 'required' }}>
    <div class="form-text">Format: JPEG, PNG, WEBP. Maks 5 MB.</div>
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label fw-medium">Judul Foto</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', $gallery->title ?? '') }}" placeholder="Contoh: Green Valley Exterior">
</div>
<div class="mb-3">
    <label class="form-label fw-medium">Deskripsi</label>
    <textarea name="description" class="form-control" rows="3"
              placeholder="Deskripsi singkat foto...">{{ old('description', $gallery->description ?? '') }}</textarea>
</div>
<div class="mb-0">
    <label class="form-label fw-medium">Urutan Tampil</label>
    <input type="number" name="sort_order" class="form-control" style="max-width:120px"
           value="{{ old('sort_order', $gallery->sort_order ?? 0) }}" min="0">
    <div class="form-text">Angka kecil tampil lebih awal.</div>
</div>
