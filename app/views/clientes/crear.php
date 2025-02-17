<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
</head>
<body>
    <h1>Crear Cliente</h1>
    <form action="/clientes/guardar" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono">
        
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion">
        
        <label for="operador_id">Operador ID:</label>
        <input type="number" name="operador_id" id="operador_id" required>

        <label for="empresa_id">empresa ID:</label>
        <input type="number" name="empresa_id" id="empresa_id" required>
        
        <button type="submit">Guardar Cliente</button>
    </form>
</body>
</html>
