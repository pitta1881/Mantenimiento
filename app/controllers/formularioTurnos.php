<?php

$title = 'Formulario';
// $main_title = "Solicitud de turno";
$main_title = "Complete el siguiente formulario para solicitar un turno:";
$dir_subida = "uploads/";

$date_now = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
//El nombre se compone de la fecha y el nombre original separado por un guion bajo
$fichero_subido = "";
if (!empty($_FILES['pic']['name'])) {
    $fichero_subido = $dir_subida . $date_now->format('Y-m-d-H-i-s') . '_' . basename($_FILES['pic']['name']);
}

//No puedo acceder a estas variables desde dentro de una funcion
//$horarios = array("07:00","08:00");
//$haircolors = array("negro","castanio","rubio","pelirrojo","canoso","blanco");

/** Devuelve una arreglo con los colores de cabello */
function getHairColors()
{
    return array("negro", "castanio", "rubio", "pelirrojo", "canoso", "blanco");
}

/**  Devuelve un arreglo con los turnos generados */
function getTurnos()
{
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


// define variables and set to empty values
$name = $email = $phone = $age = $calzado = "";
$parametros = array(); //Finalmente no los use porque muestro el "key" pero esta en ingles
$invalidos = array();
$requeridos = array('name', 'email', 'phone', 'birth', 'adate', 'atime');
$incompletos = array();
$error = "";

function sanear($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/** Valida una entrada de un formulario.
 * Retorna true si $value cumple los criterios para esa $key establecida
 * https://www.w3schools.com/php/php_form_url_email.asp */
function esValido($key, $value, &$errorDescription)
{
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
            $horarios = getTurnos();
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
            if (!in_array($value, getHairColors())) {
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

function getIdNuevoRegistro($bdd,$booleanTurno)
{
    if($booleanTurno == false){
        return 1;
    } else {
        $ultimoTurno = end($bdd["turnos"]);
        return $ultimoTurno["numeroTurno"]+1;
    }
}

/**
 * Funcion que guarda un nuevo turno
 *
 * Esta funcion podria ser refactorizada completamente, porque tiene
 * muchas responsabilidades:
 *
 *  - Carga la base de datos
 *  - Incluso si no existe la crea
 *  - Establece el formato de la base
 *  - Almacena el nuevo turno
 *  - Guarda la base de datos
 *
 * Ademas esto aca rompe la vista de turnos (/verTurnos).
 *
 */
function guardarDatos($datosForm, $rutaFichero)
{
    global $app;

    $archivo = $app->config->database_path ;
    if (!file_exists($archivo)) {
        $nTurnoB = false;
        $database_handler = fopen($archivo, 'w');
        $database = [
            "turnos" => [],
            "opciones" => []
        ];
    } else {
        $nTurnoB = true;
        $database_handler = fopen($archivo, 'r');
        $database = json_decode(fread($database_handler, filesize($archivo)), true);
    }
    fclose($database_handler);

    $datosForm["numeroTurno"] = getIdNuevoRegistro($database,$nTurnoB);
    $datosForm["imagen"] = $rutaFichero;

    $database["turnos"][] = $datosForm;

    $database_handler = fopen($archivo, 'w');
    fwrite($database_handler, json_encode($database));
    fclose($database_handler);
}

//Modifico esto para que funcione tanto con GET como con POST.
$reqMethod = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reqMethod = $_POST;
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $reqMethod = $_GET;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" || ($_SERVER["REQUEST_METHOD"] == "GET" && count($_GET) > 0)) {
    foreach ($reqMethod as $key => $value) {
        //Es mejor !empty($reqMethod[$key]) que isset($reqMethod[$key])
        if (isset($reqMethod[$key])) {
            $parametros[$key] = sanear($value);
            $errorDesc = ''; //Descripcion del error
            if (!esValido($key, $parametros[$key], $errorDesc)) {
                $invalidos[$key] = $key . " invalido. " . $errorDesc;
            }
        } else if (in_array($key, $requeridos)) {
            $incompletos[$key] = "Es obligatorio completar " . $key;
        }
    }
    if (empty($invalidos) && empty($incompletos)) {
        // https://stackoverflow.com/questions/768431/how-do-i-make-a-redirect-in-php

        //No puedo hacer el redirect porque se borran los datos en el POST. por eso hago un require
        //header('Location: /formularios/turno/submit');
        //Utilizo las siguientes variables en 1_Submitted.view.php
        $fecha = DateTime::createFromFormat("Y-m-d", $parametros['adate']);
        $fecha = $fecha->format("d-m-Y");
        $hora = $parametros['atime'];
        move_uploaded_file($_FILES['pic']['tmp_name'], $fichero_subido);
        guardarDatos($parametros, $fichero_subido);
        require 'views/1_submitted.view.php';
        die(); //o exit(); //Esto debe ir si o si por razones de seguridad.
    } else {
        //Muestro los errores. empty("") -->true.   isset($myVar = "") -->true
        $error = "Error!";
        // $error = (isset($invalidos) ? $error . " Hay campos inválidos." : "");
        $error = (!empty($invalidos) ? $error . " " . implode(", ", $invalidos) : $error);
        // $error = (isset($incompletos) ? $error . " Hay campos incompletos." : "");
        $error = (!empty($incompletos) ? $error . " " . implode(", ", $incompletos) : $error);
    }
}

//TODO: Falta hacer que los campos no pierdan sus valores. *No requerido*

//Aca evaluo de donde provino la solicitud y en base a eso decido que vista cargo.
if ($_SERVER['REQUEST_URI'] == '/formularios/turnoMedianteGET') {
    //Este es el mismo formulario pero el metodo de envio es GET
    require 'views/3_form.view.php';
} else {
    require 'views/1_form.view.php';
}
