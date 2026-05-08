<div class="mb-3">
    <label class="form-label fw-medium">Foto <span class="text-danger">{{ isset($gallery) ? '' : '*' }}</span></label>
    @if(isset($gallery) && $gallery->image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $gallery->image) }}" class="img-thumbnail" style="height:120px;object-fit:cover" alt="">
            <div class="form-text">Gambar utama saat ini. Upload baru untuk mengganti.</div>
        </div>
    @endif
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
           accept="image/jpeg,image/jpg,image/png,image/webp" {{ isset($gallery) ? '' : 'required' }}>
    <div class="form-text">Format: JPEG, PNG, WEBP. Maks 5 MB.</div>
    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label fw-medium">Gambar Tambahan</label>
    @if(isset($gallery) && !empty($gallery->images) && is_array($gallery->images))
        <div class="mb-2">
            <p class="fw-medium small text-muted mb-2">Gambar yang sudah tersimpan:</p>
            <div class="row g-2">
                @foreach($gallery->images as $index => $image)
                    <div class="col-auto">
                        <div class="position-relative">
                            <img src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}" 
                                 class="img-thumbnail" style="height:100px;width:100px;object-fit:cover" alt="">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" 
                                    onclick="removeImage({{ $index }})" style="padding:2px 6px;font-size:0.7rem">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror"
           accept="image/jpeg,image/jpg,image/png,image/webp" multiple>
    <div class="form-text">Unggah 1 atau lebih gambar. Format: JPEG, PNG, WEBP. Maks 5 MB per gambar.</div>
    @error('images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

@push('scripts')
<script>
function removeImage(index) {
    if (confirm('Hapus gambar ini?')) {
        const form = document.querySelector('form');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'remove_images[]';
        input.value = index;
        form.appendChild(input);
        
        // Remove the image from display
        event.target.closest('.col-auto').remove();
    }
}
</script>
@endpush
