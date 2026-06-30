<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi #' . $transaksi->kode_transaksi) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{ -- Notifikasi Sukses -- }}
            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @php
                $tglKembali = \Carbon\Carbon::parse($transaksi->tanggal_kembali);
                $hariIni = \Carbon\Carbon::now();
            @endphp

            @if($transaksi->status == 'Dipinjam' && $hariIni->greaterThan($tglKembali))
                @php 
                    $hariTerlambat = $tglKembali->diffInDays($hariIni); 
                @endphp
                <div class="alert alert-danger mb-4 fw-bold shadow-sm animate-bounce">
                    ⚠️ PENGINGAT KETERLAMBATAN:<br>
                    <span class="fw-normal">Buku ini sudah melewati batas pengembalian selama <strong>{{ $hariTerlambat }} hari</strong>. Estimasi denda saat ini: <strong class="text-decoration-underline">Rp {{ number_format($hariTerlambat * 5000, 0, ',', '.') }}</strong>.</span>
                </div>
            @endif
            {{ -- AKHIR WARNING BOX -- }}

            <div class="card shadow-sm text-dark bg-white">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="bi bi-info-circle"></i> Detail Peminjaman</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th width="30%">Kode Transaksi</th><td><code>{{ $transaksi->kode_transaksi }}</code></td></tr>
                        <tr><th>Nama Anggota</th><td>{{ $transaksi->anggota->nama }}</td></tr>
                        <tr><th>Judul Buku</th><td>{{ $transaksi->buku->judul }}</td></tr>
                        <tr><th>Tanggal Pinjam</th><td>{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td></tr>
                        <tr><th>Batas Pengembalian</th><td>{{ $transaksi->tanggal_kembali->format('d M Y') }}</td></tr>
                        <tr>
                            <th>Tanggal Dikembalikan</th>
                            <td>{{ $transaksi->tanggal_dikembalikan ? $transaksi->tanggal_dikembalikan->format('d M Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $transaksi->status == 'Dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                                    {{ $transaksi->status }}
                                </span>
                            </td>
                        </tr>
                        <tr><th>Denda</th><td class="text-danger fw-bold">Rp {{ number_format($transaksi->denda ?? 0, 0, ',', '.') }}</td></tr>
                        <tr><th>Keterangan</th><td>{{ $transaksi->keterangan ?? '-' }}</td></tr>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke List
                        </a>

                        @if($transaksi->status == 'Dipinjam')
                            <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" onsubmit="return confirm('Apakah buku ini benar-benar dikembalikan hari ini?')">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-arrow-counterclockwise"></i> Kembalikan Buku
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>