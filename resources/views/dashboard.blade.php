@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-center fw-bold text-dark">Selamat datang, <strong>{{ Auth::user()->name }}</strong> 👋</h2>
    <h3 class="mb-4 text-center text-secondary">" Dashboard Data Pelelang "</h3>

    <div class="row mt-4">
        <!-- Total VA -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-4 text-white"
                 style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-123 fs-1"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Total VA</h6>
                        <h3 class="fw-bold">{{ $total_va }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sudah Dikembalikan -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-4 text-white"
                 style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-check-circle-fill fs-1"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Sudah Dikembalikan</h6>
                        <h3 class="fw-bold">{{ $total_sudah }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Belum Dikembalikan -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-lg border-0 rounded-4 text-white"
                 style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-x-circle-fill fs-1"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Belum Dikembalikan</h6>
                        <h3 class="fw-bold">{{ $total_belum }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
