<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblProduk extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel tblproduk
		$this->forge->addField([
			'idproduk'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'kodeproduk'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'namaproduk'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'default'        => 'Mercubuana',
			],
			'hargaproduk' => [
				'type'           => 'INT',
                'constraint'     => 7,
				'default'        => 0,
			],
			
		]);

		// Membuat primary key
		$this->forge->addKey('idproduk', TRUE);

		// Membuat tabel tblproduk
		$this->forge->createTable('tblproduk', TRUE);
    }

    public function down()
    {
        //Fungsi untuk mengahapus tabel
        $this->forge->dropTable(tbl_produk);
    }
}
