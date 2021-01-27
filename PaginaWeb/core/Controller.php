<?php

namespace App\Core;

abstract class Controller
{
    abstract public function __construct();

    abstract public function index();

    public function fichaOne()
    {
        $ficha['id'] = $_POST['id'];
        $miFicha = $this->model->getFichaOne(table, $ficha);
        if ($miFicha) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        header("Content-Type: application/json");
        echo json_encode($miFicha);
    }
    

    public function fichaAll()
    {
        $misFichas = $this->model->getFichaAll(table);
        if ($misFichas) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        header("Content-Type: application/json");
        echo json_encode($misFichas);
    }
}
