<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
	protected $table      = 'guru';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'nama_lengkap', 'gelar_belakang', 'nik', 'nuptk', 'email', 'telepon', 'jenis_kelamin', 'alamat', 'status', 'jabatan',' status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getGuru()
	{
		$query = $this->db->table('guru');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$query->orderBy('id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$cek = $this->cekKode($data['nuptk']);
		if (count($cek) > 0) {
			return false; // kode jurusan sudah ada
		}
		$query = $this->db->table('guru');
		return $query->insert($data); // true jika berhasil, false jika gagal
	}

	public function cekKode($nuptk)
	{
		return $this->db->table('guru')
			->where('nuptk', $nuptk)
			->where('status_cd', 'normal')
			->orderBy('id', 'DESC')
			->get()
			->getResult();
	}

	public function get_by_id($id)
	{
		return $this->db->table('guru')
			->select('*')
			->where('id', $id)
			->get()
			->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
	}

	public function updateData($id, $data)
	{
		$cek = $this->db->table('guru')
			->where('nuptk', $data['nuptk'])
			->where('status_cd', 'normal')
			->where('id !=', $id) // <<< abaikan record yang sedang diedit
			->get()
			->getResult();

		if (count($cek) > 0) {
			return false; // kode_jurusan sudah digunakan oleh record lain
		}

		// Update data
		return $this->db->table('guru')
			->where('id', $id)
			->update($data);
	}

	public function softDelete($id, $data)
	{
		$query = $this->db->table('guru');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}
}
