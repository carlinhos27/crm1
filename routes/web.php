<?php
//dashboard
    //rutas GET
$router->get('home', ['HomeController', 'index']);
$router->get('/', ['HomeController', 'index']);


// clientes
    // Rutas GET
$router->get('clientes', [ClientesController::class, 'index']);
$router->get('clientes/crear', [ClientesController::class, 'create']);
    // Rutas POST
$router->post('clientes/guardar', [ClientesController::class, 'store']);

