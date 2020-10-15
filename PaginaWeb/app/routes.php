<?php

//rutas logIn-logOut
    $router->get('', 'LogInOutController@logIn');
    $router->post('login/validar', 'LogInOutController@validarLogin');
    $router->get('logOut', 'LogInOutController@logOut');

//rutas Home
    $router->get('home', 'HomeController@home');
    $router->get('administracion', 'HomeController@administracionCards');
    $router->get('changeRoles','HomeController@changeRol');

//rutas Usuarios
    $router->get('administracion/usuarios','UsuarioController@administracionUsuarios');
    $router->post('administracion/usuarios/newUsuario','UsuarioController@new');
    $router->post('administracion/usuarios/updateUsuario', 'UsuarioController@update');
    $router->post('administracion/usuarios/updateRolesUsuario', 'UsuarioController@updateRolesUsuario');
    $router->post('administracion/usuarios/deleteUsuario','UsuarioController@delete');

//rutas personas
    $router->get('administracion/personas','PersonaController@administracionPersonas');
    $router->post('administracion/personas/newPersona','PersonaController@new');
    $router->post('administracion/personas/updatePersona','PersonaController@update');
    $router->post('administracion/personas/deletePersona','PersonaController@delete');
    $router->post('administracion/personas/updateEstadoPersona','PersonaController@updateEstado');
    $router->post('administracion/personas/fichaPersona', 'PersonaController@ficha');

//rutas rol
    $router->get('administracion/roles','RolController@administracionRoles');
    $router->post('administracion/roles/newRol', 'RolController@new');
    $router->post('administracion/roles/updateRol', 'RolController@update');
    $router->post('administracion/roles/deleteRol', 'RolController@delete');
    $router->post('administracion/roles/fichaRol', 'RolController@ficha');

//rutas permisos
    $router->get('administracion/permisos','PermisoController@administracionPermisos');
    $router->post('administracion/permisos/newPermiso','PermisoController@new');
    $router->post('administracion/permisos/updatePermiso', 'PermisoController@update');
    $router->post('administracion/permisos/deletePermiso', 'PermisoController@delete');

//rutas agentes
    $router->get('agentes','AgenteController@administracionAgentes');
    $router->post('agentes/newAgente', 'AgenteController@new');
    $router->post('agentes/updateAgente', 'AgenteController@update');
    $router->post('agentes/deleteAgente', 'AgenteController@delete');

//rutas especializaciones
    $router->get('especializaciones','EspecializacionController@administracionEspecializaciones');
    $router->post('especializaciones/newEspecializacion', 'EspecializacionController@new');
    $router->post('especializaciones/updateEspecializacion', 'EspecializacionController@update');
    $router->post('especializaciones/deleteEspecializacion', 'EspecializacionController@delete');

//rutas sectores
    $router->get('sectores', 'SectorController@administracionSectores');
    $router->post('sectores/newSector', 'SectorController@new');
    $router->post('sectores/updateSector', 'SectorController@update');
    $router->post('sectores/deleteSector', 'SectorController@delete');
    $router->post('sectores/fichaSector', 'SectorController@ficha');

//rutas insumos
    $router->get('insumos', 'InsumoController@administracionInsumos');
    $router->post('insumos/administracionInsumos/guardarInsumo', 'InsumosController@guardarInsumo');
    $router->post('insumos/administracionInsumos/modificarInsumo', 'InsumosController@update');
    $router->post('insumo/eliminar', 'InsumosController@delete');
    $router->get('insumo/verHistorial', 'InsumosController@verHistorial');
    $router->post('insumo/updateStockSinItem', 'InsumosController@updateStockSinItem');
    $router->get('insumo/verHistorialParticular', 'InsumosController@verHistorialParticular');


//rutas pedidos
    $router->get('pedidos', 'PedidoController@administracionPedidos');
    $router->post('pedidos/newPedido', 'PedidoController@new');
    $router->post('pedidos/updatePedido', 'PedidoController@update');
    $router->post('pedidos/finishPedido', 'PedidoController@finish');
    $router->post('pedidos/cancelPedido', 'PedidoController@cancel');
    $router->get('pedidos/fichaPedido', 'PedidoController@ficha');
    
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