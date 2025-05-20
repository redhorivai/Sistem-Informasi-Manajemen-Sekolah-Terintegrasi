<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JurusanSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_jurusan' => '001', 'nama_jurusan' => 'IPA', 'keterangan' => 'Ilmu Pengetahuan Alam', 'created_dttm' => date('Y-m-d H:i:s')],
            ['kode_jurusan' => '002', 'nama_jurusan' => 'IPS', 'keterangan' => 'Ilmu Pengetahuan Sosial', 'created_dttm' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('jurusan')->insertBatch($data);
    }
}