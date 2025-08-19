<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Aplikasi</title>
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
        .login-container {
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            width: 900px;
            max-width: 100%;
            background: #fff;
            transform: perspective(1000px) rotateY(0deg);
            transition: transform 0.6s ease;
        }
        /* .login-container:hover {
            transform: perspective(1000px) rotateY(5deg);
        } */
        .login-image {
            flex: 1;
            background: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRN3My2z_-QrDjP-UixRAk5Eya1eSJECDTd2w&s") no-repeat center center;
            background-size: 200px;
           
        }
        .login-form {
            flex: 1;
            padding: 40px;
        }
        .login-form h3 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #1976d2;
        }
        .form-control {
            border-radius: 12px;
        }
        .btn-login {
            width: 100%;
            border-radius: 12px;
            background: #1976d2;
            color: white;
            transition: all 0.3s;
        }
        .btn-login:hover {
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
        <div class="login-container">
            <!-- Bagian Kiri (Gambar) -->
            <div class="login-image"></div>

            <!-- Bagian Kanan (Form Login) -->
            <div class="login-form">
                <h3 class="text-center">Login</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
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
                            <span class="input-group-text password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye-fill" id="toggleIcon"></i>
                            </span>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" class="btn btn-login">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("bi-eye-fill");
                toggleIcon.classList.add("bi-eye-slash-fill");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("bi-eye-slash-fill");
                toggleIcon.classList.add("bi-eye-fill");
            }
        }
    </script>

    <!-- SweetAlert2 Notification -->
    @if (session('status'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('status') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

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
