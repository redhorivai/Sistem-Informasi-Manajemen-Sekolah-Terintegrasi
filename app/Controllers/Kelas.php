<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;


class Kelas extends BaseController
{
	protected $m_kelas;
	protected $session;

	public function __construct()
	{
		$this->m_kelas = new KelasModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/admin'));
		}
		$data = ['title' => 'data kelas', 'active' => 'kelas'];
		return view('admin/kelas/index', $data);
	}

	public function getData()
	{
		$res	= $this->m_kelas->getKelas();
		$nomor = 1;
		if (count($res) > 0) {
			foreach ($res as $key) {
				$output[] = array(
					'col1'		=> $nomor++,
					'col2'		=> $key->kode_kelas,
					'col3'		=> $key->nama_kelas,
					'col4'		=> $key->keterangan,
					'action'		=> "<span><a onclick='_btnEdit(\"$key->id\",\"$key->kode_kelas\",\"$key->nama_kelas\")'><button type='button' class='btn bg-gradient-primary btn-sm'><i class='nav-icon fas fa-pen'></i> Ubah</button></a></span><span><a  onclick='_btnDelete(\"$key->id\",\"$key->kode_kelas\",\"$key->nama_kelas\")'><button type='button' class='btn bg-gradient-danger btn-sm'><i class='nav-icon fas fa-trash'></i> Hapus</button></a></span>",
				);
				$ret = array('data' => $output);
			}
		} else {
			$ret = array('data' => []);
		}
		return $this->response->setJSON($ret);
	}

	public function insert_data()
	{
		if ($this->request->isAJAX()) {
			$kode_kelas			= $this->request->getVar('kode_kelas');
			$nama_kelas			= $this->request->getVar('nama_kelas');
			$keterangan			= $this->request->getVar('keterangan');

			$data = [
				'kode_kelas' 	=> $kode_kelas,
				'nama_kelas' 	=> strtoupper($nama_kelas),
				'keterangan' 	=> strtoupper($keterangan),
				'created_user'	=> session()->get('id'),
				'created_dttm'	=> date('Y-m-d H:i:s')
			];
			$res = $this->m_kelas->insertData($data);
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
			$data = (array) $this->m_kelas->get_by_id($id);
			// print_r($data);
			echo json_encode($data);
		} else {
			exit('Request Error');
		}
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$id				= $this->request->getVar('id');
			$kode_kelas		= $this->request->getVar('kode_kelas');
			$nama_kelas		= $this->request->getVar('nama_kelas');
			$keterangan		= $this->request->getVar('keterangan');

			$data = [
				'kode_kelas'		=> $kode_kelas,
				'nama_kelas'		=> strtoupper($nama_kelas),
				'keterangan'		=> strtoupper($keterangan),
				'updated_user'		=> session()->get('id'),
				'updated_dttm'		=> date('Y-m-d H:i:s'),
			];
			$res = $this->m_kelas->updateData($id, $data);
			if ($res) {
				echo json_encode(['sukses' => true]);
			} else {
				echo json_encode(['gagal' => true]);
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
			$res = $this->m_kelas->softDelete($id, $data);
			if ($res) {
				echo json_encode(['sukses' => true]);
			} else {
				echo json_encode(['gagal' => true]);
			}
		}
	}
}
