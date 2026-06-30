<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; padding: 0; }
        .header p { margin: 5px 0 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-end { text-align: right; }
        .summary-box { float: right; width: 300px; margin-top: 10px; }
        .summary-box table { border: none; }
        .summary-box td { border: none; padding: 4px 0; }
        .fw-bold { font-weight: bold; }
        .text-danger { color: #dc3545; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN TRANSAKSI PERPUSTAKAAN</h2>
        <p>Dicetak pada tanggal: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="12%">Kode</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th width="15%">Tgl Pinjam</th>
                <th width="15%">Tgl Kembali</th>
                <th width="12%">Status</th>
                <th width="15%" class="text-end">Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $t)
                <tr>
                    <td>{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->anggota->nama }}</td>
                    <td>{{ $t->buku->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal_kembali)->format('d/m/Y') }}</td>
                    <td>{{ $t->status }}</td>
                    <td class="text-end text-danger fw-bold">Rp {{ number_format($t->denda ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-box">
        <table>
            <tr>
                <td>Total Transaksi</td>
                <td>:</td>
                <td class="fw-bold">{{ $totalTransaksi }} Data</td>
            </tr>
            <tr>
                <td>Total Pendapatan Denda</td>
                <td>:</td>
                <td class="fw-bold text-danger">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

</body>
</html>