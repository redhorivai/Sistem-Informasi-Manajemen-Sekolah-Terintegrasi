<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GuruSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_lengkap' => 'Susi Susanty', 'gelar_belakang' => 'S.Pd', 'nik' => '167192848251', 'nip' => '1952525212', 'email' => 'setian_novanto@mail.com', 'telepon' => '08189235212', 'jenis_kelamin' => 'P', 'alamat' => 'jalan tanpa tanda jasa', 'status' => 'asn', 'jabatan' => 'wali_kelas', 'created_dttm' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('guru')->insertBatch($data);
    }
}
