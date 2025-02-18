<?php
$title = "Escritorio";
ob_start();
?>
<h1>¡Bienvenido al CRM!</h1>
<p>Hola mundo.</p>
<?php
$content = ob_get_clean();
require_once '../app/views/layouts/layout.php';
?>