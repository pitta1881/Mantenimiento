<?php

namespace App\Core;

abstract class Controller
{
    abstract public function __construct();

    abstract public function index();

    public function fichaOne()
    {
        $ficha['id'] = $_POST['id'];
        $miFicha = $this->model->getFichaOne(table, $ficha);    //en cada clase q implementa ésta, defino que es 'table'
        if ($miFicha) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        header("Content-Type: application/json");
        return json_encode($miFicha);
    }
    

    public function fichaAll()
    {
        $misFichas = $this->model->getFichaAll(table);          //en cada clase q implementa ésta, defino que es 'table'
        if (is_null($misFichas)) {
            http_response_code(404);
        } else {
            http_response_code(200);
        }
        header("Content-Type: application/json");
        return json_encode($misFichas);
    }
}
