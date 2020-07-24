<?php

    $router->get('', 'PagesController@login');
    $router->get('home', 'PagesController@home');
    $router->get('cerrarSesion', 'PagesController@cerrarSesion');

//rutas Login
    $router->post('login/validar', 'LoginController@validarLogin');

//rutas Usuarios
    $router->get('administracion/usuarios','UsuariosController@administracionUsuarios');
    $router->post('administracion/usuarios/newUsuario','UsuariosController@new');
    $router->post('administracion/usuarios/updateUsuario', 'UsuariosController@update');

//rutas personas
    $router->get('administracion/personas','PersonaController@administracionPersonas');
    $router->post('administracion/personas/newPersona','PersonaController@new');
    $router->post('administracion/personas/updatePersona','PersonaController@update');
    $router->post('administracion/personas/deletePersona','PersonaController@delete');
    //$router->post('administracion/personas/updateEstadoPersona','PersonaController@updateEstado');
    $router->post('administracion/personas/fichaPersona', 'PersonaController@ficha');

//rutas rol
    $router->get('administracion/roles','RolesController@administracionRoles');
    $router->post('administracion/roles/newRol', 'RolesController@new');
    $router->post('administracion/roles/updateRol', 'RolesController@update');
    //$router->post('administracion/roles/deleteRol', 'RolesController@delete');
    $router->post('administracion/roles/fichaRol', 'RolesController@ficha');

//rutas permisos
    $router->get('administracion/permisos','PermisosController@administracionPermisos');
    $router->post('administracion/permisos/newPermiso','PermisosController@new');
    $router->post('administracion/permisos/updatePermiso', 'PermisosController@update');
    $router->post('administracion/permisos/deletePermiso', 'PermisosController@delete');

//rutas pedidos
    $router->get('pedido/verTodos', 'PedidoController@index');
    $router->get('fichaPedido', 'PedidoController@ficha');
    $router->post('pedido/guardar', 'PedidoController@guardar');
    $router->post('pedido/buscar', 'PedidoController@buscarPor');
    $router->post('pedido/modificar', 'PedidoController@modificar');
    $router->post('pedido/finalizar', 'PedidoController@finalizar');
    $router->post('pedido/cancelar', 'PedidoController@cancelar');
    
//rutas tareas
    $router->post('tarea/guardar', 'TareaController@guardar');
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

//rutas agentes
    $router->get('agente/administracionAgentes','agentesController@vistaAdministracionAgentes');
    $router->post('agente/administracionAgente/cargarNuevoAgente', 'agentesController@guardarAgente');
    $router->post('agente/administracionAgente/modificarAgente', 'agentesController@update');
    $router->post('agente/eliminar', 'agentesController@delete');

//rutas especializaciones
    $router->get('especializacion/administracionEspecializacion','EspecializacionController@vistaAdministracionEspecializacion');
    $router->post('especializacion/administracionEspecializacion/cargarNuevaEspecializacion', 'EspecializacionController@guardarEspecializacion');
    $router->post('especializacion/administracionEspecializacion/modificarEspecializacion', 'EspecializacionController@update');
    $router->post('especializacion/eliminar', 'EspecializacionController@delete');


//rutas insumos
    $router->get('insumos/administracionInsumos', 'InsumosController@vistaAdministracionInsumos');
    $router->post('insumos/administracionInsumos/guardarInsumo', 'InsumosController@guardarInsumo');
    $router->post('insumos/administracionInsumos/modificarInsumo', 'InsumosController@update');
    $router->post('insumo/eliminar', 'InsumosController@delete');
    $router->get('insumo/verHistorial', 'InsumosController@verHistorial');
    $router->post('insumo/updateStockSinItem', 'InsumosController@updateStockSinItem');
    $router->get('insumo/verHistorialParticular', 'InsumosController@verHistorialParticular');


//rutas sectores
    $router->get('sectores/administracionSectores', 'SectoresController@vistaAdministracionSectores');
    $router->post('sectores/administracionSectores/guardarSector', 'SectoresController@guardarSector');
    $router->post('sectores/administracionSectores/modificarSector', 'SectoresController@update');
    $router->post('sectores/eliminar', 'SectoresController@delete');
    $router->post('fichaSector', 'SectoresController@ficha');

//rutas Eventos
    $router->get('eventos/administracionEventos', 'EventosController@vistaAdministracionEventos');
    $router->post('eventos/administracionEventos/guardarEvento', 'EventosController@guardarEvento');
    $router->post('eventos/administracionEventos/modificarEvento', 'EventosController@update');
    $router->post('eventos/eliminar', 'EventosController@delete');

// rutas informes
    $router->get('informe/administracion','informesController@vistaAdministracionInformes');
    $router->post('informe/datos','informesController@getDatos');
    $router->get('not_found', 'ProjectController@internalError');
    $router->get('internal_error', 'ProjectController@internalError');
    $router->post('informePedidos','PedidoController@getDatos');

//rutas Orden de Compra
    $router->get('ordendecompra/administracionOC','OCController@index');
    $router->get('oc/crear', 'OCController@verInsumos');
    $router->post('oc/asignarInsumos/seleccionados','OCController@crearOC');
    $router->get('fichaOC', 'OCController@ficha');
    $router->post('oc/insumos/ingreso', 'OCController@ingreso');