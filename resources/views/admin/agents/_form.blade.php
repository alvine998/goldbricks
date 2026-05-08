<div class="row g-4">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label fw-medium">Nama <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $agent->name ?? '') }}" required placeholder="Contoh: Danny">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium">Posisi / Label</label>
            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                   value="{{ old('position', $agent->position ?? '') }}" placeholder="Contoh: GOLDBRICKS / Principal">
            @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium">WhatsApp</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-whatsapp text-success"></i></span>
                <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror"
                       value="{{ old('whatsapp', $agent->whatsapp ?? '') }}" placeholder="628123456789">
            </div>
            @error('whatsapp')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <hr class="my-3">
        <p class="fw-medium text-muted small mb-2">Sosial Media (opsional, isi dengan URL lengkap)</p>

        <div class="mb-3">
            <label class="form-label fw-medium">Facebook</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-facebook text-primary"></i></span>
                <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror"
                       value="{{ old('facebook', $agent->facebook ?? '') }}" placeholder="https://facebook.com/username">
            </div>
            @error('facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium">X / Twitter</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-twitter-x"></i></span>
                <input type="url" name="twitter" class="form-control @error('twitter') is-invalid @enderror"
                       value="{{ old('twitter', $agent->twitter ?? '') }}" placeholder="https://x.com/username">
            </div>
            @error('twitter')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium">LinkedIn</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-linkedin" style="color:#0077b5"></i></span>
                <input type="url" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror"
                       value="{{ old('linkedin', $agent->linkedin ?? '') }}" placeholder="https://linkedin.com/in/username">
            </div>
            @error('linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-medium">Pinterest</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-pinterest" style="color:#e60023"></i></span>
                <input type="url" name="pinterest" class="form-control @error('pinterest') is-invalid @enderror"
                       value="{{ old('pinterest', $agent->pinterest ?? '') }}" placeholder="https://pinterest.com/username">
            </div>
            @error('pinterest')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-0">
            <label class="form-label fw-medium">Urutan Tampil</label>
            <input type="number" name="sort_order" class="form-control" style="max-width:120px"
                   value="{{ old('sort_order', $agent->sort_order ?? 0) }}" min="0">
            <div class="form-text">Angka kecil tampil lebih awal.</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label fw-medium">Foto Profil</label>
            @if(isset($agent) && $agent->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $agent->photo) }}" class="img-thumbnail w-100" style="height:180px;object-fit:cover;border-radius:8px" alt="">
                    <div class="form-text">Foto saat ini. Upload baru untuk mengganti.</div>
                </div>
            @endif
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                   accept="image/jpeg,image/jpg,image/png,image/webp">
            <div class="form-text">Format: JPEG, PNG, WEBP. Maks 3 MB. Ideal: foto portrait 400x400px.</div>
            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
