 <?php

    $router->get('', 'PagesController@home');
    $router->get('about', 'PagesController@about');

    $router->get('verTurnos', 'formularioController@index');
    $router->get('turno/crear', 'formularioController@create');
    $router->post('turno/validar', 'formularioController@validar');
    $router->get('fichaTurno', 'formularioController@ficha');

    $router->get('verPedidos', 'PedidoController@index');
    $router->get('fichaPedido', 'PedidoController@ficha');

    $router->get('not_found', 'ProjectController@notFound');
    $router->get('internal_error', 'ProjectController@internalError');
