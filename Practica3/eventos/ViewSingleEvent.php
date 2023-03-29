<?php
    require_once dirname(__DIR__).'\includes\config.php';

    use \es\ucm\fdi\aw\DAO\EventDAO as EventDAO;
    use \es\ucm\fdi\aw\DAO\EventUsersDAO as EventUsersDAO;
    
    if (!isset($_GET['eventID'])) {
        goto no_event_id;
    }

    $eventID = $_GET['eventID'];

    $eventDAO = new EventDAO();
    $result = $eventDAO->get('id', $eventID);

    if (!$result){
        goto no_event_result;
    }
?>

<h2 class="h2"><?=$result['nombre']?></h2>
<hr>
<p>
    <?=$result['descripcion']?>
</p>
<h3 class="h3">Roles ocupados</h3>
<hr>

<h3 class="h3">Jugadores</h3>
<hr>
<table class="table table-striped">
    <thead>
        <th scope="col">Jugador</th>
        <th>Equipo</th>
        <th>Rol</th>
    </thead>
    <tbody>
        <?php
            $eventUsersDAO = new EventUsersDAO();
            $results = $eventUsersDAO->getUserInfoInEvent($eventID);

            if ($results)
                foreach ($results as $result):
        ?>
        <tr>
            <td class="text-nowrap"><?=$result['name']?></td>
            <td class="text-nowrap"><?=($result['team'] ?? 'Ninguno')?></td>
            <td class="text-nowrap"><?=$result['role']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php goto end; ?>



<?php no_event_id: ?>
<div class="alert alert-warning">
    No event ID was given
</div>
<?php goto end; ?>



<?php no_event_result: ?>
<div class="alert alert-warning">
    Unknown event
</div>
<?php goto end; ?>



<?php end: ?>