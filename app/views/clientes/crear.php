<!-- app/views/clientes/create.php -->
<?php
$esEdicion = isset($cliente);
$titulo = $esEdicion ? "Editar Cliente" : "Crear Cliente";
$accion = $esEdicion ? "/clientes/actualizar/" . $cliente['id'] : "/clientes/guardar";

ob_start();
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4"><?= $titulo ?></h2>

            <form action="<?= $accion ?>" method="POST">
                <input type="hidden" name="id" value="<?= $esEdicion ? $cliente['id'] : '' ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre"
                        value="<?= $esEdicion ? htmlspecialchars($cliente['nombre']) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $esEdicion ? htmlspecialchars($cliente['email']) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" value="<?= $esEdicion ? htmlspecialchars($cliente['telefono']) : '' ?>">
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" value="<?= $esEdicion ? htmlspecialchars($cliente['direccion']) : '' ?>">
                </div>

                <div class="mb-3">
                    <label for="operador_id" class="form-label">Seleccionar Operador:</label>
                    <select class="form-select" name="operador_id" id="operador_id" required>
                        <option value="">Seleccione un operador</option>
                        <?php foreach ($operadores as $operador): ?>
                            <option value="<?= $operador['id'] ?>"
                                <?= $esEdicion && $cliente['operador_id'] == $operador['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($operador['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Empresa -->
                <div class="mb-3">
                    <label for="empresa_id" class="form-label">Seleccionar Empresa:</label>
                    <select class="form-select" name="empresa_id" id="empresa_id" required>
                        <option value="">Seleccione una empresa</option>
                        <?php foreach ($empresas as $empresa): ?>
                            <option value="<?= $empresa['id'] ?>"
                                <?= $esEdicion && $cliente['empresa_id'] == $empresa['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($empresa['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Guardar Cliente</button>
            </form>

            <a href="/clientes" class="btn btn-link mt-3 d-block text-center">Volver a la lista</a>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once '../app/views/layouts/layout.php';
?>