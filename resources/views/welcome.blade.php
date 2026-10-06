<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiCekLelang - Sistem Pengecekan Dana & Validasi PUJL</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #00509d;
            --secondary-blue: #1a86d9;
            --light-blue: #e6f2ff;
            --primary-green: #2e8b57;
            --light-green: #e6f8f0;
            --white: #ffffff;
            --dark: #212529;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-green) 100%);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 80, 157, 0.8), rgba(46, 139, 87, 0.8)), 
                        url('https://placehold.co/') no-repeat center center;
            background-size: cover;
            min-height: 70vh;
            color: white;
        }
        
        .navbar-brand {
            font-weight: 700;
        }
        
        .btn-custom {
            background: linear-gradient(to right, var(--primary-blue), var(--primary-green));
            color: white;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            color: white;
        }
        
        .feature-card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .icon-box {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .bg-blue {
            background-color: var(--light-blue);
            color: var(--primary-blue);
        }
        
        .bg-green {
            background-color: var(--light-green);
            color: var(--primary-green);
        }
        
        .auction-item {
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .auction-item:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
            background-color: var(--dark);
            color: white;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 80, 157, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark gradient-bg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
               <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="width:50px; height:auto;">

                <span>SiCekLelang</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        
                    </li>
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    <a href="/login" class="btn btn-light me-2">Masuk</a>
                    <a href="/register" class="btn btn-outline-light">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Sistem Cek Dana & Validasi Lelang</h1>
                    <p class="lead mb-4">“Aplikasi untuk pengecekan dana mengendap dan validasi PUJL dalam transaksi lelang, guna mendukung proses yang transparan dan efisien.”</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#lelang" class="btn btn-custom btn-lg px-4 py-2">Pengecekan Dana</a>
                        <a href="#lelang" class="btn btn-custom btn-lg px-4 py-2">Validasi PUJL</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('images/logo3.png') }}" alt="Logo" style="width:500px; height:auto;">


            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Sistem Modern dan Terpercaya</h2>
                <p class="text-muted">Sistem Cek Dana & Validasi Lelang</p>
            </div>
         
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0 text-white-50">&copy; 2025 KPKNL Bogor. Hak Cipta Dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-decoration-none text-white-50 me-3">Kebijakan Privasi</a>
                    <a href="#" class="text-decoration-none text-white-50">Syarat dan Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Animasi scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.feature-card, .auction-item');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if(elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        }
        
        // Set initial style for animation
        document.querySelectorAll('.feature-card, .auction-item').forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>

