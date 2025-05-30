<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaArtikelModel;


class BeritaArtikel extends BaseController
{
	protected $m_berita_artikel;
	protected $session;

	public function __construct()
	{
		$this->m_berita_artikel = new BeritaArtikelModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/admin'));
		}
		$data = ['title' => 'data berita / artikel', 'active' => 'beritaartikel'];
		return view('admin/beritaartikel/index', $data);
	}

	public function getData()
	{
		$res	= $this->m_berita_artikel->getBeritaJurusan();
		$nomor = 1;
		if (count($res) > 0) {
			foreach ($res as $key) {
				if ($key->thumbnail == NULL) {
					$thumb = "<img style='width:50px;' src='" . base_url('assets-admin/uploads/400x300.png') . "'>";
				} else {
					$thumb = "<img style='width:50px;' src='" . base_url('assets-admin/uploads/' . $key->thumbnail) . "'>";
				}
				if ($key->banner == NULL) {
					$banner = "<img style='width:50px;' src='" . base_url('assets-admin/uploads/800x600.png') . "'>";
				} else {
					$banner = "<img style='width:50px;' src='" . base_url('assets-admin/uploads/' . $key->banner) . "'>";
				}
				$output[] = array(
					'col1'		=> $nomor++,
					'col2'		=> $key->tipe,
					'col3'		=> $key->judul,
					'col4'		=> $key->deskripsi,
					'col5'		=> $thumb,
					'col6'		=> $banner,
					'action'		=> "<span><a onclick='_btnEdit(\"$key->id\",\"$key->tipe\",\"$key->judul\")'><button type='button' class='btn bg-gradient-primary btn-sm'><i class='nav-icon fas fa-pen'></i> Ubah</button></a></span><span><a  onclick='_btnDelete(\"$key->id\",\"$key->tipe\",\"$key->judul\")'><button type='button' class='btn bg-gradient-danger btn-sm'><i class='nav-icon fas fa-trash'></i> Hapus</button></a></span>",
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
			$tipe		= $this->request->getVar('tipe');
			$judul		= $this->request->getVar('judul');
			$deskripsi	= $this->request->getVar('deskripsi');
			$thumbnail  = $this->request->getFile('thumbnail');
			$banner     = $this->request->getFile('banner');

			// Validasi thumbnail
			if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
				if (!in_array($thumbnail->getClientExtension(), ['jpg', 'jpeg', 'png']) || $thumbnail->getSize() > 2048000) {
					return $this->response->setJSON([
						'gagal' => true,
						'message' => 'File thumbnail "' . $thumbnail->getName() . '" tidak valid. Harus JPG/PNG, max 2MB.'
					]);
				}
				$thumbName = $thumbnail->getRandomName();
				$thumbnail->move('assets-admin/uploads/', $thumbName);
			} else {
				$thumbName = '400x300.png';
			}

			// Validasi banner
			if ($banner && $banner->isValid() && !$banner->hasMoved()) {
				if (!in_array($banner->getClientExtension(), ['jpg', 'jpeg', 'png']) || $banner->getSize() > 2048000) {
					return $this->response->setJSON([
						'gagal' => true,
						'message' => 'File banner "' . $banner->getName() . '" tidak valid. Harus JPG/PNG, max 2MB.'
					]);
				}
				$bannerName = $banner->getRandomName();
				$banner->move('assets-admin/uploads/', $bannerName);
			} else {
				$bannerName = '800x600.png';
			}

			$data = [
				'tipe' 			=> $tipe,
				'judul' 		=> strtoupper($judul),
				'deskripsi' 	=> strtoupper($deskripsi),
				'thumbnail' 	=> $thumbName,
				'banner' 		=> $bannerName,
				'created_user'	=> session()->get('id'),
				'created_dttm'	=> date('Y-m-d H:i:s')
			];
			$res = $this->m_berita_artikel->insertData($data);

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
			$data = (array) $this->m_berita_artikel->get_by_id($id);
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
			$tipe		= $this->request->getVar('tipe');
			$judul		= $this->request->getVar('judul');
			$deskripsi	= $this->request->getVar('deskripsi');
			$thumbnail  = $this->request->getFile('thumbnail');
			$banner     = $this->request->getFile('banner');

			// Validasi thumbnail
			if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
				if (!in_array($thumbnail->getClientExtension(), ['jpg', 'jpeg', 'png']) || $thumbnail->getSize() > 2048000) {
					return $this->response->setJSON([
						'gagal' => true,
						'message' => 'File thumbnail "' . $thumbnail->getName() . '" tidak valid. Harus JPG/PNG, max 2MB.'
					]);
				}
				$thumbName = $thumbnail->getRandomName();
				$thumbnail->move('assets-admin/uploads/', $thumbName);
			} else {
				$thumbName = '400x300.png';
			}

			// Validasi banner
			if ($banner && $banner->isValid() && !$banner->hasMoved()) {
				if (!in_array($banner->getClientExtension(), ['jpg', 'jpeg', 'png']) || $banner->getSize() > 2048000) {
					return $this->response->setJSON([
						'gagal' => true,
						'message' => 'File banner "' . $banner->getName() . '" tidak valid. Harus JPG/PNG, max 2MB.'
					]);
				}
				$bannerName = $banner->getRandomName();
				$banner->move('assets-admin/uploads/', $bannerName);
			} else {
				$bannerName = '800x600.png';
			}

			$data = [
				'tipe' 			=> $tipe,
				'judul' 		=> strtoupper($judul),
				'deskripsi' 	=> strtoupper($deskripsi),
				'thumbnail' 	=> $thumbName,
				'banner' 		=> $bannerName,
				'created_user'	=> session()->get('id'),
				'created_dttm'	=> date('Y-m-d H:i:s')
			];
			$res = $this->m_berita_artikel->updateData($id, $data);
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
			$res = $this->m_berita_artikel->softDelete($id, $data);
			if ($res) {
				echo json_encode(['sukses' => true]);
			} else {
				echo json_encode(['gagal' => true]);
			}
		}
	}
}
