<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BeritaArtikel extends Migration
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
			'tipe'				 => [
				'type'			 => 'ENUM',
				'constraint' 	 => ['berita', 'artikel'],
				'null'			 => false
			],
			'judul' 	 	 	 => [
				'type'       	 => 'CHAR',
				'constraint'	 => 100,
				'null'			 => false,
			],
			'deskripsi' 	 	 => [
				'type'       	 => 'TEXT',
				'null'			 => false
			],
			'thumbnail' 	 	 	 => [
				'type'       	 => 'TEXT',
				'null'			 => true,
			],
			'banner' 	 	 	 => [
				'type'       	 => 'TEXT',
				'null'			 => true,
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
		$this->forge->createTable('berita_artikel');
	}

	public function down()
	{
		$this->forge->dropTable('berita_artikel');
	}
}
