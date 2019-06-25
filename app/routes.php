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
    $router->post('pedido/cancelar', 'PedidoController@cancelar');
    

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
    $router->get('tarea/verHistorial', 'TareaController@verHistorial');
    $router->get('tarea/insumos/asignar', 'InsumosController@verInsumosDisponibles');
    $router->post('tarea/asignarInsumos/seleccionados','InsumosController@asignarInsumos');
    $router->post('tarea/insumos/reasignar', 'InsumosController@reasignarInsumo');

//rutas OT
    $router->get('OT/verTodos', 'OTController@index');
    $router->get('ot/crear', 'OTController@verTareasSinAsignar');
    $router->post('ot/crear/seleccionados','OTController@crearOT');
    $router->get('fichaOT', 'OTController@ficha');

//rutas Usuarios
    $router->post('login/validar', 'LoginController@validarLogin');
    $router->get('usuarios/AdministracionUsuario','UsuariosController@vistaAdministracionUsuario');
    $router->get('usuarios/altaUsuario','UsuariosController@vistaAltaUsuario');
    $router->post('usuarios/validarUsuario','UsuariosController@validarUsuario');
    $router->get('usuarios/modificarUsuario','UsuariosController@vistamodificarUsuario');
    $router->get('usuarios/eliminarUsuario','UsuariosController@vistaeliminarUsuario');

//rutas rol
    $router->get('roles/AdministracionRol','RolesControler@index');
    $router->get('roles/fichaRol','RolesControler@ficha');
    $router->post('roles/guardar', 'RolesControler@guardar');
    $router->post('roles/buscar', 'RolesControler@buscarPor');
    $router->get('roles/modificar/seleccionado', 'RolesControler@modificarRolSeleccionado');
    $router->post('roles/modificar', 'RolesControler@modificar');
    $router->post('roles/eliminarRol', 'RolesControler@finalizar');
    $router->get('roles/eliminarRol','RolesControler@vistaEliminarRol');

//rutas permisos
    //rutas permisos
    $router->get('permisos/AdministracionPermisos','PermisosControler@index');
    $router->post('permisos/asignarPermiso','PermisosControler@guardarPermisos');
    $router->get('permisos/eliminarPermiso','PermisosControler@vistaEliminarPermiso');


//rutas personas
    $router->get('persona/AdministracionPersonas','PersonaController@vistaAdministracionPersona');
    $router->post('persona/altaPersona','PersonaController@altaPersona');
    $router->get('persona/modificarPersona/seleccionado','PersonaController@modificarPersonaSeleccionada');
    $router->post('persona/modificar/guardar','PersonaController@modificar');
    $router->post('persona/eliminar','PersonaController@eliminar');
    $router->get('fichaPersona', 'PersonaController@ficha');
    $router->post('persona/modificarEstado','PersonaController@modificarEstado');

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
    $router->get('insumo/verHistorial', 'InsumosController@verHistorial');
    $router->post('insumo/updateStockSinItem', 'InsumosController@updateStockSinItem');
    $router->get('insumo/verHistorialParticular', 'InsumosController@verHistorialParticular');
    



//rutas sectores
    $router->get('sectores/administracionSectores', 'SectoresController@vistaAdministracionSectores');
    $router->post('sectores/administracionSectores/guardarSector', 'SectoresController@guardarSector');
    $router->get('sectores/modificar/seleccionado', 'SectoresController@vistaModificar');
    $router->post('sectores/administracionSectores/modificarSector', 'SectoresController@update');
    $router->post('sectores/eliminar', 'SectoresController@delete');
    $router->get('fichaSector', 'SectoresController@ficha');

//rutas Eventos
    $router->get('eventos/administracionEventos', 'EventosController@vistaAdministracionEventos');
    $router->post('eventos/administracionEventos/guardarEvento', 'EventosController@guardarEvento');
    $router->get('eventos/modificar/seleccionado', 'EventosController@vistaModificar');
    $router->post('eventos/administracionEventos/modificarEvento', 'EventosController@update');
    $router->post('eventos/eliminar', 'EventosController@delete');

// rutas informes
    $router->get('informes/administracionInforme', 'informesController@vistaAdministracionInformes');



    $router->get('not_found', 'ProjectController@internalError');
    $router->get('internal_error', 'ProjectController@internalError');
