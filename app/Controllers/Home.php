<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengunjungModel;
use App\Models\ProvinsiModel;
use App\Models\UnitkerjaModel;
use App\Libraries\Date\DateFunction;


class Home extends BaseController
{
	// protected $m_pengunjung;
	// protected $m_provinsi;
	// protected $m_unitkerja;

	// public function __construct()
	// {
	// 	$this->m_pengunjung = new PengunjungModel();
	// 	$this->m_provinsi = new ProvinsiModel();
	// 	$this->m_unitkerja = new UnitkerjaModel();
	// 	$this->date = new DateFunction();
	// }
	// public function index()
	// {

	// 	$res 	= $this->m_provinsi->getProvinsi();
	// 	$res1 	= $this->m_unitkerja->getUnitkerja();
	// 	// dd($res);
	// 	$data = [
	// 		'title' => 'data formulir',
	// 		'active' => 'kunjungan',
	// 		'res' => $res,
	// 		'res1' => $res1
	// 	];

	// 	return view('formulir/form', $data);
	// }

	// public function insert_data()
	// {

	// 	if ($this->request->isAJAX()) {
	// 		$nama_pemohon			= strtoupper($this->request->getPost('nama_pemohon'));
	// 		$nama_instansi			= strtoupper($this->request->getPost('nama_instansi'));
	// 		$telepon_pemohon		= $this->request->getPost('telepon_pemohon');
	// 		$email					= $this->request->getPost('email');
	// 		$id_provinsi			= $this->request->getPost('id_provinsi');
	// 		$id_kota				= $this->request->getPost('id_kota');
	// 		$alamat					= strtoupper($this->request->getPost('alamat'));
	// 		$id_unit				= $this->request->getPost('id_unit');
	// 		$tgl_kunjungan			= $this->request->getPost('tgl_kunjungan');
	// 		$topik					= $this->request->getPost('topik');
	// 		$jumlah_peserta			= $this->request->getPost('jumlah_peserta');
	// 		$pimpinan_pengunjung	= $this->request->getPost('pimpinan_pengunjung');
	// 		$keterangan				= strtolower($this->request->getPost('keterangan'));
	// 		$no_surat				= $this->request->getPost('no_surat');
	// 		$surat_kepada			= strtoupper($this->request->getPost('surat_kepada'));

	// 		$file 					= $this->request->getFile('file_surat');
	// 		$path_file = $file->getRandomName();
    //         $file->move('uploads', $path_file);

	// 		$data = [
	// 			'nama_pemohon'		=> $nama_pemohon,
	// 			'nama_instansi'		=> $nama_instansi,
	// 			'telepon_pemohon'	=> $telepon_pemohon,
	// 			'email'				=> $email,
	// 			'id_provinsi'		=> $id_provinsi,
	// 			'id_kota'			=> $id_kota,
	// 			'alamat'			=> $alamat,
	// 			'id_unit'			=> $id_unit,
	// 			'tgl_kunjungan'		=> $tgl_kunjungan,
	// 			'topik'				=> $topik,
	// 			'jumlah_peserta'	=> $jumlah_peserta,
	// 			'pimpinan_pengunjung' => $pimpinan_pengunjung,
	// 			'keterangan'		=> $keterangan,
	// 			'no_surat'			=> $no_surat,
	// 			'surat_kepada' 		=> $surat_kepada,
	// 			'file_surat'		=> $path_file,
	// 			'status'			=> 'proses',
	// 			'created_dttm'		=> date('Y-m-d H:i:s'),
	// 		];
	// 		$this->m_pengunjung->insertData($data);
	// 		$msg = ["sukses" => "Pendaftaran Kunjungan Berhasil .."];
	// 	} else {
	// 		exit('Request Error');
	// 	}
	// 	echo json_encode($msg);
	// }

	// public function status()
	// {
	// 	// dd($res);
	// 	$data = [
	// 		'title' => 'data status',
	// 		'active' => 'status',
	// 	];

	// 	return view('formulir/status', $data);
	// }

	// public function getData()
	// {
	// 	$res 	= $this->m_pengunjung->getPengunjung();
	// 	// print_r(json_encode($res));
	// 	if (count($res) > 0) {
	// 		foreach ($res as $data) {
	// 			if ($data->status == "proses") {
	// 				$status_pengajuan =	"<button type='button' class='btn btn-block btn-outline-info btn-sm'>Proses</button>";
	// 			} elseif ($data->status == "diterima") {
	// 				$status_pengajuan =	"<button type='button' class='btn btn-block btn-outline-success btn-sm'>Disetujui</button>";
	// 			} else {
	// 				$status_pengajuan =	"<button type='button' class='btn btn-block btn-outline-danger btn-sm'>Ditolak</button>";
	// 			}
	// 			if ($data->pesan_status == "") {
	// 				$pesan		= "-";
	// 			} else {
	// 				$pesan		= "$data->pesan_status";
	// 			}
	// 			$tglKunjungan		= $this->date->panjang($data->tgl_kunjungan);
	// 			$output[] = array(
	// 				'col1'				=> $data->nama_pemohon,
	// 				'col2'				=> "$data->nama_instansi",
	// 				'col3'				=> "$data->tgl_kunjungan",
	// 				'col4'				=> "$data->nama_unit",
	// 				'col5'				=> "$data->topik",
	// 				'col6'				=> "$status_pengajuan",
	// 				'col7'				=> "$pesan",
	// 			);
	// 			$ret = array('data' => $output);
	// 		}
	// 	} else {
	// 		$ret = array('data' => []);
	// 	}
	// 	return $this->response->setJSON($ret);
	// 	print_r($ret);
	// }
}
