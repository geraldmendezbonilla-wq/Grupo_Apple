<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGeneroTable extends Migration
{
    public function up()
    {
        // Catálogo: genero
        $this->forge->addField([
            'idgenero' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => false,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('idgenero', true);
        $this->forge->createTable('genero', true);

        // Relación: persona.idgenero -> genero.idgenero
        $this->forge->addColumn('persona', [
            'idgenero' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'after'      => 'idestadocivil',
            ],
        ]);
        $this->db->query('ALTER TABLE persona ADD KEY idgenero (idgenero)');
        $this->db->query('ALTER TABLE persona ADD CONSTRAINT persona_idgenero_foreign
            FOREIGN KEY (idgenero) REFERENCES genero (idgenero) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE persona DROP FOREIGN KEY persona_idgenero_foreign');
        $this->forge->dropColumn('persona', 'idgenero');
        $this->forge->dropTable('genero', true);
    }
}
