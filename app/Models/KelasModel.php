<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
	protected $table      = 'kelas';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'kode_kelas', 'nama_kelas', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getKelas()
	{
		$query = $this->db->table('kelas');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$query->orderBy('id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$cek = $this->cekKode($data['kode_kelas']);
		if (count($cek) > 0) {
			return false; // kode jurusan sudah ada
		}
		$query = $this->db->table('kelas');
		return $query->insert($data); // true jika berhasil, false jika gagal
	}

	public function cekKode($kode_kelas)
	{
		return $this->db->table('kelas')
			->where('kode_kelas', $kode_kelas)
			->where('status_cd', 'normal')
			->orderBy('id', 'DESC')
			->get()
			->getResult();
	}

	public function get_by_id($id)
	{
		return $this->db->table('kelas')
			->select('*')
			->where('id', $id)
			->get()
			->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
	}

	public function updateData($id, $data)
	{
		$cek = $this->db->table('kelas')
			->where('kode_kelas', $data['kode_kelas'])
			->where('status_cd', 'normal')
			->where('id !=', $id) // <<< abaikan record yang sedang diedit
			->get()
			->getResult();

		if (count($cek) > 0) {
			return false; // kode_jurusan sudah digunakan oleh record lain
		}

		// Update data
		return $this->db->table('kelas')
			->where('id', $id)
			->update($data);
	}

	public function softDelete($id, $data)
	{
		$query = $this->db->table('kelas');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}
}
