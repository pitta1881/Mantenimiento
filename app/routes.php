<?php

    $router->get('', 'PagesController@login');
   $router->get('home', 'PagesController@home');
    $router->get('about', 'PagesController@about');


//rutas pedidos
    $router->get('pedido/verTodos', 'PedidoController@index');
    $router->get('fichaPedido', 'PedidoController@ficha');
    $router->get('pedido/crear', 'PedidoController@create');    
    $router->post('pedido/validar', 'PedidoController@validar');
    $router->post('pedido/buscar', 'PedidoController@buscarPor');
    $router->get('pedido/modificar/seleccionado', 'PedidoController@modificarPedidoSeleccionado');
    $router->get('pedido/verTareas', 'PedidoController@verTareas');
    $router->post('pedido/modificar', 'PedidoController@modificar');

//rutas tareas
    $router->post('pedido/tarea/guardar', 'TareaController@guardar');

//rutas Usuarios
    $router->post('login/validar', 'LoginController@validarLogin');
$router->get('usuario/gestionUsuario','UsuariosControler@vistaGestionUsuario');
$router->get('usuario/AdministracionUsuario','UsuariosControler@vistaAdministracionUsuario');
   $router->get('usuario/altaUsuario','UsuariosControler@vistaAltaUsuario');
 $router->post('usuario/validarUsuario','UsuariosControler@validarUsuario');
$router->get('usuario/modificarUsuario','UsuariosControler@vistamodificarUsuario');
$router->get('usuario/eliminarUsuario','UsuariosControler@vistaeliminarUsuario');

//rutas rol
$router->get('usuario/AdministracionRol','UsuariosControler@vistaAdministracionRol');
$router->get('usuario/altaRol','UsuariosControler@vistaAltaRol');
$router->get('usuario/modificarRol','UsuariosControler@vistaModificarRol');
$router->get('usuario/eliminarRol','UsuariosControler@vistaEliminarRol');

//rutas permisos
$router->get('usuario/AdministracionPermisos','UsuariosControler@vistaAdministracionPermisos');
$router->get('usuario/asignarPermiso','UsuariosControler@vistaAsignarPermiso');
$router->get('usuario/eliminarPermiso','UsuariosControler@vistaEliminarPermiso');


//rutas personas

$router->get('usuario/AdministracionPersonas','UsuariosControler@vistaAdministracionPersona');
   $router->get('usuario/altaPersona','UsuariosControler@vistaAltaPersona');

$router->get('usuario/modificarPersona','UsuariosControler@vistamodificarPersona');
$router->get('usuario/eliminarPersona','UsuariosControler@vistaeliminarUsuario');



$router->get('not_found', 'ProjectController@notFound');
    $router->get('internal_error', 'ProjectController@internalError');
