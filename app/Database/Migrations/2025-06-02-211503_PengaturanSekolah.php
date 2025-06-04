<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengaturanSekolah extends Migration
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
			'nama_sekolah' 	 	 => [
				'type'       	 => 'CHAR',
				'constraint'	 => 100,
				'null'			 => false,
			],
			'telepon_sekolah' 	 		 => [
				'type'       	 => 'CHAR',
				'constraint'	 => 100,
				'null'			 => false,
			],
			'email_sekolah' 	 => [
				'type'       	 => 'CHAR',
				'constraint'	 => 100,
				'null'			 => false,
			],
			'link_facebook' 	 => [
				'type'       	 => 'CHAR',
				'constraint'	 => 100,
				'null'			 => true,
			],
			'link_youtube' 	 => [
				'type'       	 => 'CHAR',
				'constraint'	 => 100,
				'null'			 => true,
			],
			'link_instagram' 	 => [
				'type'       	 => 'CHAR',
				'constraint'	 => 100,
				'null'			 => true,
			],
			'deskripsi_sekolah'  => [
				'type'       	 => 'TEXT',
				'null'			 => false
			],
			'alamat_sekolah' 	 => [
				'type'       	 => 'TEXT',
				'null'			 => false
			],
			'file_icon' 	 	 => [
				'type'       	 => 'TEXT',
				'null'			 => true,
			],
			'file_logo' 	 	 => [
				'type'       	 => 'TEXT',
				'null'			 => true,
			],
			'file_slider' 	 	 => [
				'type'       	 => 'TEXT',
				'null'			 => true,
			],
			'deskripsi_footer' 	 => [
				'type'       	 => 'VARCHAR',
				'constraint'	 => 255,
				'null'			 => false,
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
		$this->forge->createTable('pengaturan_sekolah');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pengaturan_sekolah');
	}
}
