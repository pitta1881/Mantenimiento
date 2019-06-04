<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\TurnosFormulario;

class FormularioController extends Controller
{
    public function __construct()
    {
        $this->model = new TurnosFormulario();
    }

    /**
     * Show all turnos
     */
    public function index()
    {
        $turnos = $this->model->get();
        return view('verTurnos', compact('turnos'));
    }

    public function ficha()
    {
        $turno = $this->model->getByNumeroTurno($_GET['numeroTurno']);
        $miTurno = $turno[0];        
        return view('verFicha', compact('miTurno'));
    }

    public function create()
    {
        $hairColors = $this->model->getHairColors();
        $horaTurnos = $this->model->getTurnos();
        $datos["colorPelo"] = $hairColors;
        $datos["horaTurnos"] = $horaTurnos;
        return view('formulario.create',compact('datos'));
    }

    public function validar(){
       $estaBien = $this->model->validarDatos($_POST);
       if ($estaBien) {
           $arrayTurno = $this->save();
           return view('verFormularioEnviado',compact('arrayTurno'));
       } else {
           echo "<h2>Algo salio Mal</h2>";
       }
       
    }

    public function save()
    {
        $turno = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'age' => $_POST['age'],
            'calzado' => $_POST['calzado'],
            'height' => $_POST['height'],
            'birth' => $_POST['birth'],
            'haircolor' => $_POST['haircolor'],
            'adate' => $_POST['adate'],
            'atime' => $_POST['atime']
        ];
        $this->model->insert($turno);
        return $turno;
    }
}
