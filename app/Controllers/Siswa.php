<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\JurusanModel;
use App\Models\GuruModel;

class Siswa extends BaseController
{
	protected $m_siswa;
	protected $m_kelas;
	protected $m_jurusan;
	protected $m_guru;
	protected $session;

	public function __construct()
	{
		$this->m_siswa = new SiswaModel();
		$this->m_kelas = new KelasModel();
		$this->m_jurusan = new JurusanModel();
		$this->m_guru = new GuruModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/admin'));
		}
		// dd($res_kelas);
		$data = ['title' => 'data siswa', 'active' => 'siswa'];
		return view('admin/siswa/index', $data);
	}

	public function get_kelas()
	{
		$kelas = $this->m_kelas->findAll();
		return $this->response->setJSON($kelas);
	}

	public function getData()
	{
		$kelas_id = $this->request->getPost('kelas_id');
		$data = $this->m_siswa->get_datatables($kelas_id);

		$result = [];
		$no = $this->request->getPost('start');

		foreach ($data as $item) {
			$no++;
			$result[] = [
				'no' => $no,
				'nama' => $item->nama_lengkap,
				'nis' => $item->nis,
				'wali_kelas' => $item->nama_guru,
				'nama_kelas' => $item->nama_kelas,
				'aksi' => "<span><a onclick='_btnEdit(\"$item->id\",\"$item->nama_lengkap\",\"$item->nama_kelas\")'><button type='button' class='btn bg-gradient-primary btn-sm'><i class='nav-icon fas fa-pen'></i> Ubah</button></a></span><span><a  onclick='_btnDelete(\"$item->id\",\"$item->nama_lengkap\",\"$item->nama_kelas\")'><button type='button' class='btn bg-gradient-danger btn-sm'><i class='nav-icon fas fa-trash'></i> Hapus</button></a></span>"
			];
		}

		return $this->response->setJSON([
			'draw' => $this->request->getPost('draw'),
			'recordsTotal' => $this->m_siswa->count_all(),
			'recordsFiltered' => $this->m_siswa->count_filtered($kelas_id),
			'data' => $result,
		]);
	}

	public function getOptions()
	{

		$data = [
			'guru' => $this->m_guru->findAll(),
			'kelas' => $this->m_kelas->findAll(),
			'jurusan' => $this->m_jurusan->findAll(),
		];

		return $this->response->setJSON($data);
	}

	public function insert_data()
	{
		if ($this->request->isAJAX()) {
			$id_guru			= $this->request->getVar('id_guru');
			$id_kelas			= $this->request->getVar('id_kelas');
			$id_jurusan			= $this->request->getVar('id_jurusan');
			$nama_lengkap		= $this->request->getVar('nama_lengkap');
			$nis				= $this->request->getVar('nis');
			$nik				= $this->request->getVar('nik');
			$email				= $this->request->getVar('email');
			$telepon			= $this->request->getVar('telepon');
			$jenis_kelamin		= $this->request->getVar('jenis_kelamin');
			$alamat				= $this->request->getVar('alamat');
			$waktu_masuk		= $this->request->getVar('waktu_masuk');

			$data = [
				'id_guru' => $id_guru,
				'id_kelas' => $id_kelas,
				'id_jurusan' => $id_jurusan,
				'nama_lengkap' => $nama_lengkap,
				'nis' => $nis,
				'nik' => $nik,
				'email' => $email,
				'telepon' => $telepon,
				'jenis_kelamin' => $jenis_kelamin,
				'alamat' => $alamat,
				'waktu_masuk' => $waktu_masuk,
				'created_user' => session()->get('id'),
				'created_dttm' => date('Y-m-d H:i:s'),
			];
			$res = $this->m_siswa->insertData($data);
			if ($res) {
				return $this->response->setJSON(['sukses' => true]);
			} else {
				return $this->response->setJSON(['gagal' => true]);
			}
		}
	}

	public function get_edit()
	{
		if ($this->request->isAJAX()) {
			$id		= $this->request->getVar('id');
			$data = (array) $this->m_siswa->get_by_id($id);
			echo json_encode($data);
		} else {
			exit('Request Error');
		}
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');

			$data = [
				'id_guru' => $this->request->getVar('id_guru'),
				'id_kelas' => $this->request->getVar('id_kelas'),
				'id_jurusan' => $this->request->getVar('id_jurusan'),
				'nama_lengkap' => $this->request->getVar('nama_lengkap'),
				'nis' => $this->request->getVar('nis'),
				'nik' => $this->request->getVar('nik'),
				'email' => $this->request->getVar('email'),
				'telepon' => $this->request->getVar('telepon'),
				'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
				'alamat' => $this->request->getVar('alamat'),
				'waktu_masuk' => $this->request->getVar('waktu_masuk'),
				'updated_user' => session()->get('id'),
				'updated_dttm' => date('Y-m-d H:i:s'),
			];

			$res = $this->m_siswa->updateData($id, $data);
			if ($res) {
				return $this->response->setJSON(['sukses' => true]);
			} else {
				return $this->response->setJSON(['gagal' => true]);
			}
		}
	}

	public function del_data()
	{
		if ($this->request->isAJAX()) {
			$id		= $this->request->getVar('id');
			$data	= [
				'status_cd'		 => 'nullified',
				'nullified_user' => session()->get('id'),
				'nullified_dttm' => date('Y-m-d H:i:s'),
			];
			$res = $this->m_siswa->softDelete($id, $data);
			if ($res) {
				echo json_encode(['sukses' => true]);
			} else {
				echo json_encode(['gagal' => true]);
			}
		}
	}
}
