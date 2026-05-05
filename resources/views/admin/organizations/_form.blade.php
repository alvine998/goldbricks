<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $organization->name ?? '') }}" required placeholder="Contoh: Ikna Abdul Kholik">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium">Posisi <span class="text-danger">*</span></label>
            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                   value="{{ old('position', $organization->position ?? '') }}" required placeholder="Contoh: Presiden Direktur">
            @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium">Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                      placeholder="Deskripsi singkat atau bio anggota organisasi...">{{ old('description', $organization->description ?? '') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-0">
            <label class="form-label fw-medium">Urutan Tampil</label>
            <input type="number" name="sort_order" class="form-control" style="max-width:120px"
                   value="{{ old('sort_order', $organization->sort_order ?? 0) }}" min="0">
            <div class="form-text">Angka kecil tampil lebih awal.</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label fw-medium">Foto Profil</label>
            @if(isset($organization) && $organization->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $organization->photo) }}" class="img-thumbnail w-100" style="height:150px;object-fit:cover" alt="">
                    <div class="form-text">Foto saat ini. Upload baru untuk mengganti.</div>
                </div>
            @endif
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                   accept="image/jpeg,image/jpg,image/png,image/webp">
            <div class="form-text">Format: JPEG, PNG, WEBP. Maks 3 MB. Ukuran ideal: 200x200px</div>
            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
