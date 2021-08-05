<?php

//rutas logIn-logOut
    $router->get('', 'LogInOutController@index');
    $router->post('login/validar', 'LogInOutController@validarLogin');
    $router->get('logOut', 'LogInOutController@logOut');

//rutas Home
    $router->get('home', 'HomeController@index');
    $router->get('home/boxes', 'HomeController@getBoxes');
    $router->get('administracion', 'HomeController@administracionCards');
    $router->get('changeRoles', 'HomeController@changeRol');

//rutas Usuarios
    $router->get('administracion/usuarios', 'UsuarioController@index');
    $router->post('administracion/usuarios/create', 'UsuarioController@create');
    $router->post('administracion/usuarios/update', 'UsuarioController@update');
    $router->post('administracion/usuarios/updateRolesUsuario', 'UsuarioController@updateRolesUsuario');
    $router->post('administracion/usuarios/delete', 'UsuarioController@delete');
    $router->post('administracion/usuarios/fichaOne', 'UsuarioController@fichaOne');
    $router->post('administracion/usuarios/fichaAll', 'UsuarioController@fichaAll');

//rutas personas
    $router->get('administracion/personas', 'PersonaController@index');
    $router->post('administracion/personas/create', 'PersonaController@create');
    $router->post('administracion/personas/update', 'PersonaController@update');
    $router->post('administracion/personas/delete', 'PersonaController@delete');
    $router->post('administracion/personas/updateEstadoPersona', 'PersonaController@updateEstado');
    $router->post('administracion/personas/fichaOne', 'PersonaController@fichaOne');
    $router->post('administracion/personas/fichaAll', 'PersonaController@fichaAll');

//rutas rol
    $router->get('permisosRolActual', 'RolController@getPermisos');
    $router->get('administracion/roles', 'RolController@index');
    $router->post('administracion/roles/create', 'RolController@create');
    $router->post('administracion/roles/update', 'RolController@update');
    $router->post('administracion/roles/delete', 'RolController@delete');
    $router->post('administracion/roles/fichaOne', 'RolController@fichaOne');
    $router->post('administracion/roles/fichaAll', 'RolController@fichaAll');

//rutas permisos
    $router->get('administracion/permisos', 'PermisoController@index');
    $router->post('administracion/permisos/create', 'PermisoController@create');
    $router->post('administracion/permisos/update', 'PermisoController@update');
    $router->post('administracion/permisos/delete', 'PermisoController@delete');
    $router->post('administracion/permisos/fichaOne', 'PermisoController@fichaOne');
    $router->post('administracion/permisos/fichaAll', 'PermisoController@fichaAll');

//rutas agentes
    $router->get('administracion/agentes', 'AgenteController@index');
    $router->post('administracion/agentes/create', 'AgenteController@create');
    $router->post('administracion/agentes/update', 'AgenteController@update');
    $router->post('administracion/agentes/delete', 'AgenteController@delete');
    $router->post('administracion/agentes/fichaOne', 'AgenteController@fichaOne');
    $router->post('administracion/agentes/fichaAll', 'AgenteController@fichaAll');

//rutas especializaciones
    $router->get('administracion/especializaciones', 'EspecializacionController@index');
    $router->post('administracion/especializaciones/create', 'EspecializacionController@create');
    $router->post('administracion/especializaciones/update', 'EspecializacionController@update');
    $router->post('administracion/especializaciones/delete', 'EspecializacionController@delete');
    $router->post('administracion/especializaciones/fichaOne', 'EspecializacionController@fichaOne');
    $router->post('administracion/especializaciones/fichaAll', 'EspecializacionController@fichaAll');

//rutas sectores
    $router->get('administracion/sectores', 'SectorController@index');
    $router->post('administracion/sectores/create', 'SectorController@create');
    $router->post('administracion/sectores/update', 'SectorController@update');
    $router->post('administracion/sectores/delete', 'SectorController@delete');
    $router->post('administracion/sectores/fichaOne', 'SectorController@fichaOne');
    $router->post('administracion/sectores/fichaAll', 'SectorController@fichaAll');

//rutas pedidos
    $router->get('pedidos', 'PedidoController@index');
    $router->post('pedidos', 'PedidoController@index');
    $router->post('pedidos/create', 'PedidoController@create');
    $router->post('pedidos/update', 'PedidoController@update');
    $router->post('pedidos/finish', 'PedidoController@finish');
    $router->post('pedidos/cancel', 'PedidoController@cancel');
    $router->post('pedidos/fichaOne', 'PedidoController@fichaOne');
    $router->post('pedidos/fichaAll', 'PedidoController@fichaAll');
        
//rutas tareas
    $router->post('tarea/create', 'TareaController@create');
    $router->post('tarea/update', 'TareaController@update');
    $router->post('tarea/cancel', 'TareaController@cancel');
    $router->post('tarea/getAgentesInsumos', 'TareaController@getAgentesInsumos');
    $router->post('tarea/asignaciones', 'TareaController@asignarAgentesInsumos');
    $router->post('tarea/desasignaciones', 'TareaController@desasignarAgentesInsumos');
    $router->post('tarea/fichaOne', 'TareaController@fichaOne');
    $router->post('tarea/getTareasSinOT', 'TareaController@getTareasSinOT');

//rutas insumos
    $router->get('insumos', 'InsumoController@index');
    $router->post('insumos/create', 'InsumoController@create');
    $router->post('insumos/update', 'InsumoController@update');
    $router->post('insumos/delete', 'InsumoController@delete');
    $router->post('insumos/fichaOne', 'InsumoController@fichaOne');
    $router->post('insumos/fichaAll', 'InsumoController@fichaAll');

//rutas Orden de Compra
    $router->get('ordendecompra', 'OCController@index');
    $router->post('ordendecompra/create', 'OCController@create');
    $router->post('ordendecompra/update', 'OCController@update');
    $router->post('ordendecompra/updateCostoFinal', 'OCController@updateCostoFinal');
    $router->post('ordendecompra/updateInsumos', 'OCController@updateInsumos');
    $router->post('ordendecompra/cancelInsumo', 'OCController@cancelInsumo');
    $router->post('ordendecompra/fichaOne', 'OCController@fichaOne');
    $router->post('ordendecompra/fichaAll', 'OCController@fichaAll');

//rutas Eventos
    $router->get('eventos', 'EventoController@index');
    $router->post('eventos/create', 'EventoController@create');
    $router->post('eventos/update', 'EventoController@update');
    $router->post('eventos/updateEstado', 'EventoController@updateEstado');
    $router->post('eventos/delete', 'EventoController@delete');
    $router->post('eventos/fichaOne', 'EventoController@fichaOne');
    $router->post('eventos/fichaAll', 'EventoController@fichaAll');

//rutas OT
    $router->get('ordendetrabajo', 'OTController@index');
    $router->post('ordendetrabajo/create', 'OTController@create');
    $router->post('ordendetrabajo/updateTareas', 'OTController@update');
    $router->post('ordendetrabajo/fichaOne', 'OTController@fichaOne');
    $router->post('ordendetrabajo/fichaAll', 'OTController@fichaAll');


// rutas informes
    $router->get('informe/administracion', 'informesController@vistaAdministracionInformes');
    $router->post('informe/datos', 'informesController@getDatos');
    $router->get('not_found', 'ProjectController@internalError');
    $router->get('internal_error', 'ProjectController@internalError');
    $router->post('informePedidos', 'PedidoController@getDatos');
