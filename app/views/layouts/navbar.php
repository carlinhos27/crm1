<?php
// Definir rutas del navbar manualmente
$navRoutes = [
    'home' => 'Inicio',
    'clientes' => 'Clientes',
    'clientes/crear' => 'Nuevo Cliente',
    'ventas' => 'Ventas',
    'configuracion' => 'Configuración'
];

$currentRoute = trim($_SERVER['REQUEST_URI'], '/'); // Obtener ruta actual
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/home">CRM Solar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($navRoutes as $path => $label): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentRoute == $path) ? 'active' : '' ?>" href="/<?= $path ?>">
                            <?= $label ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
