<div class="mb-3">
    <label class="form-label fw-medium">Nama Bank <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $bank->name ?? '') }}" placeholder="Contoh: BCA" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-medium">Logo Bank <span class="text-danger">{{ isset($bank) ? '' : '*' }}</span></label>
    @if(isset($bank) && $bank->logo)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $bank->logo) }}" class="img-thumbnail" style="height:80px;object-fit:contain;background:#f8f9fa;padding:5px" alt="{{ $bank->name }}">
            <div class="form-text">Logo saat ini. Upload baru untuk mengganti.</div>
        </div>
    @endif
    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
           accept="image/jpeg,image/jpg,image/png,image/webp,image/svg+xml" {{ isset($bank) ? '' : 'required' }}>
    <div class="form-text">Format: PNG, JPG, WEBP, SVG. Maks 2 MB. Gunakan rasio 16:9 atau logo dengan background transparan.</div>
    @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-medium">Link KPR</label>
    <input type="url" name="link" class="form-control @error('link') is-invalid @enderror"
           value="{{ old('link', $bank->link ?? '') }}" placeholder="https://www.bank.co.id/kpr">
    <div class="form-text">URL ke halaman KPR bank (opsional). Klik logo akan membuka link ini.</div>
    @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-0">
    <label class="form-label fw-medium">Urutan Tampil</label>
    <input type="number" name="sort_order" class="form-control" style="max-width:120px"
           value="{{ old('sort_order', $bank->sort_order ?? 0) }}" min="0">
    <div class="form-text">Angka kecil tampil lebih awal.</div>
</div>
