<?php

namespace App\Core;

abstract class Controller
{
    abstract public function __construct();

    abstract public function index();

    public function fichaOne()
    {
        foreach ($_POST as $key => $value) {
            $ficha[$key] = $value;
        }
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
        $start = null;
        $end = null;
        if (isset($_POST['start']) && !is_null($_POST['start']) && $_POST['start'] != 'null') {
            $start = $_POST['start'];
        }
        if (isset($_POST['end']) && !is_null($_POST['end']) && $_POST['end'] != 'null') {
            $end = $_POST['end'];
        }
        $misFichas = $this->model->getFichaAll(table, $start, $end);          //en cada clase q implementa ésta, defino que es 'table'
        if (is_null($misFichas)) {
            http_response_code(404);
        } else {
            http_response_code(200);
        }
        header("Content-Type: application/json");
        return json_encode($misFichas);
    }
}
