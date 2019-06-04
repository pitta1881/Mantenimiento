<?php

namespace App\Models;

use App\Core\Model;
use DateTime;
use DateTimeZone;

class TurnosFormulario extends Model
{
    protected $table = 'turnos';
    protected $invalidos = array();
    protected $requeridos = array('name', 'email', 'phone', 'birth', 'adate', 'atime');
    protected $incompletos = array();
    protected $error = "";
    
    public function getHairColors() {
        return array("negro", "castanio", "rubio", "pelirrojo", "canoso", "blanco");
    }

    public function getTurnos(){
        $horarios = array();
        $hora_inicial = "08:00";
    
        // $datetime = DateTime::createFromFormat('g:i:s', $hora_inicial); //Formato de 12 horas
        $datetime = DateTime::createFromFormat('H:i', $hora_inicial); //Formato de 24 horas con zeros al inicio
    
        //Horas. 7:00 + 10 = 17hs
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 4; $j++) {
                array_push($horarios, $datetime->format('H:i'));
                $datetime->modify('+15 minutes'); //Si lo pongo antes, arranca 07:15
            }
        }
        array_push($horarios, $datetime->format('H:i')); //agrego el ultimo (17:00)
        return $horarios;
    }

    public function sanear($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function esValido($key, $value, &$errorDescription) {
    $errorDescription = "";
        switch ($key) {
            case 'name':
                if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
                    $errorDescription = "Solo se admiten letras y espacios.";
                    return false;
                }
                return true;
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errorDescription = "Formato inválido.";
                    return false;
                }
                return true;
                break;

            case 'phone':
                if (!preg_match("/^\+?(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $value)) {
                    $errorDescription = "Formato inválido.";
                    return false;
                }
                return true;
                break;

                /** https://stackoverflow.com/questions/13194322/php-regex-to-check-date-is-in-yyyy-mm-dd-format */
            case "birth":
             $dt = DateTime::createFromFormat("Y-m-d", $value);
                if ($dt == false || array_sum($dt::getLastErrors())) {
                    $errorDescription = "La fecha debe ser real.";
                    return false;
                }
                
                return true;
                break;

            case "adate":
                $dt = DateTime::createFromFormat("Y-m-d", $value);
                // new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires')))->format("Y-m-d-H:i:s")
                $date_now = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
                if ($dt == false || $dt <= $date_now ||  array_sum($dt::getLastErrors())) {
                    $errorDescription = "La fecha debe ser real y no haber llegado.";
                    return false;
                }
                
                return true;
                break;

            case "atime":
                $horarios = $this->getTurnos();
                if (!in_array($value, $horarios)) {
                    $errorDescription = "Turno no disponible.";
                    return false;
                }
                return true;
                break;

                //No requeridos
            case "age":
                if (0 > $value || 150 < $value) {
                    return false;
                }
                return true;
                break;

            case "calzado":
                if (!empty($value) && (20 > $value or 45 < $value)) {
                    return false;
                }
                return true;
                break;

            case "height":
                if (1 > $value || 300 < $value) {
                    return false;
                }
                return true;
                break;

            case "haircolor":
                //No puedo usar la variable global $haircolors dentro de una funcion.
                if (!in_array($value, $this->getHairColors())) {
                    return false;
                }
                return true;
                break;

            case "pic":
                //No se como validar esto
                return true;
                break;

            default:
                return false;
        }
    }

    public function validarDatos($datos){
        $reqMethod = $datos;
        foreach ($reqMethod as $key => $value) {
        //Es mejor !empty($reqMethod[$key]) que isset($reqMethod[$key])
            if (isset($reqMethod[$key])) {
                $parametros[$key] = $this->sanear($value);
                $errorDesc = ''; //Descripcion del error
                if (!$this->esValido($key, $parametros[$key], $errorDesc)) {
                    $invalidos[$key] = $key . " invalido. " . $errorDesc;
                }
            } else if (in_array($key, $requeridos)) {
                $incompletos[$key] = "Es obligatorio completar " . $key;
            }
        }
            if (empty($invalidos) && empty($incompletos)) {
                return true;
                die(); //o exit(); //Esto debe ir si o si por razones de seguridad.
            } else {
                //Muestro los errores. empty("") -->true.   isset($myVar = "") -->true
                $error = "Error!";
                // $error = (isset($invalidos) ? $error . " Hay campos inválidos." : "");
                $error = (!empty($invalidos) ? $error . " " . implode(", ", $invalidos) : $error);
                // $error = (isset($incompletos) ? $error . " Hay campos incompletos." : "");
                $error = (!empty($incompletos) ? $error . " " . implode(", ", $incompletos) : $error);
                return false;
            }
    }

    public function get()
    {
        return $this->db->selectAll($this->table);
    }

    public function getByNumeroTurno($numero)
    {
        return $this->db->selectNumeroTurno($this->table,$numero);
    }

    public function insert(array $turnosFormulario)
    {
        $this->db->insert($this->table, $turnosFormulario);
    }

    
}
