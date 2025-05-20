<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelasSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_kelas' => '001', 'nama_kelas' => 'VI/a', 'keterangan' => 'Kelas 6 A', 'created_dttm' => date('Y-m-d H:i:s')],
            ['kode_kelas' => '002', 'nama_kelas' => 'VI/b', 'keterangan' => 'Kelas 6 B', 'created_dttm' => date('Y-m-d H:i:s')],
            ['kode_kelas' => '003', 'nama_kelas' => 'VII/a', 'keterangan' => 'Kelas 7 A', 'created_dttm' => date('Y-m-d H:i:s')],
            ['kode_kelas' => '004', 'nama_kelas' => 'VII/b', 'keterangan' => 'Kelas 7 B', 'created_dttm' => date('Y-m-d H:i:s')],
            ['kode_kelas' => '005', 'nama_kelas' => 'VIII/a', 'keterangan' => 'Kelas 8 A', 'created_dttm' => date('Y-m-d H:i:s')],
            ['kode_kelas' => '006', 'nama_kelas' => 'VIII/b', 'keterangan' => 'Kelas 8 B', 'created_dttm' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('kelas')->insertBatch($data);
    }
}
