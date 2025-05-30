<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;


class Login extends BaseController
{
	protected $m_login;
	protected $session;
	public function __construct()
	{
		$this->m_login	= new LoginModel();
		$this->session	= \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		return view('admin/login');
	}

	public function get_login()
	{
		if ($this->request->isAJAX()) {
			$username = $this->request->getVar('username');
			$password = sha1(md5($this->request->getVar('password')));
			$cek_user = $this->m_login->cek_user($username);

			if (!$cek_user) {
				$msg = ['status' => false, 'message' => 'Username tidak ditemukan.'];
			} elseif ($cek_user['status_user'] == 'deactive') {
				$msg = ['status' => false, 'message' => 'Akun Anda tidak aktif.'];
			} else {
				$cek = $this->m_login->login_check($username, $password);
				if ($cek && $cek['username'] == $username && $cek['password'] == $password) {
					session()->set([
						'id' => $cek['id'],
						'nama' => $cek['nama'],
						'jenis_kelamin' => $cek['jenis_kelamin'],
						'telepon' => $cek['telepon'],
						'username' => $cek['username'],
						'level' => $cek['level'],
						'status_user' => $cek['status_user'],
						'alamat' => $cek['alamat'],
					]);
					$msg = ['status' => true, 'message' => 'Selamat datang ' . $cek['nama']];
				} else {
					$msg = ['status' => false, 'message' => 'Username atau password salah.'];
				}
			}
			return $this->response->setJSON($msg);
		}
		exit('Request Error');
	}


	public function logout()
	{
		session()->setTempdata('id');
		session()->setTempdata('nama');
		session()->setTempdata('jenis_kelamin');
		session()->setTempdata('telepon');
		session()->setTempdata('username');
		session()->setTempdata('level');
		session()->setTempdata('status_user');
		session()->setTempdata('alamat');
		session()->setFlashdata('sukses', 'anda berhasil keluar ...');
		return redirect()->to(base_url('/admin'));
	}
}
