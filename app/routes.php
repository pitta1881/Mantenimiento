<?php

    $router->get('', 'PagesController@login');
   $router->get('home', 'PagesController@home');
    $router->get('about', 'PagesController@about');

    $router->get('pedido/verTodos', 'PedidoController@index');
    $router->get('fichaPedido', 'PedidoController@ficha');
    $router->get('pedido/crear', 'PedidoController@create');    
    $router->post('pedido/validar', 'PedidoController@validar');
    $router->get('pedido/modificar/seleccionado', 'PedidoController@modificarPedidoSeleccionado');
    $router->get('pedido/verTareas', 'PedidoController@verTareas');
    $router->post('pedido/modificar', 'PedidoController@modificar');

    $router->post('login/validar', 'LoginController@validarLogin');

    $router->get('not_found', 'ProjectController@notFound');
    $router->get('internal_error', 'ProjectController@internalError');
