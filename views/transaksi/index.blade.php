<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                <i class="bi bi-arrow-left-right"></i> {{ __('Daftar Transaksi Peminjaman') }}
            </h2>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary text-white">
                <i class="bi bi-plus-circle"></i> Pinjam Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Flash Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Statistik --}}
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card border-primary bg-white shadow-sm">
                        <div class="card-body text-dark">
                            <h6 class="text-muted">Total Transaksi</h6>
                            <h2 class="fw-bold text-primary">{{ $transaksis->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-warning bg-white shadow-sm">
                        <div class="card-body text-dark">
                            <h6 class="text-muted">Sedang Dipinjam</h6>
                            <h2 class="fw-bold text-warning">
                                {{ $transaksis->where('status', 'Dipinjam')->filter(function($t) {
                                    return !\Carbon\Carbon::parse($t->tanggal_kembali)->isPast();
                                })->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-danger bg-white shadow-sm">
                        <div class="card-body text-dark">
                            <h6 class="text-muted">Terlambat Kembali</h6>
                            <h2 class="fw-bold text-danger">
                                {{ $transaksis->where('status', 'Dipinjam')->filter(function($t) {
                                    return \Carbon\Carbon::parse($t->tanggal_kembali)->isPast();
                                })->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-success bg-white shadow-sm">
                        <div class="card-body text-dark">
                            <h6 class="text-muted">Sudah Dikembalikan</h6>
                            <h2 class="fw-bold text-success">{{ $transaksis->where('status', 'Dikembalikan')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Tabel Transaksi --}}
            <div class="card shadow-sm">
                <div class="card-body bg-white text-dark">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Anggota</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><code>{{ $transaksi->kode_transaksi }}</code></td>
                                    <td>{{ $transaksi->anggota->nama }}</td>
                                    <td>{{ $transaksi->buku->judul }}</td>
                                    <td>{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                                    <td>{{ $transaksi->tanggal_kembali->format('d M Y') }}</td>
                                    <td>
                                        @php
                                            $tglKembali = \Carbon\Carbon::parse($transaksi->tanggal_kembali)->startOfDay();
                                            $hariIni = \Carbon\Carbon::now()->startOfDay();
                                        @endphp

                                        @if($transaksi->status == 'Dipinjam' && $hariIni->greaterThan($tglKembali))
                                            {{-- TUGAS 3: BADGE MERAH JIKA TERLAMBAT --}}
                                            <span class="badge bg-danger text-white px-2 py-1">
                                                Terlambat {{ $tglKembali->diffInDays($hariIni) }} Hari
                                            </span>
                                        @elseif($transaksi->status == 'Dipinjam')
                                            <span class="badge bg-warning text-dark px-2 py-1">Dipinjam</span>
                                        @else
                                            <span class="badge bg-success px-2 py-1">Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Belum ada transaksi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>