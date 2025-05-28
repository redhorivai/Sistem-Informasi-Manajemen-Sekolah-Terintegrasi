<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;


class Guru extends BaseController
{
	protected $m_guru;
	protected $session;

	public function __construct()
	{
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
		$data = ['title' => 'data guru', 'active' => 'guru'];
		return view('admin/guru/index', $data);
	}

	public function getData()
	{
		$res	= $this->m_guru->getGuru();
		$nomor = 1;
		if (count($res) > 0) {
			foreach ($res as $key) {
				if ($key->status == 'asn') {
					$status = "ASN";
				} elseif ($key->status == 'pppk') {
					$status = "PPPK";
				} else {
					$status = "Non PNSD";
				}
				if ($key->jabatan == 'wali_kelas') {
					$jabatan = "Wali Kelas";
				} else {
					$jabatan = "Guru Mata Pelajaran";
				}
				$nama_guru	= "$key->nama_lengkap, $key->gelar_belakang";
				$output[] = array(
					'col1'		=> $nomor++,
					'col2'		=> $nama_guru,
					'col3'		=> $key->nuptk,
					'col4'		=> $status,
					'col5'		=> $jabatan,
					'action'		=> "<span><a onclick='_btnEdit(\"$key->id\",\"$key->nuptk\")'><button type='button' class='btn bg-gradient-primary btn-sm'><i class='nav-icon fas fa-pen'></i> Ubah</button></a></span><span><a  onclick='_btnDelete(\"$key->id\",\"$key->nuptk\")'><button type='button' class='btn bg-gradient-danger btn-sm'><i class='nav-icon fas fa-trash'></i> Hapus</button></a></span>",
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
			$nama_lengkap		= $this->request->getVar('nama_lengkap');
			$gelar_belakang		= $this->request->getVar('gelar_belakang');
			$nik				= $this->request->getVar('nik');
			$nuptk				= $this->request->getVar('nuptk');
			$email				= $this->request->getVar('email');
			$telepon			= $this->request->getVar('telepon');
			$jenis_kelamin		= $this->request->getVar('jenis_kelamin');
			$alamat				= $this->request->getVar('alamat');
			$status				= $this->request->getVar('status');
			$jabatan			= $this->request->getVar('jabatan');


			$data = [
				'nama_lengkap' 		=> strtoupper($nama_lengkap),
				'gelar_belakang' 	=> strtoupper($gelar_belakang),
				'nik' 				=> $nik,
				'nuptk' 			=> $nuptk,
				'email' 			=> $email,
				'telepon' 			=>  $telepon,
				'jenis_kelamin' 	=> $jenis_kelamin,
				'alamat' 			=> strtoupper($alamat),
				'status' 			=> $status,
				'jabatan' 			=> $jabatan,
				'created_user'		=> session()->get('id'),
				'created_dttm'		=> date('Y-m-d H:i:s')
			];
			$res = $this->m_guru->insertData($data);
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
			$data = (array) $this->m_guru->get_by_id($id);
			// print_r($data);
			echo json_encode($data);
		} else {
			exit('Request Error');
		}
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$id					= $this->request->getVar('id');
			$nama_lengkap		= $this->request->getVar('nama_lengkap');
			$gelar_belakang		= $this->request->getVar('gelar_belakang');
			$nik				= $this->request->getVar('nik');
			$nuptk				= $this->request->getVar('nuptk');
			$email				= $this->request->getVar('email');
			$telepon			= $this->request->getVar('telepon');
			$jenis_kelamin		= $this->request->getVar('jenis_kelamin');
			$alamat				= $this->request->getVar('alamat');
			$status				= $this->request->getVar('status');
			$jabatan			= $this->request->getVar('jabatan');

			$data = [
				'nama_lengkap' 		=> strtoupper($nama_lengkap),
				'gelar_belakang' 	=> strtoupper($gelar_belakang),
				'nik' 				=> $nik,
				'nuptk' 			=> $nuptk,
				'email' 			=> $email,
				'telepon' 			=>  $telepon,
				'jenis_kelamin' 	=> $jenis_kelamin,
				'alamat' 			=> strtoupper($alamat),
				'status' 			=> $status,
				'jabatan' 			=> $jabatan,
				'updated_user'		=> session()->get('id'),
				'updated_dttm'		=> date('Y-m-d H:i:s'),
			];
			$res = $this->m_guru->updateData($id, $data);
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
			$res = $this->m_guru->softDelete($id, $data);
			if ($res) {
				echo json_encode(['sukses' => true]);
			} else {
				echo json_encode(['gagal' => true]);
			}
		}
	}
}
