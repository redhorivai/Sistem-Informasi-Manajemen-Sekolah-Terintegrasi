<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BeritaArtikelSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['tipe' => 'berita', 'judul' => 'Kegiatan WorkShop Pelajar Berprestasi', 'deskripsi' => 'Menciptakan siswa siswi yang berprestasi dengan dibantu oleh guru-guru yang handal dibidangnya', 'thumbnail' => 'gambar judul', 'banner' => 'gambar banner', 'created_dttm' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('berita_artikel')->insertBatch($data);
    }
}
