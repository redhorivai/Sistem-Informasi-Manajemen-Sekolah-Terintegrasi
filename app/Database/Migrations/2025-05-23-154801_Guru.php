<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
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
			'nama_lengkap' 		 => [
				'type'      	 => 'VARCHAR',
				'constraint' 	 => '255',
			],
			'gelar_belakang'	 => [
				'type'      	 => 'VARCHAR',
				'constraint' 	 => '255',
			],
			'nik' 			 	 => [
				'type'      	 => 'CHAR',
				'constraint' 	 => '20',
			],
			'nip' 				 => [
				'type'      	 => 'CHAR',
				'constraint' 	 => '20',
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
			'status' 	 	 	 => [
				'type'       	 => 'ENUM',
				'constraint' 	 => ['asn', 'non_pnsd', 'honor'],
			],
			'jabatan' 	 	 	 => [
				'type'       	 => 'ENUM',
				'constraint' 	 => ['wali_kelas', 'guru_matapelajaran'],
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
		$this->forge->createTable('guru');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('guru');
	}
}
