 <?php

    $router->get('', 'PagesController@home');
    $router->get('about', 'PagesController@about');

    $router->get('pedido/verTodos', 'PedidoController@index');
    $router->get('fichaPedido', 'PedidoController@ficha');
    $router->get('pedido/crear', 'PedidoController@create');    
    $router->post('pedido/validar', 'PedidoController@validar');

     $router->post('login/validar', 'LoginController@validarLogin');



$router->get('not_found', 'ProjectController@notFound');
    $router->get('internal_error', 'ProjectController@internalError');
