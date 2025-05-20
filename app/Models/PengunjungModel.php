<?php

namespace App\Models;

use CodeIgniter\Model;

class PengunjungModel extends Model
{
	protected $table      = 'pengunjung';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'id_unit', 'id_provinsi', 'id_kota', 'nama_pemohon', 'nama_instansi', 'telepon_pemohon', 'email', 'alamat', 'tgl_kunjungan', 'topik', 'jumlah_peserta', 'pimpinan_pengunjung', 'keterangan', 'no_surat', 'file_surat', 'status', 'pesan_status', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getPengunjung()
	{
		$query = $this->db->table('pengunjung a');
		$query->select('a.id,a.id_provinsi,a.id_kota,a.nama_pemohon,a.nama_instansi,a.telepon_pemohon,a.telepon_pemohon,a.email,a.email,a.alamat,a.tgl_kunjungan,a.topik,a.jumlah_peserta,a.pimpinan_pengunjung,a.keterangan,a.no_surat,a.file_surat,a.status,a.pesan_status,a.created_dttm,
		b.nama_unit,b.alamat,
		c.kodeprovinsi,c.nama_provinsi,
		d.nama_kota
		');
		$query->join('unit_kerja b', 'b.id=a.id_unit');
		$query->join('provinsi c', 'c.id_provinsi=a.id_provinsi');
		$query->join('kota d', 'd.id_kota=a.id_kota');
		$query->where('a.status_cd', 'normal');
		$query->orderBy('a.id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function getLaporanPengunjung()
	{
		$query = $this->db->table('pengunjung a');
		$query->select('a.id,a.nama_pemohon,a.nama_instansi,a.telepon_pemohon,a.telepon_pemohon,a.email,a.email,a.alamat,a.tgl_kunjungan,a.topik,a.jumlah_peserta,a.pimpinan_pengunjung,a.keterangan,a.no_surat,a.file_surat,a.status,a.pesan_status,a.created_dttm,
		b.nama_unit,b.alamat,
		c.kodeprovinsi,c.nama_provinsi,
		d.nama_kota
		');
		$query->join('unit_kerja b', 'b.id=a.id_unit');
		$query->join('provinsi c', 'c.id_provinsi=a.id_provinsi');
		$query->join('kota d', 'd.id_kota=a.id_kota');
		$query->where('a.status_cd', 'normal');
		$query->where('a.status', 'diterima');
		$query->orderBy('a.id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function konfirData($id, $data)
	{
		$query = $this->db->table('pengunjung');
		$query->where('id', $id);
		$query->set($data);
		$ret = $query->update();
		return $ret;
	}

	public function get_id($id)
	{
		$query = $this->db->table('pengunjung');
		$query->select('*');
		$query->where('id', $id);
		$query->where('status_cd', 'normal');
		return $query->get();
	}

	public function deleteSoft($id, $data)
	{
		$query = $this->db->table('pengunjung');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}

	public function get_proses()
	{
		$query	= $this->db->table('pengunjung');
		$query->selectCount('id');
		$query->where('status', 'proses');
		$query->where('status_cd', 'normal');
		return $query->countAllResults();
	}
	public function get_diterima()
	{
		$query	= $this->db->table('pengunjung');
		$query->selectCount('id');
		$query->where('status', 'diterima');
		$query->where('status_cd', 'normal');
		return $query->countAllResults();
	}
	public function get_ditolak()
	{
		$query	= $this->db->table('pengunjung');
		$query->selectCount('id');
		$query->where('status', 'ditolak');
		$query->where('status_cd', 'normal');
		return $query->countAllResults();
	}
	public function insertData($data)
	{
		$query = $this->db->table('pengunjung');
		$ret =  $query->insert($data);

		return $ret;
	}
}
