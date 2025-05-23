<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
	protected $table      = 'jurusan';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'kode_jurusan', 'nama_jurusan', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getJurusan()
	{
		$query = $this->db->table('jurusan');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$query->orderBy('id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$cek = $this->cekKode($data['kode_jurusan']);
		if (count($cek) > 0) {
			return false; // kode jurusan sudah ada
		}
		$query = $this->db->table('jurusan');
		return $query->insert($data); // true jika berhasil, false jika gagal
	}

	public function cekKode($kode_jurusan)
	{
		return $this->db->table('jurusan')
			->where('kode_jurusan', $kode_jurusan)
			->where('status_cd', 'normal')
			->orderBy('id', 'DESC')
			->get()
			->getResult();
	}

	public function get_by_id($id)
	{
		return $this->db->table('jurusan')
			->select('*')
			->where('id', $id)
			->get()
			->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
	}

	public function updateData($id, $data)
	{
		$cek = $this->db->table('jurusan')
			->where('kode_jurusan', $data['kode_jurusan'])
			->where('status_cd', 'normal')
			->where('id !=', $id) // <<< abaikan record yang sedang diedit
			->get()
			->getResult();

		if (count($cek) > 0) {
			return false; // kode_jurusan sudah digunakan oleh record lain
		}

		// Update data
		return $this->db->table('jurusan')
			->where('id', $id)
			->update($data);
	}

	public function softDelete($id, $data)
	{
		$query = $this->db->table('jurusan');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}
}
