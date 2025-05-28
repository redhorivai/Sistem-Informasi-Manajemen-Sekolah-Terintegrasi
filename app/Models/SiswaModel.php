<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
	protected $table      = 'siswa';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'id_guru', 'id_kelas', 'id_jurusan', 'nama_lengkap', 'nis', 'nik', 'email', 'telepon', 'jenis_kelamin', 'alamat', 'waktu_masuk', ' status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	// Untuk datatables
	protected $column_order = ['siswa.id', 'siswa.nama_lengkap', 'siswa.nis', 'kelas.nama_kelas'];
	protected $column_search = ['siswa.nama_lengkap', 'siswa.nis', 'kelas.nama_kelas'];
	protected $order = ['siswa.id' => 'DESC'];

	public function __construct()
	{
		parent::__construct();
		$this->db = \Config\Database::connect();
		$this->builder = $this->db->table($this->table);
	}

	private function _get_datatables_query($kelas_id = null)
	{
		$this->builder->select('siswa.*, kelas.nama_kelas,guru.nama_lengkap as nama_guru');
		$this->builder->join('kelas', 'kelas.id = siswa.id_kelas', 'left');;
		$this->builder->join('guru', 'guru.id = siswa.id_guru', 'left');;
		$this->builder->where('siswa.status_cd', 'normal');;

		if ($kelas_id) {
			$this->builder->where('kelas.id', $kelas_id);
		}

		// Search
		if ($_POST['search']['value']) {
			$i = 0;
			foreach ($this->column_search as $item) {
				if ($i === 0) {
					$this->builder->groupStart();
					$this->builder->like($item, $_POST['search']['value']);
				} else {
					$this->builder->orLike($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 === $i)
					$this->builder->groupEnd();
				$i++;
			}
		}

		// Order
		if (isset($_POST['order'])) {
			$this->builder->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if ($this->order) {
			foreach ($this->order as $key => $val) {
				$this->builder->orderBy($key, $val);
			}
		}
	}

	public function get_datatables($kelas_id = null)
	{
		$this->_get_datatables_query($kelas_id);
		if ($_POST['length'] != -1) {
			$this->builder->limit($_POST['length'], $_POST['start']);
		}
		return $this->builder->get()->getResult();
	}

	public function count_filtered($kelas_id = null)
	{
		$this->_get_datatables_query($kelas_id);
		return $this->builder->countAllResults();
	}

	public function count_all()
	{
		return $this->db->table($this->table)->countAll();
	}

	public function insertData($data)
	{
		$cek = $this->cekNis($data['nis']);
		if (count($cek) > 0) {
			return false; // kode jurusan sudah ada
		}
		$query = $this->db->table('siswa');
		return $query->insert($data); // true jika berhasil, false jika gagal
	}

	public function cekNis($nis)
	{
		return $this->db->table('siswa')
			->where('nis', $nis)
			->where('status_cd', 'normal')
			->orderBy('id', 'DESC')
			->get()
			->getResult();
	}

	public function updateData($id, $data)
	{
		$cek = $this->db->table('siswa')
			->where('nis', $data['nis'])
			->where('status_cd', 'normal')
			->where('id !=', $id) // <<< abaikan record yang sedang diedit
			->get()
			->getResult();

		if (count($cek) > 0) {
			return false; // kode_jurusan sudah digunakan oleh record lain
		}

		// Update data
		return $this->db->table('siswa')
			->where('id', $id)
			->update($data);
	}

	public function get_by_id($id)
	{
		return $this->db->table('siswa')
			->select('siswa.*, guru.nama_lengkap as nama_guru, kelas.nama_kelas, jurusan.nama_jurusan')
			->join('guru', 'guru.id = siswa.id_guru', 'left')
			->join('kelas', 'kelas.id = siswa.id_kelas', 'left')
			->join('jurusan', 'jurusan.id = siswa.id_jurusan', 'left')
			->where('siswa.id', $id)
			->get()
			->getRowArray();
	}

	public function softDelete($id, $data)
	{
		$query = $this->db->table('siswa');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}
}
