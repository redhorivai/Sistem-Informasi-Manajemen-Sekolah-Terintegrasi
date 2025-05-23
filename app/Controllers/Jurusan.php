<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;


class Jurusan extends BaseController
{
	protected $m_jurusan;
	protected $session;

	public function __construct()
	{
		$this->m_jurusan = new JurusanModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/admin'));
		}
		$data = ['title' => 'data jurusan', 'active' => 'jurusan'];
		return view('admin/jurusan/index', $data);
	}

	public function getData()
	{
		$res	= $this->m_jurusan->getJurusan();
		$nomor = 1;
		if (count($res) > 0) {
			foreach ($res as $key) {
				$output[] = array(
					'col1'		=> $nomor++,
					'col2'		=> $key->kode_jurusan,
					'col3'		=> $key->nama_jurusan,
					'col4'		=> $key->keterangan,
					'action'		=> "<span><a onclick='_btnEdit(\"$key->id\",\"$key->kode_jurusan\",\"$key->nama_jurusan\")'><button type='button' class='btn bg-gradient-primary btn-sm'><i class='nav-icon fas fa-pen'></i> Ubah</button></a></span><span><a  onclick='_btnDelete(\"$key->id\",\"$key->kode_jurusan\",\"$key->nama_jurusan\")'><button type='button' class='btn bg-gradient-danger btn-sm'><i class='nav-icon fas fa-trash'></i> Hapus</button></a></span>",
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
			$kode_jurusan		= $this->request->getVar('kode_jurusan');
			$nama_jurusan		= $this->request->getVar('nama_jurusan');
			$keterangan			= $this->request->getVar('keterangan');

			$data = [
				'kode_jurusan' 	=> $kode_jurusan,
				'nama_jurusan' 	=> strtoupper($nama_jurusan),
				'keterangan' 	=> strtoupper($keterangan),
				'created_user'	=> session()->get('id'),
				'created_dttm'	=> date('Y-m-d H:i:s')
			];
			$res = $this->m_jurusan->insertData($data);
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
			$data = (array) $this->m_jurusan->get_by_id($id);
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
			$kode_jurusan	= $this->request->getVar('kode_jurusan');
			$nama_jurusan	= $this->request->getVar('nama_jurusan');
			$keterangan		= $this->request->getVar('keterangan');

			$data = [
				'kode_jurusan'		=> $kode_jurusan,
				'nama_jurusan'		=> strtoupper($nama_jurusan),
				'keterangan'		=> strtoupper($keterangan),
				'updated_user'		=> session()->get('id'),
				'updated_dttm'		=> date('Y-m-d H:i:s'),
			];
			$res = $this->m_jurusan->updateData($id, $data);
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
			$res = $this->m_jurusan->softDelete($id, $data);
			if ($res) {
				echo json_encode(['sukses' => true]);
			} else {
				echo json_encode(['gagal' => true]);
			}
		}
	}
}
