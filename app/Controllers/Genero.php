<?php

namespace App\Controllers;

use App\Models\GeneroModel;

class Genero extends BaseController
{
    protected GeneroModel $generoModel;

    public function __construct()
    {
        $this->generoModel = new GeneroModel();
    }

    public function index($id = null)
    {
        return $this->actual($id);
    }

    public function actual($id = null)
    {
        if ($id !== null) {
            $genero = $this->generoModel->find((int)$id);
        } else {
            $genero = $this->generoModel->elultimo();
        }

        $currentId = $genero ? (int)$genero['idgenero'] : null;
        $posicion  = $currentId ? $this->generoModel->obtenerPosicion($currentId) : ['pos' => 0, 'total' => 0];

        $data = [
            'title'     => $genero ? 'Género: ' . esc($genero['nombre']) : 'Ficha de Género',
            'module'    => 'genero',
            'genero'      => $genero,
            'currentId' => $currentId,
            'posicion'  => $posicion,
        ];

        return view('genero/genero_record', $data);
    }

    public function elprimero()
    {
        $first = $this->generoModel->elprimero();
        return $this->actual($first ? $first['idgenero'] : null);
    }

    public function elultimo()
    {
        $last = $this->generoModel->elultimo();
        return $this->actual($last ? $last['idgenero'] : null);
    }

    public function siguiente($id)
    {
        $next = $this->generoModel->siguiente((int)$id);
        return $this->actual($next ? $next['idgenero'] : $id);
    }

    public function anterior($id)
    {
        $prev = $this->generoModel->anterior((int)$id);
        return $this->actual($prev ? $prev['idgenero'] : $id);
    }

    public function listar()
    {
        $search = $this->request->getGet('q');
        if (!empty($search)) {
            $generos = $this->generoModel->like('nombre', $search)->findAll();
        } else {
            $generos = $this->generoModel->getGenerosConConteo();
        }

        $data = [
            'title'  => 'Catálogo de Géneros',
            'module' => 'genero',
            'generos'  => $generos,
            'search' => $search,
            'total'  => count($generos),
        ];

        return view('genero/genero_list', $data);
    }

    public function add()
    {
        $data = [
            'title'  => 'Registrar Nuevo Género',
            'module' => 'genero',
            'errors' => session()->getFlashdata('errors') ?? [],
            'old'    => session()->getFlashdata('old') ?? [],
        ];

        return view('genero/genero_form', $data);
    }

    public function store()
    {
        $postData = [
            'nombre' => trim($this->request->getPost('nombre') ?? ''),
        ];

        if (!$this->generoModel->insert($postData)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->generoModel->errors())
                             ->with('old', $postData);
        }

        $nuevoId = $this->generoModel->getInsertID();

        return redirect()->to(base_url('genero/actual/' . $nuevoId))
                         ->with('success', '¡Registro de Género creado exitosamente!');
    }

    public function edit($id)
    {
        $genero = $this->generoModel->find((int)$id);
        if (!$genero) {
            return redirect()->to(base_url('genero'))->with('error', 'Registro no encontrado.');
        }

        $data = [
            'title'     => 'Editar Género: ' . esc($genero['nombre']),
            'module'    => 'genero',
            'genero'      => $genero,
            'currentId' => (int)$id,
            'errors'    => session()->getFlashdata('errors') ?? [],
        ];

        return view('genero/genero_edit', $data);
    }

    public function update($id)
    {
        $genero = $this->generoModel->find((int)$id);
        if (!$genero) {
            return redirect()->to(base_url('genero'))->with('error', 'Registro no encontrado.');
        }

        $postData = [
            'nombre' => trim($this->request->getPost('nombre') ?? ''),
        ];

        if (!$this->generoModel->update((int)$id, $postData)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->generoModel->errors());
        }

        return redirect()->to(base_url('genero/actual/' . $id))
                         ->with('success', '¡Registro de Género actualizado correctamente!');
    }

    public function delete($id)
    {
        $genero = $this->generoModel->find((int)$id);
        if (!$genero) {
            return redirect()->to(base_url('genero'))->with('error', 'Registro no encontrado.');
        }

        $this->generoModel->delete((int)$id);

        $ultimo = $this->generoModel->elultimo();
        $redirectUrl = $ultimo ? base_url('genero/actual/' . $ultimo['idgenero']) : base_url('genero');

        return redirect()->to($redirectUrl)
                         ->with('success', 'Género #' . $id . ' eliminado exitosamente.');
    }
}
