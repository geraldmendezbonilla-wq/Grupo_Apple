<?php

namespace App\Models;

use CodeIgniter\Model;

class SexoModel extends Model
{
    use NavigableTrait;

    protected $table            = 'sexo';
    protected $primaryKey       = 'idsexo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nombre'];

    protected $validationRules = [
<<<<<<< HEAD
        'nombre' => 'required|min_length[2]|max_length[50]|is_unique[sexo.nombre,idsexo,{idsexo}]',
=======
        'nombre' => 'required|min_length[2]|max_length[50]',
>>>>>>> a198ee1232cd59df41937398d2f3ee82a256444f
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'   => 'El nombre del sexo es obligatorio.',
            'min_length' => 'Debe contener al menos 2 caracteres.',
            'max_length' => 'No puede superar los 50 caracteres.',
<<<<<<< HEAD
            'is_unique'  => 'Ese nombre de sexo ya está registrado.',
=======
>>>>>>> a198ee1232cd59df41937398d2f3ee82a256444f
        ],
    ];

    /**
     * Obtener listado con conteo de personas asociadas
     */
    public function getSexosConConteo()
    {
        return $this->select('sexo.*, COUNT(persona.idpersona) AS total_personas')
                    ->join('persona', 'persona.idsexo = sexo.idsexo', 'left')
                    ->groupBy('sexo.idsexo')
                    ->orderBy('sexo.idsexo', 'ASC')
                    ->findAll();
    }
}
