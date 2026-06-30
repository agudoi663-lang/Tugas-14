<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/kategori">Daftar Kategori</a></li>
                <li class="breadcrumb-item active">Hasil Pencarian</li>
            </ol>
        </nav>

        <h1>Hasil Pencarian Kategori</h1>
        <p class="lead">Keyword: <strong>{{ $keyword }}</strong></p>

        @if (count($hasil) > 0)
            <div class="row">
                @foreach ($hasil as $kategori)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                {{ $kategori['nama'] }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $kategori['deskripsi'] }}</p>
                            <p><strong>Jumlah Buku:</strong> {{ $kategori['jumlah_buku'] }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="/kategori/{{ $kategori['id'] }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning">
                Tidak ada kategori yang ditemukan dengan keyword <strong>{{ $keyword }}</strong>.
            </div>
        @endif

        <div class="mt-3">
            <a href="/kategori" class="btn btn-secondary">
                &larr; Kembali ke Daftar Kategori
            </a>
        </div>
    </div>
</body>
</html>