<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelulusan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 8,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_jurusan' 	 	 => [
				'type'       	 => 'INT',
				'null'		 	 => false
			],
			'id_kelas' 	 	 	 => [
				'type'       	 => 'INT',
				'null'		 	 => false
			],
			'id_akademik' 	 	 => [
				'type'       	 => 'INT',
				'null'		 	 => false
			],
			'id_guru' 	 	 	 => [
				'type'       	 => 'INT',
				'null'		 	 => false
			],
			'id_siswa' 	 	 	 => [
				'type'       	 => 'INT',
				'null'		 	 => false
			],
			'status_kelulusan' 	 => [
				'type'       	 => 'ENUM',
				'constraint' 	 => ['lulus', 'belum_lulus'],
				'null'			 => false
			],
			'keterangan' 	 	 => [
				'type'       	 => 'TEXT',
				'null'			 => true
			],
			'waktu_pengumuman' 	 => [
				'type'       	 => 'DATETIME',
				'null'		 	 => false,
			],
			'status_cd' 	 	 => [
				'type'       	 => 'ENUM',
				'constraint' 	 => ['normal', 'nullified'],
				'default'	 	 => 'normal',
			],
			'created_user'	 	 => [
				'type'       	 => 'INT',
				'constraint' 	 => 8,
				'null'		 	 => true,
			],
			'created_dttm' 	 	 => [
				'type'       	 => 'DATETIME',
				'null'		 	 => true,

			],
			'updated_user'	 	 => [
				'type'       	 => 'INT',
				'constraint' 	 => 8,
				'null'		 	 => true,
			],
			'updated_dttm' 	 	 => [
				'type'       	 => 'DATETIME',
				'null'		 	 => true,
			],
			'nullified_user' 	 => [
				'type'       	 => 'INT',
				'constraint' 	 => 8,
				'null'		 	 => true,
			],
			'nullified_dttm'	 => [
				'type'        	 => 'DATETIME',
				'null'		 	 => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('kelulusan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kelulusan');
	}
}
