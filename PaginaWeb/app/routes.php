<?php

//rutas logIn-logOut
    $router->get('', 'LogInOutController@index');
    $router->post('login/validar', 'LogInOutController@validarLogin');
    $router->get('logOut', 'LogInOutController@logOut');

//rutas Home
    $router->get('home', 'HomeController@index');
    $router->get('administracion', 'HomeController@administracionCards');
    $router->get('changeRoles', 'HomeController@changeRol');

//rutas Usuarios
    $router->get('administracion/usuarios', 'UsuarioController@index');
    $router->post('administracion/usuarios/createUsuario', 'UsuarioController@create');
    $router->post('administracion/usuarios/updateUsuario', 'UsuarioController@update');
    $router->post('administracion/usuarios/updateRolesUsuario', 'UsuarioController@updateRolesUsuario');
    $router->post('administracion/usuarios/delete', 'UsuarioController@delete');
    $router->post('administracion/usuarios/fichaOne', 'UsuarioController@fichaOne');
    $router->post('administracion/usuarios/fichaAll', 'UsuarioController@fichaAll');

//rutas personas
    $router->get('administracion/personas', 'PersonaController@index');
    $router->post('administracion/personas/createPersona', 'PersonaController@create');
    $router->post('administracion/personas/updatePersona', 'PersonaController@update');
    $router->post('administracion/personas/delete', 'PersonaController@delete');
    $router->post('administracion/personas/updateEstadoPersona', 'PersonaController@updateEstado');
    $router->post('administracion/personas/fichaOne', 'PersonaController@fichaOne');
    $router->post('administracion/personas/fichaAll', 'PersonaController@fichaAll');

//rutas rol
    $router->get('administracion/roles', 'RolController@index');
    $router->post('administracion/roles/createRol', 'RolController@create');
    $router->post('administracion/roles/updateRol', 'RolController@update');
    $router->post('administracion/roles/delete', 'RolController@delete');
    $router->post('administracion/roles/fichaOne', 'RolController@fichaOne');
    $router->post('administracion/roles/fichaAll', 'RolController@fichaAll');

//rutas permisos
    $router->get('administracion/permisos', 'PermisoController@index');
    $router->post('administracion/permisos/createPermiso', 'PermisoController@create');
    $router->post('administracion/permisos/updatePermiso', 'PermisoController@update');
    $router->post('administracion/permisos/delete', 'PermisoController@delete');
    $router->post('administracion/permisos/fichaOne', 'PermisoController@fichaOne');
    $router->post('administracion/permisos/fichaAll', 'PermisoController@fichaAll');

//rutas agentes
    $router->get('administracion/agentes', 'AgenteController@index');
    $router->post('administracion/agentes/createAgente', 'AgenteController@create');
    $router->post('administracion/agentes/updateAgente', 'AgenteController@update');
    $router->post('administracion/agentes/delete', 'AgenteController@delete');
    $router->post('administracion/agentes/fichaOne', 'AgenteController@fichaOne');
    $router->post('administracion/agentes/fichaAll', 'AgenteController@fichaAll');

//rutas especializaciones
    $router->get('administracion/especializaciones', 'EspecializacionController@index');
    $router->post('administracion/especializaciones/createEspecializacion', 'EspecializacionController@create');
    $router->post('administracion/especializaciones/updateEspecializacion', 'EspecializacionController@update');
    $router->post('administracion/especializaciones/delete', 'EspecializacionController@delete');
    $router->post('administracion/especializaciones/fichaOne', 'EspecializacionController@fichaOne');
    $router->post('administracion/especializaciones/fichaAll', 'EspecializacionController@fichaAll');

//rutas sectores
    $router->get('administracion/sectores', 'SectorController@index');
    $router->post('administracion/sectores/createSector', 'SectorController@create');
    $router->post('administracion/sectores/updateSector', 'SectorController@update');
    $router->post('administracion/sectores/delete', 'SectorController@delete');
    $router->post('administracion/sectores/fichaOne', 'SectorController@fichaOne');
    $router->post('administracion/sectores/fichaAll', 'SectorController@fichaAll');

//rutas pedidos
    $router->get('pedidos', 'PedidoController@index');
    $router->post('pedidos/createPedido', 'PedidoController@create');
    $router->post('pedidos/updatePedido', 'PedidoController@update');
    $router->post('pedidos/finishPedido', 'PedidoController@finish');
    $router->post('pedidos/cancelPedido', 'PedidoController@cancel');
    $router->post('pedidos/fichaOne', 'PedidoController@fichaOne');
    $router->post('pedidos/fichaAll', 'PedidoController@fichaAll');
        
//rutas insumos
    $router->get('insumos', 'InsumoController@index');
    $router->post('insumos/administracionInsumos/guardarInsumo', 'InsumosController@guardarInsumo');
    $router->post('insumos/administracionInsumos/modificarInsumo', 'InsumosController@update');
    $router->post('insumo/eliminar', 'InsumosController@delete');
    $router->get('insumo/verHistorial', 'InsumosController@verHistorial');
    $router->post('insumo/updateStockSinItem', 'InsumosController@updateStockSinItem');
    $router->get('insumo/verHistorialParticular', 'InsumosController@verHistorialParticular');


//rutas tareas
    $router->post('tarea/guardar', 'TareaController@guardar');
    $router->post('tarea/modificar/guardar', 'TareaController@modificar');
    $router->get('tarea/agentes/asignar', 'TareaController@verAgentesDisponibles');
    $router->post('tarea/asignarAgentes/seleccionados', 'TareaController@asignarAgentes');
    $router->get('fichaTarea', 'TareaController@ficha');
    $router->post('tarea/agentes/desasignar', 'TareaController@desasignarAgente');
    $router->post('tarea/cambiarEstado/seleccionado', 'TareaController@cambiarEstado');
    $router->get('tarea/verHistorial', 'TareaController@verHistorial');
    $router->get('tarea/insumos/asignar', 'InsumosController@verInsumosDisponibles');
    $router->post('tarea/asignarInsumos/seleccionados', 'InsumosController@asignarInsumos');
    $router->post('tarea/insumos/reasignar', 'InsumosController@reasignarInsumo');

//rutas OT
    $router->get('OT/verTodos', 'OTController@index');
    $router->get('ot/crear', 'OTController@verTareasSinAsignar');
    $router->post('ot/crear/seleccionados', 'OTController@crearOT');
    $router->get('fichaOT', 'OTController@ficha');

//rutas Eventos
    $router->get('eventos/administracionEventos', 'EventosController@vistaAdministracionEventos');
    $router->post('eventos/administracionEventos/guardarEvento', 'EventosController@guardarEvento');
    $router->post('eventos/administracionEventos/modificarEvento', 'EventosController@update');
    $router->post('eventos/eliminar', 'EventosController@delete');

// rutas informes
    $router->get('informe/administracion', 'informesController@vistaAdministracionInformes');
    $router->post('informe/datos', 'informesController@getDatos');
    $router->get('not_found', 'ProjectController@internalError');
    $router->get('internal_error', 'ProjectController@internalError');
    $router->post('informePedidos', 'PedidoController@getDatos');

//rutas Orden de Compra
    $router->get('ordendecompra/administracionOC', 'OCController@index');
    $router->get('oc/crear', 'OCController@verInsumos');
    $router->post('oc/asignarInsumos/seleccionados', 'OCController@crearOC');
    $router->get('fichaOC', 'OCController@ficha');
    $router->post('oc/insumos/ingreso', 'OCController@ingreso');
