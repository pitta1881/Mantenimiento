<?php

/*namespace App\Controllers;

use App\Core\Controller;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->model = new Pedido();
    }

    /*Show all pedidos
    public function index()
    {
        $todosPedidos = $this->model->get();
        return view('verTodosPedidos', compact('todosPedidos'));
    }

    /*muestra un solo pedido especifico ingresado por GET
    public function ficha()
    {
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $miPedido = $unPedido[0];        //hago esto xq nose como es q toma que necesito solo el 1er elemento del array
        $tareas = $this->model->getTareasByIdPedido($_GET['id']); //todavia no está esto
        $datosPedidoTareas["miPedido"] = $miPedido;        
        $datosPedidoTareas["tareas"] = $tareas;
        return view('verUnPedido', compact('datosPedidoTareas'));
    }

    public function create()
    {
       // $hairColors = $this->model->getHairColors();
       // $datos["colorPelo"] = $hairColors;

       //aca voy a hardcodear Sectores y Prioridad como para ver como quedaria
       //al dia de ultima lo podria dejar asi, hay q ver como lo guarda en la bdd
       $arrayDatos["diaHoy"] = date("Y-m-d");
       $arrayDatos["sectores"] = $this->model->getSectores();
       $arrayDatos["prioridades"] = $this->model->getPrioridades();
       $arrayDatos["estados"] = $this->model->getEstados();
       return view('crearPedido',compact('arrayDatos'));
    }

    public function validar(){
      
       //ACA SE PODRIA VALIDAR ALGO MAS ADELANTE
       //
       $estaBien = $this->model->validarDatos($_POST);
       if ($estaBien) {
           $arrayTurno = $this->save();
           return view('verFormularioEnviado',compact('arrayTurno'));
       } else {
           echo "<h2>Algo salio Mal</h2>";
       }       
       
      $arrayPedido = $this->save();
      return view('verPedidoCreado',compact('arrayPedido'));
    }

    public function save()
    {
        $pedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'sector' => preg_replace('/\s+/', '_', $_POST['estado']),
            'descripcion' => $_POST['descripcion'],
            'sector' => preg_replace('/\s+/', '_', $_POST['sector']),
            'prioridad' => $_POST['prioridad']
        ];
        $this->model->insert($pedido);
        return $pedido;
    }

    public function modificarPedidoListado(){
        $todosPedidos = $this->model->get();
        return view('verTodosPedidosParaModificar', compact('todosPedidos'));
    }

    public function modificarPedidoSeleccionado(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $miPedido = $unPedido[0]; 
        $arrayDatos["sectores"] = $this->model->getSectores();
        $arrayDatos["prioridades"] = $this->model->getPrioridades();
        $arrayDatos["estados"] = $this->model->getEstados();
        $arrayDatos["miPedido"] = $miPedido;
        return view('modificarPedido',compact('arrayDatos'));
    }

}*/
<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Roles;
use App\Models\Permisos;

class PedidoController extends Controller{

    public function __construct(){
        $this->model = new Roles();
        session_start();
    }

    /*Show all pedidos*/
    public function index(){
        if(isset($_GET["page"])){
            $pagina=$_GET["page"];
        }else{
            $pagina=1;
        }
        $todosRoles = $this->model->getPaginacion($pagina); 
        $datos['todosRoles'] = $todosRoles;
        $totalPaginas=$this->model->getsize();
        $datos["totalPaginas"] =   $totalPaginas;
        $datos["permisos"] = $this->model->getPermisos();

        $datos["userLogueado"] = $_SESSION['user'];
        return view('/rol/administracionRol', compact('datos'));
    }

    /*muestra un solo pedido especifico ingresado por GET*/
    public function ficha(){
        $miPedido = $this->model->getByIdPedido($_GET['id']);
        $datos["miROL"] = $miPedido;  
        $datos["permisos"] = $this->model->getPermisos();
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidoVerFicha', compact('datos'));
    }

    public function guardar(){
        $pedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'prioridad' => $_POST['prioridad'],
            'nombreUsuario' => $_POST['nombreUsuario']
        ];
      $this->model->insert($pedido);
      if(!empty($_POST['idEvento'])){
        var_dump($_POST['idEvento']);  
        $this->model->eliminarEvento($_POST['idEvento']);
      }
      $datos['arrayPedido'] = $pedido;
      $datos["userLogueado"] = $_SESSION['user'];
      $idNuevoPedido = $this->model->getIdUltimoPedido();
      redirect("fichaPedido?id=".$idNuevoPedido);
    }

    public function modificarPedidoSeleccionado(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $unPedido['fechaInicio'] = date("Y-m-d",strtotime(str_replace('/', '-', $unPedido['fechaInicio'])));
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["miPedido"] = $unPedido;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidoModificar',compact('datos'));
    }
       

    public function modificar(){
        $idPedido = $_POST['id'];
        $idSector = $this->model->getIdSectorPorNombre($_POST['sector']);
        $datos['idSector']= $idSector;
        $arrayPedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'idSector' => $idSector,
            'prioridad' => $_POST['prioridad'],
        ];
        $this->model->updatePedido($arrayPedido,$idPedido);
        redirect("fichaPedido?id=".$idPedido);
    }
    
    public function buscarPor(){
        $filter = $_POST['filtro'];
        $value = $_POST['textBusqueda'];
        $datos['todosPedidos'] = $this->model->getAllbyFilter($filter,$value);
        $datos['userLogueado'] = $_SESSION['user'];           
        return view('/pedidos/pedidosVerTodos', compact('datos'));         
     }

     public function finalizar(){
         $this->model->updateEstadoPedido($_POST['id'],'Finalizado');
         redirect("fichaPedido?id=".$_POST['id']);
     }
}

