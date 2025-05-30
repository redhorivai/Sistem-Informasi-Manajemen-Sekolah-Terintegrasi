<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaArtikelModel extends Model
{
	protected $table      = 'berita_artikel';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'tipe', 'judul', 'deskripsi', 'thumbnail', 'banner', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getBeritaJurusan()
	{
		$query = $this->db->table('berita_artikel');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$query->orderBy('id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$query = $this->db->table('berita_artikel');
		return $query->insert($data); 
	}

	public function get_by_id($id)
	{
		return $this->db->table('berita_artikel')
			->select('*')
			->where('id', $id)
			->get()
			->getRowArray(); // ✅ langsung mengembalikan array, bukan stdClass
	}

	public function updateData($id, $data)
	{
		// Update data
		return $this->db->table('berita_artikel')
			->where('id', $id)
			->update($data);
	}

	public function softDelete($id, $data)
	{
		$query = $this->db->table('berita_artikel');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}
}
