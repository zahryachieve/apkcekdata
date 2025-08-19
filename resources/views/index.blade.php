@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pengecekan Dana Mengendap & Validasi PUJL</h2>

    {{-- SweetAlert jika berhasil --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- Card Upload & Aksi --}}
    <div class="card p-4 mb-4">
        <h5 class="card-title mb-3">📁 Upload Data & Aksi</h5>
        <div class="row g-3">
            {{-- Upload Excel --}}
            <div class="col-md-6">
                <form action="{{ route('upload.excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control mb-2" required>
                    <button class="btn btn-success w-100">⬆️ Upload Excel</button>
                </form>
            </div>

            {{-- Upload PDF --}}
            <div class="col-md-6">
                <form action="{{ route('upload.pdf') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="pdf" class="form-control mb-2" required>
                    <button class="btn btn-primary w-100">📄 Validasi PDF</button>
                </form>
            </div>

            {{-- Reset & Export Semua --}}
            <div class="col-md-6 d-flex gap-2">
                <form action="{{ route('reset') }}" method="POST" onsubmit="return confirm('Yakin ingin hapus semua data?')" class="w-100">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">🗑️ Reset Semua</button>
                </form>
            </div>

            <div class="col-md-6 d-flex gap-2">
                <a href="{{ route('export') }}" class="btn btn-secondary w-50">📤 Export Semua</a>

                <form action="{{ route('dana.export.filtered') }}" method="GET" class="w-50">
                    <input type="hidden" name="no_va" value="{{ request('no_va') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <button type="submit" class="btn btn-success w-100">🔍 Export Filter</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari No. VA..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="status" class="form-control">
    <option value="">-- Filter Status --</option>
    <option value="Belum Dikembalikan" {{ request('status') == 'Belum Dikembalikan' ? 'selected' : '' }}>⛔ Belum Dikembalikan</option>
    <option value="Sebagian Dikembalikan" {{ request('status') == 'Sebagian Dikembalikan' ? 'selected' : '' }}>⚠️ Sebagian Dikembalikan</option>
    <option value="Sudah Dikembalikan" {{ request('status') == 'Sudah Dikembalikan' ? 'selected' : '' }}>✅ Sudah Dikembalikan</option>
    <option value="Lebih Bayar" {{ request('status') == 'Lebih Bayar' ? 'selected' : '' }}>❗ Lebih Bayar</option>
</select>

        </div>
        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-primary">🔍 Filter</button>
            <a href="{{ route('index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    @if (isset($data) && $data->count())
    <h4 class="mt-5">Data Transaksi</h4>
    <div class="table-responsive">
        <table class="table table-bordered" id="dana-table">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>No. VA</th>
                    <th>Tipe</th>
                    <th>Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $row)
                    <tr>
                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $i + 1 }}</td>
                        <td>{{ $row->no_va }}</td>
                        <td>{{ $row->tipe }}</td>
                        <td>Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $icon = '⛔'; $color = 'danger';
                                if ($row->status === 'Sudah Dikembalikan') {
                                    $icon = '✅'; $color = 'success';
                                } elseif ($row->status === 'Sebagian Dikembalikan') {
                                    $icon = '⚠️'; $color = 'warning';
                                } elseif ($row->status === 'Lebih Bayar') {
                                    $icon = '❗'; $color = 'info';
                                }
                            @endphp
                            {!! $icon !!} <span class="text-{{ $color }}">{{ $row->status }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Bootstrap 5 pagination --}}
    <div class="mt-3">
        {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@else
    <div class="alert alert-warning mt-5" role="alert">
        Tidak ada data transaksi ditemukan.
    </div>
@endif


    {{-- Ringkasan --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total VA Unik</h5>
                    <p class="card-text fs-4">{{ $total_va }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Sudah Dikembalikan</h5>
                    <p class="card-text fs-4">{{ $total_sudah }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Belum Dikembalikan</h5>
                    <p class="card-text fs-4">{{ $total_belum }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
