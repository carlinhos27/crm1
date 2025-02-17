<?php
require_once '../app/core/Router.php'; // Carga el enrutador
require_once '../routes/web.php'; // Carga las rutas

$router = new Router();
$router->dispatch();