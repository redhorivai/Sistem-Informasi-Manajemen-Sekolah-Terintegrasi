<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
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
			'id_guru' 			 => [
				'type'      	 => 'INT',
				'null'			 => false
			],
			'id_kelas' 			 => [
				'type'      	 => 'INT',
				'null'			 => false
			],
			'id_jurusan' 			 => [
				'type'      	 => 'INT',
				'null'			 => false
			],
			'nama_lengkap' 		 => [
				'type'      	 => 'VARCHAR',
				'constraint' 	 => '255',
			],
			'nis' 				 => [
				'type'      	 => 'CHAR',
				'constraint' 	 => '20',
			],
			'nik' 				 => [
				'type'      	 => 'CHAR',
				'null'			 => true
			],
			'email' 			 => [
				'type'      	 => 'CHAR',
				'constraint' 	 => '20',
			],
			'telepon' 			 => [
				'type'      	 => 'CHAR',
				'constraint' 	 => '20',
			],
			'jenis_kelamin' 	 => [
				'type'       	 => 'ENUM',
				'constraint' 	 => ['L', 'P'],
			],
			'alamat' 	 		 => [
				'type'       	 => 'TEXT',
				'null'			 => true
			],
			'waktu_masuk' 	 	 => [
				'type'       	 => 'DATE',
				'null'		 	 => true,
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
		$this->forge->createTable('siswa');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropDatabase('siswa');
	}
}
