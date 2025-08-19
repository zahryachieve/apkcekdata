<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Aplikasi</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            font-family: 'Poppins', sans-serif;
        }
        .register-container {
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            width: 900px;
            max-width: 100%;
            background: #fff;
        }
        .register-image {
            flex: 1;
            background: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCEcsCtj1xDbRq0ezpPIHFUWkev9J4VD3V5w&s") no-repeat center center;
            background-size: cover;
        }
        .register-form {
            flex: 1;
            padding: 40px;
        }
        .register-form h3 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #1976d2;
        }
        .form-control {
            border-radius: 12px;
        }
        .btn-register {
            width: 100%;
            border-radius: 12px;
            background: #1976d2;
            color: white;
            transition: all 0.3s;
        }
        .btn-register:hover {
            background: #0d47a1;
            transform: scale(1.05);
        }
        .input-group-text {
            background: #f5f5f5;
            border-radius: 12px 0 0 12px;
        }
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="register-container">
            <!-- Bagian Kiri (Gambar) -->
            <div class="register-image"></div>

            <!-- Bagian Kanan (Form Register) -->
            <div class="register-form">
                <h3 class="text-center">Register</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input id="password" type="password" class="form-control" name="password" required>
                            <span class="input-group-text password-toggle" onclick="togglePassword('password','toggleIcon1')">
                                <i class="bi bi-eye-fill" id="toggleIcon1"></i>
                            </span>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            <span class="input-group-text password-toggle" onclick="togglePassword('password_confirmation','toggleIcon2')">
                                <i class="bi bi-eye-fill" id="toggleIcon2"></i>
                            </span>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tombol Register -->
                    <button type="submit" class="btn btn-register">Register</button>

                    <!-- Link ke Login -->
                    <div class="text-center mt-3">
                        <small>Sudah punya akun? <a href="{{ route('login') }}">Login</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-fill");
                icon.classList.add("bi-eye-slash-fill");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash-fill");
                icon.classList.add("bi-eye-fill");
            }
        }
    </script>

    <!-- SweetAlert2 Notification -->
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        </script>
    @endif
</body>
</html>
