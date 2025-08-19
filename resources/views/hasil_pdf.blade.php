@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">🔍 Hasil Validasi PDF vs Data VA (UJL)</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>No.</th>
                    <th>No. VA</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $index => $row)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-nowrap">{{ $row['no_va'] }}</td>
                        <td class="text-start">{{ $row['nama'] }}</td>
                        <td>
                            @if ($row['status'] === 'Siap Dikembalikan')
                                ✅ <span class="text-success fw-bold">{{ $row['status'] }}</span>
                            @elseif ($row['status'] === 'Tidak Valid')
                                ⛔ <span class="text-danger fw-bold">{{ $row['status'] }}</span>
                            @else
                                ⚠️ <span class="text-warning fw-bold">{{ $row['status'] }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Tidak ada data ditemukan dari hasil validasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('index') }}" class="btn btn-secondary mt-3">
        ← Kembali ke Halaman Utama
    </a>
</div>
@endsection
    