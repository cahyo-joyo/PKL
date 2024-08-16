<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'user_id'           => [
				'type'              => 'BIGINT',
				'constraint'        => 20,
				'unsigned'          => TRUE,
				'auto_increment'    => TRUE
			],
			'user_name'         => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'user_email'         => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'user_password'         => [
				'type'              => 'VARCHAR',
				'constraint'        => '100',
			],
			'user_created_at'         => [
				'type'              => 'DATETIME',
			]
		]);
		$this->forge->addKey('user_id', TRUE);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
