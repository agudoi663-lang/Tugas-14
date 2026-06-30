<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Kategori Buku</h1>
        <p class="lead">Pilih kategori buku yang ingin anda lihat.</p>

        <div class="row">
            @foreach ($kategori_list as $kategori)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ $kategori['nama'] }}</h5>
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
    </div>
</body>
</html>