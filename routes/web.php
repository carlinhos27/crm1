<?php
//dashboard
    //rutas GET
$router->get('home', ['HomeController', 'index']);
$router->get('/', ['HomeController', 'index']);


// clientes
    // Rutas GET
$router->get('clientes', [ClientesController::class, 'index']);
$router->get('clientes/crear', [ClientesController::class, 'create']);
$router->get('clientes/editar/{id}', [ClientesController::class, 'editar']);


    // Rutas POST
$router->post('clientes/guardar', [ClientesController::class, 'store']);
$router->post('clientes/actualizar/{id}', [ClientesController::class, 'update']);
$router->post('clientes/eliminar/{id}', [ClientesController::class, 'destroy']);



