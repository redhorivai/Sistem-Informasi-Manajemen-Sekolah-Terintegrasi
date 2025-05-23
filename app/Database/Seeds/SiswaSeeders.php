<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaSeeders extends Seeder
{
    public function run()
    {
        $data = [
            ['id_guru' => '1', 'id_kelas' => '1', 'id_jurusan' => '1', 'nama_lengkap' => 'Setian Novanto', 'nis' => '12345678', 'nik' => '167123456789', 'email' => 'setian_novanto@mail.com', 'telepon' => '08189235212', 'jenis_kelamin' => 'L', 'alamat' => 'jalan perangkat daerah konoha', 'waktu_masuk' => '2024-04-01', 'created_dttm' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('siswa')->insertBatch($data);
    }
}
