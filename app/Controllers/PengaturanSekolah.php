<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaturanSekolahModel;


class PengaturanSekolah extends BaseController
{
	protected $m_pengaturan_sekolah;
	protected $session;

	public function __construct()
	{
		$this->m_pengaturan_sekolah = new PengaturanSekolahModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/admin'));
		}
		$data = ['title' => 'data pengaturan sekolah', 'active' => 'pengaturansekolah', 'pengaturan' => $this->m_pengaturan_sekolah->asObject()->findAll(),];
		return view('admin/pengaturansekolah/index', $data);
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');

			// Ambil data lama dari database
			$oldData = $this->m_pengaturan_sekolah->find($id);
			if (!$oldData) {
				return $this->response->setJSON([
					'gagal' => true,
					'message' => 'Data tidak ditemukan.'
				]);
			}

			// Ambil input dari form
			$nama_sekolah      = $this->request->getVar('nama_sekolah');
			$telepon_sekolah   = $this->request->getVar('telepon_sekolah');
			$email_sekolah     = $this->request->getVar('email_sekolah');
			$link_facebook     = $this->request->getVar('link_facebook');
			$link_youtube      = $this->request->getVar('link_youtube');
			$link_instagram    = $this->request->getVar('link_instagram');
			$deskripsi_sekolah = $this->request->getVar('deskripsi_sekolah');
			$alamat_sekolah    = $this->request->getVar('alamat_sekolah');
			$deskripsi_footer  = $this->request->getVar('deskripsi_footer');

			// File upload
			$file_icon   = $this->request->getFile('file_icon');
			$file_logo   = $this->request->getFile('file_logo');
			$file_slider = $this->request->getFile('file_slider');

			// Fungsi validasi dan upload file
			$uploadFile = function ($file, $oldFileName) {
				if ($file && $file->isValid() && !$file->hasMoved()) {
					$ext = strtolower($file->getClientExtension());
					if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
						return ['error' => 'File harus berupa gambar JPG/PNG.'];
					}
					if ($file->getSize() > 2 * 1024 * 1024) { // 2MB
						return ['error' => 'Ukuran file maksimal 2MB.'];
					}
					$newName = $file->getRandomName();
					$file->move('assets-admin/uploads/', $newName);
					// Optional: Hapus file lama jika perlu
					if ($oldFileName && file_exists('assets-admin/uploads/' . $oldFileName)) {
						@unlink('assets-admin/uploads/' . $oldFileName);
					}
					return ['name' => $newName];
				}
				// Jika tidak upload file baru, pakai file lama
				return ['name' => $oldFileName];
			};

			// Proses upload file icon
			$resIcon = $uploadFile($file_icon, $oldData['file_icon']);
			if (isset($resIcon['error'])) {
				return $this->response->setJSON(['gagal' => true, 'message' => $resIcon['error']]);
			}
			// Proses upload file logo
			$resLogo = $uploadFile($file_logo, $oldData['file_logo']);
			if (isset($resLogo['error'])) {
				return $this->response->setJSON(['gagal' => true, 'message' => $resLogo['error']]);
			}
			// Proses upload file slider
			$resSlider = $uploadFile($file_slider, $oldData['file_slider']);
			if (isset($resSlider['error'])) {
				return $this->response->setJSON(['gagal' => true, 'message' => $resSlider['error']]);
			}

			// Data untuk update
			$data = [
				'nama_sekolah'     => $nama_sekolah,
				'telepon_sekolah'  => $telepon_sekolah,
				'email_sekolah'    => $email_sekolah,
				'link_facebook'    => $link_facebook,
				'link_youtube'     => $link_youtube,
				'link_instagram'   => $link_instagram,
				'deskripsi_sekolah' => strtoupper($deskripsi_sekolah),
				'alamat_sekolah'   => strtoupper($alamat_sekolah),
				'file_icon'        => $resIcon['name'],
				'file_logo'        => $resLogo['name'],
				'file_slider'      => $resSlider['name'],
				'deskripsi_footer' => $deskripsi_footer,
				'created_user'     => session()->get('id'),
				'created_dttm'     => date('Y-m-d H:i:s')
			];

			// Update data ke database
			$res = $this->m_pengaturan_sekolah->updateData($id, $data);

			if ($res) {
				echo json_encode([
					'sukses' => true,
					'file_icon' => $resIcon['name'] ?? null,
					'file_logo' => $resLogo['name'] ?? null,
					'file_slider' => $resSlider['name'] ?? null,
				]);
			} else {
				echo json_encode(['gagal' => true]);
			}
		}
	}
}
