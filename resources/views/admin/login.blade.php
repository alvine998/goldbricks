<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Goldbricks Realtors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #0f2d5e; --gold: #c9a84c; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, var(--primary) 0%, #071a3e 100%); min-height: 100vh; display: flex; align-items: center; }
        .login-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.3); max-width: 420px; width: 100%; }
        .login-header { background: var(--primary); padding: 2rem; text-align: center; }
        .brand { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--gold); }
        .brand span { color: rgba(255,255,255,0.8); }
        .login-body { padding: 2rem 2.5rem; }
        h4 { color: var(--primary); font-weight: 700; }
        .form-control:focus { border-color: var(--gold); box-shadow: 0 0 0 0.2rem rgba(201,168,76,0.2); }
        .form-label { font-weight: 500; color: #374151; font-size: 0.9rem; }
        .input-group-text { background: #f8f9fa; border-right: 0; }
        .form-control { border-left: 0; }
        .btn-login { background: var(--primary); border-color: var(--primary); font-weight: 600; padding: 0.75rem; }
        .btn-login:hover { background: var(--gold); border-color: var(--gold); color: var(--primary); }
        .invalid-feedback { display: block; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">
            <div class="login-card">
                <div class="login-header">
                    <div class="brand">Goldbricks <span>Realtors</span></div>
                    <p class="text-white-50 mb-0 mt-1 small">CMS Admin Panel</p>
                </div>
                <div class="login-body">
                    <h4 class="mb-1">Selamat Datang</h4>
                    <p class="text-muted small mb-4">Masuk ke dashboard admin Anda</p>

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="admin@goldbricks.com" required autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Password" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted small" for="remember">Ingat saya</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-login btn-primary w-100 text-white">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </button>
                    </form>
                    <p class="text-center text-muted small mt-4 mb-0">
                        &copy; {{ date('Y') }} Goldbricks Realtors
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
