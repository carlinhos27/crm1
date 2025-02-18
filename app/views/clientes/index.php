<!-- app/views/clientes/index.php -->
<?php
$title = "Lista de Clientes";
ob_start();
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Lista de Clientes</h2>
        <a href="/clientes/crear" class="btn btn-success">+ Nuevo Cliente</a>
    </div>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    <div class="card shadow-lg p-3">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['id']) ?></td>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                            <td>
                                <!-- Botón de Editar -->
                                <a href="/clientes/editar/<?= $cliente['id'] ?>" class="btn btn-primary btn-sm">✏️ Editar</a>

                                <!-- Formulario para Eliminar Cliente -->
                                <form action="/clientes/eliminar/<?= $cliente['id'] ?>" method="POST" onsubmit="return confirm('¿Eliminar este cliente?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                                </form>

                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay clientes registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once '../app/views/layouts/layout.php';
?>