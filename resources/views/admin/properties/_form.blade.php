<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label fw-medium">Nama Properti <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $property->title ?? '') }}" required placeholder="Contoh: Rumah Minimalis 2 Lantai">
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                      placeholder="Deskripsi lengkap properti...">{{ old('description', $property->description ?? '') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Tipe Properti <span class="text-danger">*</span></label>
                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">Pilih Tipe...</option>
                    <option value="house" {{ old('type', $property->type ?? '') === 'house' ? 'selected' : '' }}>Rumah</option>
                    <option value="apartment" {{ old('type', $property->type ?? '') === 'apartment' ? 'selected' : '' }}>Apartemen</option>
                    <option value="ruko" {{ old('type', $property->type ?? '') === 'ruko' ? 'selected' : '' }}>Ruko</option>
                    <option value="kavling" {{ old('type', $property->type ?? '') === 'kavling' ? 'selected' : '' }}>Kavling</option>
                    <option value="other" {{ old('type', $property->type ?? '') === 'other' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="">Pilih Status...</option>
                    <option value="available" {{ old('status', $property->status ?? 'available') === 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="reserved" {{ old('status', $property->status ?? '') === 'reserved' ? 'selected' : '' }}>Dipesan</option>
                    <option value="sold" {{ old('status', $property->status ?? '') === 'sold' ? 'selected' : '' }}>Terjual</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-6">
                <label class="form-label fw-medium">Harga (IDR)</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', $property->price ?? '') }}" placeholder="5000000000">
                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-medium">Lokasi</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                       value="{{ old('location', $property->location ?? '') }}" placeholder="Contoh: Jakarta Utara">
                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-0 mt-3">
            <label class="form-label fw-medium">Urutan Tampil</label>
            <input type="number" name="sort_order" class="form-control" style="max-width:120px"
                   value="{{ old('sort_order', $property->sort_order ?? 0) }}" min="0">
            <div class="form-text">Angka kecil tampil lebih awal.</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label fw-medium">Gambar Properti</label>
            @if(isset($property) && $property->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $property->image) }}" class="img-thumbnail w-100" style="height:200px;object-fit:cover" alt="">
                    <div class="form-text mt-2">Gambar utama saat ini. Upload baru untuk mengganti.</div>
                </div>
            @endif
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                   accept="image/jpeg,image/jpg,image/png,image/webp">
            <div class="form-text">Foto utama. Format: JPEG, PNG, WEBP. Maks 5 MB.</div>
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Galeri Foto Properti (Max 10)</label>
            @if(!empty($property->images) && is_array($property->images))
                <div class="mb-3">
                    <div class="row g-2">
                        @foreach($property->images as $img)
                        <div class="col-4 position-relative">
                            <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail w-100" style="height:80px;object-fit:cover" alt="">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="removeImage(this, '{{ $img }}')">×</button>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-text mt-2">Total: {{ count($property->images) }} foto</div>
                </div>
            @endif
            <input type="file" name="images[]" multiple class="form-control @error('images') is-invalid @enderror"
                   accept="image/jpeg,image/jpg,image/png,image/webp">
            <div class="form-text">Format: JPEG, PNG, WEBP. Maksimal 10 foto, masing-masing 5 MB.</div>
            @error('images')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            @error('images.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
