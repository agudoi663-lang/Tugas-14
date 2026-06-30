<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h2 mb-0">
                            <i class="bi bi-book"></i>
                            Daftar Buku
                        </h1>
                        <div class="d-flex gap-2">
                            <a href="{{ route('buku.export') }}" class="btn btn-success">
                                <i class="bi bi-download"></i> Export CSV
                            </a>
                            <a href="{{ route('buku.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Buku
                            </a>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-1">Total Buku</h6>
                                            <h2 class="mb-0">{{ $totalBuku }}</h2>
                                        </div>
                                        <div class="text-primary">
                                            <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-1">Buku Tersedia</h6>
                                            <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                                        </div>
                                        <div class="text-success">
                                            <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-danger">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-1">Buku Habis</h6>
                                            <h2 class="mb-0">{{ $bukuHabis }}</h2>
                                        </div>
                                        <div class="text-danger">
                                            <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="bi bi-funnel"></i> Filter Kategori:
                            </h6>
                            <div class="btn-group" role="group">
                                <a href="{{ route('buku.index') }}" class="btn btn-sm {{ !isset($kategori) ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Semua
                                </a>
                                <a href="{{ route('buku.kategori', 'Programming') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Programming' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Programming
                                </a>
                                <a href="{{ route('buku.kategori', 'Database') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Database' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Database
                                </a>
                                <a href="{{ route('buku.kategori', 'Web Design') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Web Design' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Web Design
                                </a>
                                <a href="{{ route('buku.kategori', 'Networking') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Networking' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Networking
                                </a>
                                <a href="{{ route('buku.kategori', 'Data Science') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Data Science' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Data Science
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0"><i class="bi bi-search"></i> Pencarian & Filter Advanced</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('buku.search') }}" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Keyword</label>
                                        <input type="text"
                                               name="keyword"
                                               class="form-control"
                                               placeholder="Cari judul, pengarang, penerbit..."
                                               value="{{ request('keyword') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori" class="form-select">
                                            <option value="">Semua</option>
                                            <option value="Programming" {{ request('kategori') == 'Programming' ? 'selected' : '' }}>Programming</option>
                                            <option value="Database" {{ request('kategori') == 'Database' ? 'selected' : '' }}>Database</option>
                                            <option value="Web Design" {{ request('kategori') == 'Web Design' ? 'selected' : '' }}>Web Design</option>
                                            <option value="Networking" {{ request('kategori') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                            <option value="Data Science" {{ request('kategori') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Tahun</label>
                                        <select name="tahun" class="form-select">
                                            <option value="">Semua</option>
                                            @for ($i = date('Y'); $i >= 2020; $i--)
                                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Ketersediaan</label>
                                        <select name="ketersediaan" class="form-select">
                                            <option value="">Semua</option>
                                            <option value="tersedia" {{ request('ketersediaan') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="habis" {{ request('ketersediaan') == 'habis' ? 'selected' : '' }}>Habis</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <div class="d-grid w-100 gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i> Cari
                                            </button>
                                            <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                                                <i class="bi bi-x-circle"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('buku.bulk-delete') }}" method="POST" id="bulk-delete-form">
                        @csrf

                        <div class="card mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="select-all">
                                        <label class="form-check-label fw-bold" for="select-all">Pilih Semua</label>
                                    </div>
                                    <span id="selected-count" class="text-muted small">0 buku dipilih</span>
                                </div>
                                <button type="button" class="btn btn-danger btn-bulk-delete" disabled>
                                    <i class="bi bi-trash"></i> Hapus yang Dipilih
                                </button>
                            </div>
                        </div>

                        @forelse ($bukus as $buku)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                            <input type="checkbox" 
                                                   name="buku_ids[]" 
                                                   value="{{ $buku->id }}" 
                                                   class="form-check-input buku-checkbox"
                                                   style="width: 1.3rem; height: 1.3rem;">
                                        </div>
                                        <div class="col-md-1 text-center">
                                            <i class="bi bi-book text-primary" style="font-size: 4rem;"></i>
                                            <div class="mt-2">
                                                <span class="badge bg-{{ $buku->kategori == 'Programming' ? 'primary' : ($buku->kategori == 'Database' ? 'success' : ($buku->kategori == 'Web Design' ? 'info' : ($buku->kategori == 'Networking' ? 'warning' : 'danger'))) }}">
                                                    {{ $buku->kategori }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="card-title">
                                                <a href="{{ route('buku.show', $buku->id) }}" class="text-decoration-none">
                                                    {{ $buku->judul }}
                                                </a>
                                            </h5>
                                            <p class="card-text text-muted mb-2">
                                                <i class="bi bi-person"></i> {{ $buku->pengarang }} |
                                                <i class="bi bi-building"></i> {{ $buku->penerbit }} |
                                                <i class="bi bi-calendar"></i> {{ $buku->tahun_terbit }}
                                            </p>
                                            @if ($buku->isbn)
                                                <p class="card-text small text-muted mb-1">
                                                    <i class="bi bi-upc"></i> ISBN: {{ $buku->isbn }}
                                                </p>
                                            @endif
                                            @if ($buku->deskripsi)
                                                <p class="card-text">
                                                    {{ Str::limit($buku->deskripsi, 150) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-3 text-end">
                                            <h4 class="text-primary mb-2">{{ $buku->harga_format }}</h4>
                                            <div class="mb-3">
                                                @if ($buku->stok > 0)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle"></i> Tersedia
                                                    </span>
                                                    <div class="text-muted small mt-1">Stok: {{ $buku->stok }} buku</div>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-circle"></i> Habis
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-info text-white">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('buku.destroy', $buku->id) }}"
                                                      method="POST"
                                                      class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger w-100 btn-delete"
                                                            data-judul="{{ $buku->judul }}">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Tidak ada data buku
                                @isset($kategori)
                                    dengan kategori <strong>{{ $kategori }}</strong>
                                @endisset
                            </div>
                        @endforelse
                    </form>

                    @if ($bukus->count() > 0)
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                Menampilkan {{ $bukus->count() }} buku
                                @isset($kategori)
                                    dari kategori <strong>{{ $kategori }}</strong>
                                @endisset
                            </p>
                        </div>
                    @endif
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
            cb.checked = this.checked;
        });
        updateSelectedCount();
    });
    
    function updateSelectedCount() {
        const checked = document.querySelectorAll('input[name="buku_ids[]"]:checked').length;
        document.getElementById('selected-count').textContent = checked + ' buku dipilih';
        document.querySelector('.btn-bulk-delete').disabled = checked === 0;
    }

    document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
        cb.addEventListener('change', updateSelectedCount);
    });

    document.querySelector('.btn-bulk-delete').addEventListener('click', function() {
        const checked = document.querySelectorAll('input[name="buku_ids[]"]:checked').length;
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus ${checked} buku yang dipilih?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('bulk-delete-form').submit();
            }
        });
    });

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const judul = this.getAttribute('data-judul');
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush