<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; }
        h1 { text-align: center; }
        ul { list-style: none; padding: 0; }
        li { padding: 10px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Clientes</h1>
        <ul>
            <?php if (!empty($clientes)): ?>
                <?php foreach ($clientes as $cliente): ?>
                    <li><strong><?= htmlspecialchars($cliente['nombre']) ?></strong> - <?= htmlspecialchars($cliente['email']) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No hay clientes registrados.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
