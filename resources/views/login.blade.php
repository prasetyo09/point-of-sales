<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - Point Of Sales</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/assets/images/favicon.ico') }}" type="image/png">
</head>
<body class="bg-light min-vh-100 d-flex align-items-center justify-content-center p-3">

    <!-- Card Container -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden w-100" style="max-width: 900px;">
        <div class="row g-0">

            <!-- Sisi Kiri: Branding POS -->
            <div class="col-lg-6 bg-success text-white p-4 p-md-5 d-flex flex-column justify-content-between">
                <div>
                    <!-- Brand Logo -->
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="bg-white bg-opacity-25 rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-shop fs-4 text-white"></i>
                        </div>
                        <span class="fs-4 fw-bold">Prasetyo - Point Of Sales</span>
                    </div>

                    <h3 class="fw-bold mb-3">Kelola Transaksi Penjualan Lebih Cepat & Mudah</h3>
                    <p class="text-white-50 small mb-0">
                        Sistem Point of Sale terintegrasi untuk kasir, manajemen inventaris, dan laporan harian multi-cabang.
                    </p>
                </div>

                <!-- Footer Sisi Kiri -->
                <div class="pt-4 mt-4 border-top border-white border-opacity-25 d-flex align-items-center gap-2 text-white-50 small">
                    <i class="bi bi-shield-check text-warning fs-5"></i>
                    <span>Sistem Terenkripsi & Siap Digunakan.</span>
                </div>
            </div>

            <!-- Sisi Kanan: Form Login -->
            <div class="col-lg-6 bg-white p-4 p-md-5 d-flex flex-column justify-content-center">
                <div class="mb-4">
                    <h4 class="fw-bold text-dark mb-1">Login to The System</h4>
                    <p class="text-muted small">Enter the cashier account and select the assigned branch.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi Kesalahan Input</strong>
                        <ul>
                            @foreach ($errors->all() as $error )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif

                <form id="loginForm" action="{{ route('action-login') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label small fw-semibold text-secondary text-uppercase">Username / Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-person"></i>
                            </span>
                            <input
                                type="email"
                                class="form-control bg-light border-start-0 ps-0"
                                id="username"
                                name="email"
                                placeholder="Enter Your Email"
                                required
                                @error('email')
                                is-Invalid
                                @enderror
                            >
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="form-label small fw-semibold text-secondary text-uppercase">PIN / Password</label>
                            <a href="#" class="text-decoration-none small text-primary">Lupa PIN?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input
                                type="password"
                                class="form-control bg-light border-start-0 border-end-0 ps-0"
                                id="password"
                                name="password"
                                placeholder="Enter Your Password"
                                required
                                @error('password')
                                is-Invalid
                                @enderror
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <button
                                type="button"
                                class="btn btn-light border border-start-0 text-muted"
                                id="togglePassword"
                            >
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Pilihan Cabang/Outlet -->
                    {{-- <div class="mb-3">
                        <label for="outlet" class="form-label small fw-semibold text-secondary text-uppercase">Pilih Outlet</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-geo-alt"></i>
                            </span>
                            <select class="form-select bg-light border-start-0 ps-0" id="outlet" required>
                                <option value="" disabled selected>-- Pilih Cabang --</option>
                                <option value="pusat">Cabang Pusat - Jakarta</option>
                                <option value="bandung">Cabang 02 - Bandung</option>
                                <option value="surabaya">Cabang 03 - Surabaya</option>
                            </select>
                        </div>
                    </div> --}}

                    <!-- Remember Me -->
                    {{-- <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label small text-secondary" for="rememberMe">Ingat sesi login kasir ini</label>
                    </div> --}}

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                        <span>Sign to Dashboard</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <small class="text-muted">v1.0.0 &copy; 2026 Prasetyo - POS System</small>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Interaktif -->
    <script>
        // const loginForm = document.getElementById('loginForm');
        // const togglePasswordBtn = document.getElementById('togglePassword');
        // const passwordInput = document.getElementById('password');
        // const toggleIcon = document.getElementById('toggleIcon');
        // const submitBtn = document.getElementById('submitBtn');

        // // Toggle Lihat Password
        // togglePasswordBtn.addEventListener('click', function () {
        //     const isPassword = passwordInput.getAttribute('type') === 'password';
        //     passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

        //     // Ganti icon
        //     toggleIcon.classList.toggle('bi-eye');
        //     toggleIcon.classList.toggle('bi-eye-slash');
        // });

        // // Handle Submit Form
        // loginForm.addEventListener('submit', function (event) {
        //     event.preventDefault();

        //     const username = document.getElementById('username').value.trim();
        //     const password = passwordInput.value.trim();
        //     const outlet = document.getElementById('outlet').value;

        //     // Validasi Sederhana
        //     if (!username || !password || !outlet) {
        //         alert('Harap isi semua kolom termasuk pilihan outlet!');
        //         return;
        //     }

        //     // Animasi Loading State dengan Bootstrap Spinner
        //     submitBtn.disabled = true;
        //     submitBtn.innerHTML = `
        //         <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        //         <span>Memproses Masuk...</span>
        //     `;

        //     // Simulasi proses API
        //     setTimeout(() => {
        //         alert(`Login Berhasil! Selamat bertugas di ${outlet.toUpperCase()}`);
        //         submitBtn.disabled = false;
        //         submitBtn.innerHTML = `
        //             <span>Masuk Kasir</span>
        //             <i class="bi bi-arrow-right"></i>
        //         `;
        //     }, 1200);
        // });
    </script>
</body>
</html>
