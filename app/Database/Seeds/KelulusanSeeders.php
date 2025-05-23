<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelulusanSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['id_jurusan' => '1', 'id_kelas' => '1', 'id_akademik' => '1', 'id_guru' => '1', 'id_siswa' => '1', 'status_kelulusan' => 'lulus', 'keterangan' => 'selamat anda berhasil dan terus belajar yang rajjn', 'waktu_pengumuman' => '2024-06-01', 'created_dttm' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('kelulusan')->insertBatch($data);
    }
}
