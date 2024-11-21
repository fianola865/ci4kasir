<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_pelanggan' => [
                'type' => 'INT',
                'constraint' => '20',
                'unsigned'  => TRUE,
                'auto_increment' => TRUE
            ],
            'NamaPelanggan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'Alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'NomorTlp' => [
                'type' => 'INT',
                'constraint' => '20'
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ]
            
        ]);
        $this->forge->addKey('ID_pelanggan', TRUE);
        $this->forge->createTable('Tb_Pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('Tb_Pelanggan');
    }
}
