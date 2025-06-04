<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanSekolahModel extends Model
{
	protected $table      = 'pengaturan_sekolah';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'nama_sekolah', 'telepon_sekolah', 'email_sekolah', 'link_facebook', 'link_youtube', 'link_instagram', 'deskripsi_sekolah', 'alamat_sekolah', 'file_icon', 'file_logo', 'file_slider', 'deskripsi_footer', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getPengaturanSekolah()
	{
		$query = $this->db->table('pengaturan_sekolah');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$query->orderBy('id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}
	public function updateData($id, $data)
	{
		// Update data
		return $this->db->table('pengaturan_sekolah')
			->where('id', $id)
			->update($data);
	}
}
