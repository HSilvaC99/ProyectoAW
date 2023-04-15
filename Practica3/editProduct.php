<?php

use es\ucm\fdi\aw\DAO\ProductDAO;

require_once 'includes/config.php';

$title = 'Editar producto';

ob_start();
?>

<div class="container justify-content-center col-lg-5">
    <?= ($editProductForm = new es\ucm\fdi\aw\forms\EditProductForm())->handleForm(); ?>
</div>

<?php
$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>