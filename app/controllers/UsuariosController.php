<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
   public function __construct()
    {
      $this->model = new Usuarios();
      session_start();
    
   }
    
       /*Show all pedidos*/
    public function index(){
        if(isset($_GET["page"])){
            $pagina=$_GET["page"];
        }else{
            $pagina=1;
        }
        $todosUsuarios = $this->model->get(); 
        $datos["todosUsuarios"] = $todosUsuarios;
        $totalPaginas=$this->model->getsize();
        $datos["totalPaginas"] =   $totalPaginas;
        $datos["userLogueado"] = $_SESSION['user'];  
        $userPer= $this->model->AllPermisos($_SESSION['user']);
        var_dump($userPer);
        $datos["userPermisos"]= $userPer;
        return view('usuario/AdministracionUsuario', compact('datos'));
    }

    public function vistaGestionUsuario(){    
        return view('/usuarios/gestionUsuario');    
    }

    public function vistaAdministracionUsuario(){
        $todosUsuarios = $this->model->get();     
        $datos['todosUsuarios'] = $todosUsuarios;
        $datos["userLogueado"] = $_SESSION['user'];
        $userPer= $this->model->AllPermisos($_SESSION['user']);
        
        $datos["userPermisos"]= $userPer;
        $todosRoles=$this->model->getRoles(); 
        $todosPersonas=$this->model->getPersonas(); 
        $datos['nombresRoles'] = $todosRoles; 
        $datos['todosPersonas'] = $todosPersonas; 
        return view('/usuarios/administracionUsuario', compact('datos'));
    }
/*public function vistaAltaUsuario(){
   
}*/
    
  public function vistamodificarUsuario(){
    return view('/usuarios/administracionUsuario.modificar');
}
    public function vistaeliminarUsuario(){
    return view('/usuarios/administracionUsuario.eliminar');
}
    public function vistaAdministracionRol(){
    return view('/usuarios/administracionRol');
    
}
    public function vistaAltaRol(){
          return view('/usuarios/administracionRol.alta');
    }
    public function vistaModificarRol(){
          return view('/usuarios/administracionRol.modificar');
    }
    public function vistaEliminarRol(){
          return view('/usuarios/administracionRol.eliminar');
    }
    public function vistaAdministracionPermisos(){
        $roles=$this->model->getRoles();
        $permisos=$this->model->getPermisos();
        $datos['roles'] = $roles;
        $datos['permisos'] = $permisos;
        if (empty($_GET)) {
           $datos['permisosxrol'] = $this->model->permisosxrol($roles[0]['idRol'],$roles[0]['nombreRol']);
        } else {
           $datos['permisosxrol'] = $this->model->permisosxrol(explode("_",$_GET['rol'])[0],explode("_",$_GET['rol'])[1]);
        }   
        return view('/usuarios/administracionPermisos',compact('datos'));
    }

    public function guardarPermisos(){      
        $arrayPermisos=$_POST['idPermiso'];
        foreach ($arrayPermisos as $key => $value) {
            $datos = [
                'idRol' => $_POST['idRol'],
                'idPermiso' => $value,
            ];
            $this->model->guardarPermisosXRol($datos);
        }
        redirect("usuario/AdministracionPermisos");
    }
    
    public function vistaEliminarPermiso(){
          return view('/usuarios/administracionPermisos.eliminar');
    }

    public function guardar(){
        $idSector = $this->model->getIdSectorPorNombre($_POST['sector']);
        $datos['idSector']= $idSector;
        $pedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'idSector' => $idSector,
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
    
    public function validarUsuario(){
        $idRol=$this->model->buscarRol($_POST['nombreRol']);
        $idPersona=$this->model->buscarPersona($_POST['nombrePersona']);
       $pedido = [
        'nombre' => $_POST['nombre'],
        'password' => $_POST['password'],
        'prioridad' => $idRol,
        'idSector' => $idPersona,
        ];
       //verifico si existe el usuario
        $statement= $this->model->buscarUsuario($_POST['nombre']);      
    if(empty($statement)){
        $this->model->insert($pedido);
        return view('usuarios/AdministracionUsuario');
    }else{
        echo 'Usuario ya existente';
        return view('usuarios/AdministracionUsuario');
    }       
}

 public function saveUsuario($datos){
        $this->model->insert($datos);            
 }
    
}
