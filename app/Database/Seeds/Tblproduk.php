<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Tblproduk extends Seeder
{
    public function run()
    {
        //

    // membuat data
		$news_data = [
			[
				'kodeproduk' => '12345',
				'namaproduk'  => 'Buku codeigniter-intro versi 4',
				'hargaproduk' => '50000'
			],
			[
				'kodeproduk' => '12346',
				'namaproduk'  => 'Buku Android Programming - Flutter - Dart',
				'hargaproduk' => '70000'
			],
			[
				'kodeproduk' => '12347',
				'namaproduk'  => 'Buku Pengolahan Citra - Matlab',
				'hargaproduk' => '60000'
			]
		];

		foreach($news_data as $data){
			// insert semua data ke tabel
			$this->db->table('tblproduk')->insert($data);
		}
    }
}
