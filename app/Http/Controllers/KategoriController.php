<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku tentang database dan manajemen data',
                'jumlah_buku' => 15
            ],
            [
                'id' => 3,
                'nama' => 'Networking',
                'deskripsi' => 'Buku tentang jaringan komputer',
                'jumlah_buku' => 10
            ],
            [
                'id' => 4,
                'nama' => 'Design',
                'deskripsi' => 'Buku tentang desain grafis dan UI/UX',
                'jumlah_buku' => 20
            ],
            [
                'id' => 5,
                'nama' => 'Artificial Intelligence',
                'deskripsi' => 'Buku tentang kecerdasan buatan dan machine learning',
                'jumlah_buku' => 18
            ],
        ];

        return view('kategori.index', compact('kategori_list'));
    }

    public function show($id)
    {
        $kategori_list = [
            1 => [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            2 => [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku tentang database dan manajemen data',
                'jumlah_buku' => 15
            ],
            3 => [
                'id' => 3,
                'nama' => 'Networking',
                'deskripsi' => 'Buku tentang jaringan komputer',
                'jumlah_buku' => 10
            ],
            4 => [
                'id' => 4,
                'nama' => 'Design',
                'deskripsi' => 'Buku tentang desain grafis dan UI/UX',
                'jumlah_buku' => 20
            ],
            5 => [
                'id' => 5,
                'nama' => 'Artificial Intelligence',
                'deskripsi' => 'Buku tentang kecerdasan buatan dan machine learning',
                'jumlah_buku' => 18
            ],
        ];

        if (!isset($kategori_list[$id])) {
            abort(404, 'Kategori tidak ditemukan');
        }

        $kategori = $kategori_list[$id];

        $buku_list = [
            1 => [
                ['judul' => 'Pemrograman PHP', 'pengarang' => 'Budi Raharjo', 'tahun' => 2023],
                ['judul' => 'Laravel Framework', 'pengarang' => 'Andi Nugroho', 'tahun' => 2024],
                ['judul' => 'Python untuk Pemula', 'pengarang' => 'Siti Aminah', 'tahun' => 2023],
            ],
            2 => [
                ['judul' => 'MySQL Database', 'pengarang' => 'Siti Aminah', 'tahun' => 2023],
                ['judul' => 'PostgreSQL Advanced', 'pengarang' => 'Dedi Santoso', 'tahun' => 2024],
            ],
            3 => [
                ['judul' => 'Jaringan Komputer Dasar', 'pengarang' => 'Rina Wijaya', 'tahun' => 2023],
                ['judul' => 'Cisco Networking', 'pengarang' => 'Budi Raharjo', 'tahun' => 2024],
            ],
            4 => [
                ['judul' => 'UI/UX Design', 'pengarang' => 'Dewi Lestari', 'tahun' => 2023],
                ['judul' => 'Figma untuk Desainer', 'pengarang' => 'Rizky Pratama', 'tahun' => 2024],
            ],
            5 => [
                ['judul' => 'Machine Learning Dasar', 'pengarang' => 'Ahmad Fauzi', 'tahun' => 2023],
                ['judul' => 'Deep Learning dengan Python', 'pengarang' => 'Siti Aminah', 'tahun' => 2024],
            ],
        ];

        $buku_list = $buku_list[$id] ?? [];

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    public function search($keyword)
    {
        $semua_kategori = [
            [
                'id' => 1,
                'nama' => 'Programming',
                'deskripsi' => 'Buku pemrograman dan coding',
                'jumlah_buku' => 25
            ],
            [
                'id' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Buku tentang database dan manajemen data',
                'jumlah_buku' => 15
            ],
            [
                'id' => 3,
                'nama' => 'Networking',
                'deskripsi' => 'Buku tentang jaringan komputer',
                'jumlah_buku' => 10
            ],
            [
                'id' => 4,
                'nama' => 'Design',
                'deskripsi' => 'Buku tentang desain grafis dan UI/UX',
                'jumlah_buku' => 20
            ],
            [
                'id' => 5,
                'nama' => 'Artificial Intelligence',
                'deskripsi' => 'Buku tentang kecerdasan buatan dan machine learning',
                'jumlah_buku' => 18
            ],
        ];

        $hasil = array_filter($semua_kategori, function ($kategori) use ($keyword) {
            return stripos($kategori['nama'], $keyword) !== false ||
                   stripos($kategori['deskripsi'], $keyword) !== false;
        });

        return view('kategori.search', compact('hasil', 'keyword'));
    }
}