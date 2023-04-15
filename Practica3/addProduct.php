<?php

require_once 'includes/config.php';

$title = 'Añadir producto';

ob_start();
?>

<?php if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] == false) : ?>
    <?php $title = 'Página no disponible'; ?>
    <div class="alert alert-danger m-2 flex-fill h-100" role="alert">
        No tienes permisos suficientes para acceder a esta página.
    </div>
<?php else: ?>
    <div class="container justify-content-center col-lg-5">
        <?= ($addProductForm = new es\ucm\fdi\aw\forms\AddProductForm())->handleForm(); ?>
    </div>
<?php endif;

$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>