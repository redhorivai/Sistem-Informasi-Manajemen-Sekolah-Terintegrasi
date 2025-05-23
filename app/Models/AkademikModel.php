<?php

namespace App\Models;

use CodeIgniter\Model;

class AkademikModel extends Model
{
	protected $table      = 'akademik';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'kode_akademik', 'tahun_akademik', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getAkademik()
	{
		$query = $this->db->table('akademik');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$query->orderBy('id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$cek = $this->cekKode($data['kode_akademik']);
		if (count($cek) > 0) {
			return false; // kode jurusan sudah ada
		}
		$query = $this->db->table('akademik');
		return $query->insert($data); // true jika berhasil, false jika gagal
	}

	public function cekKode($kode_akademik)
	{
		return $this->db->table('akademik')
			->where('kode_akademik', $kode_akademik)
			->where('status_cd', 'normal')
			->orderBy('id', 'DESC')
			->get()
			->getResult();
	}

	public function get_by_id($id)
	{
		return $this->db->table('akademik')
			->select('*')
			->where('id', $id)
			->get()
			->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
	}

	public function updateData($id, $data)
	{
		$cek = $this->db->table('akademik')
			->where('kode_akademik', $data['kode_akademik'])
			->where('status_cd', 'normal')
			->where('id !=', $id) // <<< abaikan record yang sedang diedit
			->get()
			->getResult();

		if (count($cek) > 0) {
			return false; // kode_jurusan sudah digunakan oleh record lain
		}

		// Update data
		return $this->db->table('akademik')
			->where('id', $id)
			->update($data);
	}

	public function softDelete($id, $data)
	{
		$query = $this->db->table('akademik');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}
}
