<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTelefonoTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idtelefono' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => false,
                'auto_increment' => true,
            ],
            'idpersona' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'numero' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            'tipo' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Móvil',
                'null'       => true,
            ],
            'operadora' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('idtelefono', true);
        $this->forge->addKey('idpersona');
        $this->forge->addForeignKey('idpersona', 'persona', 'idpersona', 'CASCADE', 'CASCADE');
        $this->forge->createTable('telefono', true);
    }

    public function down()
    {
        $this->forge->dropTable('telefono', true);
    }
}
