<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Transaksi Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="card shadow-sm mb-4 bg-white text-dark">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="bi bi-filter"></i> Filter Laporan
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi.laporan') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label font-semibold text-sm">Dari Tanggal</label>
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-semibold text-sm">Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-semibold text-sm">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Semua" {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label font-semibold text-sm">Anggota</label>
                                <select name="anggota_id" class="form-select">
                                    <option value="">Semua Anggota</option>
                                    @foreach($anggotas as $anggota)
                                        <option value="{{ $anggota->id }}" {{ request('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                            {{ $anggota->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-search"></i> Filter Data
                            </button>
                            <a href="{{ route('transaksi.laporan') }}" class="btn btn-secondary">
                                Reset
                            </a>
                            <a href="{{ route('transaksi.laporan', array_merge(request()->all(), ['export' => 'pdf'])) }}" class="btn btn-danger ms-auto">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-info text-white shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="text-uppercase text-xs font-bold opacity-75">Total Transaksi</h6>
                            <h2 class="mb-0 font-bold">{{ $totalTransaksi }} Data</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-danger text-white shadow-sm border-0">
                        <div class="card-body">
                            <h6 class="text-uppercase text-xs font-bold opacity-75">Total Pendapatan Denda</h6>
                            <h2 class="mb-0 font-bold">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm bg-white text-dark">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Kode</th>
                                    <th>Anggota</th>
                                    <th>Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Status</th>
                                    <th class="text-end">Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksis as $t)
                                    <tr>
                                        <td><code>{{ $t->kode_transaksi }}</code></td>
                                        <td>{{ $t->anggota->nama }}</td>
                                        <td>{{ $t->buku->judul }}</td>
                                        <td>{{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($t->tanggal_kembali)->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge {{ $t->status == 'Dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                                                {{ $t->status }}
                                            </span>
                                        </td>
                                        <td class="text-end fw-bold text-danger">
                                            Rp {{ number_format($t->denda ?? 0, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Tidak ada data transaksi yang sesuai filter.</td>
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