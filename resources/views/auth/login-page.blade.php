<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | B2F Official</title>

    <link rel="icon" href="{{ asset('bootstrap/bootstrap-b2f-landing/assets/img/logo_b2f.png') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('atlantis/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary: #feb801;
            --primary-hover: #e5a600;
            --bg-dark: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
            --border: rgba(255, 255, 255, 0.1);
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            overflow: hidden;
        }

        .main-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Bagian Visual (Kiri) */
        .side-visual {
            flex: 1.4;
            position: relative;
            background: linear-gradient(45deg, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.2)),
                        url("{{ asset('bootstrap/bootstrap-b2f-landing/assets/img/about.jpg') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 60px;
        }

        .side-visual::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, transparent 80%, var(--bg-dark));
        }

        .visual-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            animation: slideUp 1s ease-out;
        }

        .visual-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -2px;
        }

        /* Bagian Form (Kanan) */
        .side-form {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background-color: var(--bg-dark);
            position: relative;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 1.2s ease-out;
        }

        .brand-section {
            margin-bottom: 40px;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .brand-logo span {
            color: var(--primary);
        }

        .subtitle {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        /* Floating Input Style */
        .form-group-custom {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label-custom {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 8px;
            transition: all 0.3s;
        }

        .input-wrapper {
            position: relative;
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .input-wrapper:focus-within {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 0 4px rgba(254, 184, 1, 0.1);
        }

        .input-wrapper i {
            padding: 0 15px;
            color: #64748b;
        }

        .form-control-custom {
            background: transparent;
            border: none;
            color: white;
            padding: 14px 15px 14px 0;
            width: 100%;
            outline: none;
            font-size: 0.95rem;
        }

        /* Button Styling */
        .btn-submit {
            background: var(--primary);
            color: #000;
            border: none;
            border-radius: 12px;
            padding: 16px;
            width: 100%;
            font-weight: 700;
            font-size: 1rem;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(254, 184, 1, 0.2);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-links {
            margin-top: 30px;
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .side-visual { 
                display: none; 
            }
            .side-form { 
                flex: 1; 
                /* Gambar muncul sebagai background tipis di form saat di mobile */
                background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), 
                            url("{{ asset('bootstrap/bootstrap-b2f-landing/assets/img/about.jpg') }}");
                background-size: cover;
                background-position: center;
            }
            .login-box {
                backdrop-filter: blur(10px); /* Efek kaca lebih kuat di mobile */
                padding: 20px;
            }
        }

        /* Animations */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .toggle-password {
            cursor: pointer;
            padding-right: 15px !important;
        }

        /* Container untuk logo */
        .brand-logo-container {
            display: flex;
            justify-content: flex-start; /* Logo rata kiri mengikuti desain awal */
            align-items: center;
            margin-bottom: 10px;
        }

        /* Pengaturan ukuran logo */
        .main-logo {
            max-height: 60px; /* Atur tinggi maksimal logo sesuai selera */
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0px 4px 10px rgba(0, 0, 0, 0.3)); /* Memberi sedikit dimensi pada logo */
        }

        /* Responsif untuk Mobile */
        @media (max-width: 992px) {
            .brand-logo-container {
                justify-content: center; /* Di mobile logo akan pindah ke tengah agar rapi */
            }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="side-visual">
            <div class="visual-content">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2">ADMIN DASHBOARD & MANAGEMENT SYSTEM</span>
                <h1>Bala Bala<br>Family <span style="color: var(--primary)">OFFICIAL</span></h1>
                <p class="lead text-light opacity-75">Welcome back. One dashboard for complete control of the entire B2F Official digital ecosystem.</p>
            </div>
        </div>

        <div class="side-form">
            <div class="login-box">
                <div class="brand-section">
                    <div class="brand-section">
                        <div class="brand-logo-container">
                            <img src="{{ asset('bootstrap/bootstrap-b2f-landing/assets/img/logo_b2f.png') }}" 
                                alt="B2F Logo" 
                                class="img-fluid main-logo">
                        </div>
                        <div class="subtitle mt-3">Please sign in to your admin account</div>
                    </div>
                </div>

                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom">Email Address</label>
                        <div class="input-wrapper">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="email" class="form-control-custom" 
                                   placeholder="name@gmail.com" value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email') 
                            <small class="text-danger mt-2 d-block" style="font-size: 0.75rem;">{{ $message }}</small> 
                        @enderror
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" class="form-control-custom" 
                                   placeholder="••••••••" required>
                            <i class="far fa-eye toggle-password" onclick="togglePass()" id="toggleIcon"></i>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" style="background-color: var(--glass); border-color: var(--border);">
                            <label class="form-check-label subtitle" for="remember" style="font-size: 0.85rem;">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        Sign In to Dashboard
                    </button>
                </form>

                <div class="footer-links">
                    Created by B2F Official
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePass() {
            const x = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");
            if (x.type === "password") {
                x.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                x.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      @if (session('SA-success'))
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: "{{ session('SA-success') }}",
              showConfirmButton: false,
              timer: 2000
          });
      @endif

      @if (session('SA-error'))
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: "{{ session('SA-error') }}",
              confirmButtonColor: '#d33',
          });
      @endif

      @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Simpan!',
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#d33',
            });
        @endif
    </script>
</body>
</html>