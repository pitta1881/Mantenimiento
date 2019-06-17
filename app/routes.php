<?php

    $router->get('', 'PagesController@login');
   $router->get('home', 'PagesController@home');
   $router->get('cerrarSesion', 'PagesController@cerrarSesion');


//rutas pedidos
    $router->get('pedido/verTodos', 'PedidoController@index');
    $router->get('fichaPedido', 'PedidoController@ficha');
    $router->post('pedido/guardar', 'PedidoController@guardar');
    $router->post('pedido/buscar', 'PedidoController@buscarPor');
    $router->get('pedido/modificar/seleccionado', 'PedidoController@modificarPedidoSeleccionado');
    $router->post('pedido/modificar', 'PedidoController@modificar');
    $router->post('pedido/finalizar', 'PedidoController@finalizar');
    

//rutas tareas
    $router->post('tarea/guardar', 'TareaController@guardar');
    $router->get('tarea/modificar/seleccionado', 'TareaController@modificarTareaSeleccionada');
    $router->post('pedido/tarea/eliminar', 'TareaController@eliminar');
    $router->post('tarea/modificar/guardar', 'TareaController@modificar');
    $router->get('tarea/agentes/asignar', 'TareaController@verAgentesDisponibles');
    $router->post('tarea/asignarAgentes/seleccionados','TareaController@asignarAgentes');
    $router->get('fichaTarea', 'TareaController@ficha');
    $router->post('tarea/agentes/desasignar', 'TareaController@desasignarAgente');
    $router->post('tarea/cambiarEstado/seleccionado', 'TareaController@cambiarEstado');

//rutas OT
    $router->get('OT/verTodos', 'OTController@index');
    $router->get('ot/crear', 'OTController@verTareasSinAsignar');
    $router->post('ot/crear/seleccionados','OTController@crearOT');
    $router->get('fichaOT', 'OTController@ficha');

//rutas Usuarios
    $router->post('login/validar', 'LoginController@validarLogin');
    $router->get('usuarios/gestionUsuario','UsuariosControler@vistaGestionUsuario');
    

    $router->get('usuarios/AdministracionUsuario','UsuariosControler@vistaAdministracionUsuario');
    $router->get('usuarios/altaUsuario','UsuariosControler@vistaAltaUsuario');
    $router->post('usuarios/validarUsuario','UsuariosControler@validarUsuario');
    $router->get('usuarios/modificarUsuario','UsuariosControler@vistamodificarUsuario');
    $router->get('usuarios/eliminarUsuario','UsuariosControler@vistaeliminarUsuario');

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

//rutas agentes

$router->get('agente/administracionAgentes','agentesController@vistaAdministracionAgentes');
$router->post('agente/administracionAgente/cargarNuevoAgente', 'agentesController@guardarAgente');
$router->get('agente/modificar/seleccionado', 'agentesController@vistaModificar');
$router->post('agente/administracionAgente/modificarAgente', 'agentesController@update');
$router->post('agente/eliminar', 'agentesController@delete');

//rutas especializaciones

$router->get('especializacion/administracionEspecializacion','EspecializacionController@vistaAdministracionEspecializacion');
$router->post('especializacion/administracionEspecializacion/cargarNuevaEspecializacion', 'EspecializacionController@guardarEspecializacion');
$router->get('especializacion/modificar/seleccionado', 'EspecializacionController@vistaModificar');
$router->post('especializacion/administracionEspecializacion/modificarEspecializacion', 'EspecializacionController@update');
$router->post('especializacion/eliminar', 'EspecializacionController@delete');


//rutas insumos
    $router->get('insumos/administracionInsumos', 'InsumosController@vistaAdministracionInsumos');
    $router->post('insumos/administracionInsumos/guardarInsumo', 'InsumosController@guardarInsumo');
    $router->get('insumo/modificar/seleccionado', 'InsumosController@vistaModificar');
    $router->post('insumos/administracionInsumos/modificarInsumo', 'InsumosController@update');
    $router->post('insumo/eliminar', 'InsumosController@delete');



//rutas sectores
    $router->get('sectores/administracionSectores', 'SectoresController@vistaAdministracionSectores');
    $router->post('sectores/administracionSectores/guardarSector', 'SectoresController@guardarSector');
    $router->get('sectores/modificar/seleccionado', 'SectoresController@vistaModificar');
    $router->post('sectores/administracionSectores/modificarSector', 'SectoresController@update');
    $router->post('sectores/eliminar', 'SectoresController@delete');

//rutas Eventos
    $router->get('eventos/administracionEventos', 'EventosController@vistaAdministracionEventos');
    $router->post('eventos/administracionEventos/guardarEvento', 'EventosController@guardarEvento');
    $router->get('eventos/modificar/seleccionado', 'EventosController@vistaModificar');
    $router->post('eventos/administracionEventos/modificarEvento', 'EventosController@update');
    $router->post('eventos/eliminar', 'EventosController@delete');




    $router->get('not_found', 'ProjectController@notFound');
    $router->get('internal_error', 'ProjectController@internalError');
