<?php 
require_once __DIR__ . '/includes/config.php';

$title = 'Inicio';
?>

<?php ob_start() ?>
<div class="text-center m-5">
  <h1>Hola</h1>
  <h1>Esto</h1>
  <h1>Es</h1>
  <h1>Una</h1>
  <h1>Portada</h1>
</div>
<?php $content = ob_get_clean(); ?>

<?php require __DIR__ . '/includes/template/template.php' ?>