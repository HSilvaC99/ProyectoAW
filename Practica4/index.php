<?php

require_once 'includes/config.php';

?>

<?php ob_start(); ?>

<div class="flex-fill d-flex align-items-center justify-content-center px-3 py-2">
    <div class="d-flex flex-column align-items-center">
        <h1 class="display-1">Zeus Airsoft</h1>
        <p class="lead">Página principal de Zeus Airsoft. Puedes navegar las distintas vistas usando la navbar arriba, pinchando en cualquiera de los enlaces.</p>
    </div>    
</div>

<?php 

$title = 'Inicio';
$content = ob_get_clean();


require_once PROJECT_ROOT . '/includes/templates/default_template.php';

?>