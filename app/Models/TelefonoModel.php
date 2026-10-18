<?php

namespace App\Models;

use CodeIgniter\Model;

class TelefonoModel extends Model
{
    use NavigableTrait;

    protected $table            = 'telefono';
    protected $primaryKey       = 'idtelefono';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'idpersona',
        'numero',
        'tipo',
        'operadora',
    ];

    protected $validationRules = [
        'idpersona' => 'required|is_natural_no_zero',
        'numero'    => 'required|min_length[7]|max_length[20]|regex_match[/^[0-9+\-\s()]+$/]',
        'tipo'      => 'permit_empty|max_length[50]',
        'operadora' => 'permit_empty|max_length[50]',
    ];

    protected $validationMessages = [
        'idpersona' => [
            'required'           => 'Debe seleccionar la persona a quien pertenece el teléfono.',
            'is_natural_no_zero' => 'Seleccione una persona válida.',
        ],
        'numero' => [
            'required'    => 'El número de teléfono es obligatorio.',
            'min_length'  => 'El teléfono debe tener al menos 7 caracteres.',
            'max_length'  => 'El teléfono no puede superar los 20 caracteres.',
            'regex_match' => 'El teléfono solo puede contener dígitos, espacios y los símbolos + - ( ).',
        ],
    ];

    /**
     * Listado con datos de la persona propietaria, con búsqueda y filtro por persona
     */
    public function getTelefonosWithPersona($search = null, $idpersona = null)
    {
        $builder = $this->select('telefono.*, persona.cedula, persona.nombres, persona.apellidos')
                        ->join('persona', 'persona.idpersona = telefono.idpersona', 'inner')
                        ->orderBy('telefono.idtelefono', 'DESC');

        if (!empty($idpersona)) {
            $builder->where('telefono.idpersona', (int)$idpersona);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('telefono.numero', $search)
                    ->orLike('telefono.tipo', $search)
                    ->orLike('telefono.operadora', $search)
                    ->orLike('persona.cedula', $search)
                    ->orLike('persona.nombres', $search)
                    ->orLike('persona.apellidos', $search)
                    ->groupEnd();
        }

        return $builder->findAll();
    }

    /**
     * Un teléfono por ID con los datos de su persona
     */
    public function getTelefonoDetail($id)
    {
        return $this->select('telefono.*, persona.cedula, persona.nombres, persona.apellidos')
                    ->join('persona', 'persona.idpersona = telefono.idpersona', 'inner')
                    ->where('telefono.idtelefono', (int)$id)
                    ->first();
    }

    /**
     * Todos los teléfonos de una persona
     */
    public function getTelefonosByPersona($idpersona)
    {
        return $this->where('idpersona', (int)$idpersona)
                    ->orderBy('idtelefono', 'DESC')
                    ->findAll();
    }
}
