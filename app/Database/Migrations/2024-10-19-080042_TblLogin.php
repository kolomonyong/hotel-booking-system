<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblLogin extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel tblproduk

        /* $this->forge->addField([
            'username'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 20
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 20
            ],
            

        ]); */

        $this->forge->addField([
            'username'           => [
                'type'           => 'VARCHAR',
                'constraint'     => 20
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 20
            ],
            'nama'               => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'email'              => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'no_telepon'         => [
                'type'           => 'VARCHAR',
                'constraint'     => 20
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('username', TRUE);

        // Membuat tabel tblproduk
        $this->forge->createTable('tbllogin', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tbllogin');
    }
}
