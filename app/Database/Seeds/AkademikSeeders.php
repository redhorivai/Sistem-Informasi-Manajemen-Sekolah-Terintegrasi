<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AkademikSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_akademik' => '001', 'tahun_akademik' => '2025', 'keterangan' => 'Kurikulum Merdeka', 'created_dttm' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('akademik')->insertBatch($data);
    }
}
