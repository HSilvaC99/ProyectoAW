<?php

    require 'database.php';
    require 'includes/DAO/DAO.php';
    require 'includes/DAO/EventDAO.php';

    $database = new Database();
    $connection = $database->getConnection();

    if (!$connection) {
        echo <<<EOS
            <div class="alert alert-warning">
                No se puede acceder a la base de datos. Por favor, inténtelo más tarde.
            </div>
        EOS;

        goto end;
    }

    $eventID = $_GET['event_id'];

    $eventsDAO = new EventDAO($connection);
    $eventsWithID = $eventsDAO->get('id', $eventID);
    $event = null;

    if($eventsWithID == null) {
        echo <<<EOS
            <div class="alert alert-warning">
                No existe este evento o no se puede encontrar en la base de datos.
            </div>
        EOS;

        goto end;
    }

    $event = $eventsWithID[0];

    end:
?>

<?if ($event != null):?>

<h4 class="h4"><?=$event['nombre']?></h4>
<hr>
<p><?=$event['descripcion']?></p>
<hr>

<?endif?>