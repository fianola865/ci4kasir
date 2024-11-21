<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
           'produk_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => 'TRUE',
                'auto_increment' => 'TRUE'
           ],
           'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
           ],
           'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
           ],
           'stok' => [
                'type' => 'INT',
                'constraint' => '11'
           ],
           'gambar_produk' => [
               'type' => 'VARCHAR',
               'constraint' => '255'
           ]
        ]);
        $this->forge->addKey('produk_id', TRUE);
        $this->forge->createTable('tb_produk');
    }

    public function down()
    {
        $this->forge->dropTable('tb_produk');
    }
}

