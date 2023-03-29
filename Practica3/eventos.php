<?php
    $templateID = 'templateID';
    $title = 'Eventos';
?>

<?php ob_start(); ?>
<div class="d-flex flex-row">
    <div class="bg-dark px-4 py-5" style="width: 300px">
        <form action="eventos.php" method="GET">
            <ul class="list-unstyled">
                <li>
                    <button class="btn btn-link text-decoration-none text-primary w-100 text-start" name="<?=$templateID?>" value="AllEvents">Todos los eventos</button>
                </li>
                <li>
                    <button class="btn btn-link text-decoration-none text-primary w-100 text-start" name="<?=$templateID?>" value="MyEvents">Mis eventos</button>
                </li>
                <li>
                    <button class="btn btn-link text-decoration-none text-primary w-100 text-start" name="<?=$templateID?>" value="MyTeam">Mi equipo</button>
                </li>
            </ul>
        </form>
    </div>
    <div class="flex-fill px-4 py-3">
        <?php
            $templateFile = 'AllEvents';

            if (isset($_GET[$templateID]))
                $templateFile  = $_GET[$templateID];

            $filepath = "eventos/{$templateFile}.php";
        
            if (file_exists($filepath)):
        ?>

            <?php require $filepath; ?>
        
        <?php else: ?>
        
            <div class="alert alert-warning">
                No existe esta página
            </div>
        
        <?php endif ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require 'includes/template/template.php'; ?>
