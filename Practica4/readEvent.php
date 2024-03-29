<?php

use es\ucm\fdi\aw\DAO\EventDAO;
use es\ucm\fdi\aw\DAO\EventRolesDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\forms\AbandonEventForm;

require_once 'includes/config.php';

if (!isset($_SESSION['user']))
    goto end;

if (!isset($_GET['eventID'])) {
    $error = 'Ha ocurrido un error inesperado (no existe identificador de evento).';
} else {
    $eventID = $_GET['eventID'];
    $eventDAO = new EventDAO();
    $eventDTOResults = $eventDAO->read($eventID);
    $eventRolesDAO = new EventRolesDAO();
    $availableRoles = $eventRolesDAO->read();

    if (count($eventDTOResults) == 0) {
        $error = 'No existe este evento.';
    } else {
        $eventDTO = $eventDTOResults[0];
        $eventID = $eventDTO->getID();

        $roleNames = $eventRolesDAO->getRolesName();
        $playersPerRole = $eventRolesDAO->getCountPerRole($eventID);
        $maximumsPerRole = $eventRolesDAO->getMaximumsPerRole();
        $playersResults = $eventDAO->getPlayersForEvent($eventID);
    }
}

ob_start();

?>

<?php if (isset($error)) : ?>

    <div class="alert alert-danger">
        <?= $error ?>
    </div>

<?php else : ?>

    <h4><?= $eventDTO->getName(); ?></h4>
    <p><?= $eventDTO->getDescription(); ?></p>
    <hr>
    <br>

    <h4>Roles ocupados</h4>
    <ul class="list-group list-group-flush">
        <?php foreach ($roleNames as $roleID => $roleName) :
        ?>

            <li class="list-group-item"><b><?= ucfirst($roleName) ?>:</b> <?= isset($playersPerRole[$roleID]) ? $playersPerRole[$roleID] : 0 ?> / <?= $maximumsPerRole[$roleID] ?></li>

        <?php endforeach; ?>
    </ul>
    <hr>
    <br>

    <h4>Jugadores</h4>
    <?php if (count($playersResults) == 0) : ?>
        <br>
        <div class="alert alert-info">
            Aún no hay jugadores apuntados a este evento
        </div>
    <?php else : ?>
        <table class="table table-hover">
            <thead>
                <th scope="col">Nombre</th>
                <th scope="col">Rol</th>
            </thead>
            <tbody>
                <?php foreach ($playersResults as $playerInfo) : ?>
                    <?php
                    $playerName = $playerInfo['name'];
                    $playerRole = ucfirst($eventRolesDAO->read($playerInfo['eventRoleID'])[0]->getName());
                    ?>
                    <tr>
                        <td><?= $playerName ?></td>
                        <td><?= $playerRole ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
    <hr>
    <br>

    <h4>Acciones</h4>
    <div class="d-flex flex-row">
        <div class="px-1">
            <?php

            $userID = $_SESSION['user']->getID();

            if ($eventDAO->playerHasJoinedEvent($userID, $eventID)) :
            ?>

                <?= ($form = new AbandonEventForm($eventID))->handleForm(); ?>

            <?php else : ?>

                <form action="joinEvent.php" method="GET">
                    <input type="hidden" name="eventID" value="<?=$eventID?>">
                    <button class="btn btn-primary">Unirse</button>
                </form>

            <?php endif; ?>
        </div>

        <?php

        $userDAO = new UserDAO();
        $userRoles = $userDAO->getUserRoles($userID);
        $isAdmin = false;

        foreach ($userRoles as $userRole) {
            if ($userRole->getRoleName() == 'admin') {
                $isAdmin = true;
                break;
            }
        }

        $isViewingAsAdmin = ((array)json_decode($_COOKIE['events_cookie']))['view_mode'] == 'admin';

        if ($isAdmin && $isViewingAsAdmin) :
        ?>

            <div class="px-5 d-flex flex-row">
                <form action="updateEvent.php" method="GET" class="px-1">
                    <input type="hidden" name="eventID" value="<?=$eventID?>">
                    <button class="btn btn-primary">Modificar</button>
                </form>
                <form action="deleteEvent.php" method="GET" class="px-1">
                    <input type="hidden" name="eventID" value="<?=$eventID?>">
                    <button class="btn btn-outline-danger">Eliminar</button>
                </form>
            </div>

        <?php endif; ?>
    </div>

<?php endif; ?>

<?php
end:

$content = ob_get_clean();
require_once 'includes/templates/events_template.php';
?>