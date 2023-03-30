<?php
    require_once dirname(__DIR__) .'/includes/config.php';

    use \es\ucm\fdi\aw\src\Privileges as Privileges;
    use \es\ucm\fdi\aw\src\DAO\EventUsersDAO as EventUsersDAO;

    $privileges = Privileges::getCurrentUserPrivileges();

    $canRead = $privileges->hasPrivilege('events.my_events.read');

    if ($canRead && isset($_SESSION['user'])) {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $actionResult = '';

            switch($action) {
                case 'abandon':
                    {
                        $eventID = $_GET['eventID'];
                        $eventUsersDAO = new EventUsersDAO();
                        $abandonResult = $eventUsersDAO->delete('event_id', $eventID);
                        
                        if ($abandonResult)
                            $actionResult = 'abandon.ok';
                    }
                break;
                case 'join':
                    {
                        $eventID = $_GET['eventID'];
                        $eventUsersDAO = new EventUsersDAO();
                        
                        $data = array();
                        $data['event_id'] = $eventID;
                        $data['user_mail'] = $_SESSION['user']['mail'];
                        $data['event_role'] = 'Bananero repanadero';

                        $joinResult = $eventUsersDAO->insert($data);
                        
                        if ($joinResult)
                            $actionResult = 'join.ok';
                    }
                break;
                default:
                    break;
            }
        }
    }
?>

<?php if(!$canRead): ?>

<div class="alert alert-warning">
    No tienes privilegios para acceder a esta página
</div>

<?php else: ?>

<?php if (isset($actionResult) && $actionResult == 'abandon.ok'): ?>

<div class="alert alert-success">
    Has abandonado el evento correctamente
</div>

<?php elseif (isset($actionResult) && $actionResult == 'join.ok'): ?>

<div class="alert alert-success">
    Te has unido al evento correctamente
</div>

<?php endif; ?>

<p class="h2">Mis eventos</p>
<br>

<?php
    $userMail = $_SESSION['user']['mail'];
    $eventUsersDAO = new EventUsersDAO();
    $results = $eventUsersDAO->getEventsFromUser($userMail);

    if (count($results) == 0):
?>

<div class="alert alert-light">
    No estás apuntado a ningún evento aún.
</div>

<?php else: ?>

<table class="table table-striped">
    <thead>
        <th scope="col">Nombre</th>
        <th scope="col">Acciones</th>
    </thead>
    <tbody>
        <?php
            foreach ($results as $row):
        ?>
        <tr scope="row">
            <form action="events.php">
                <td class="text-nowrap">
                    <input type="hidden" name="templateID" value="ViewSingleEvent">
                    <button type="submit" class="btn btn-link text-decoration-none text-primary" name="eventID" value="<?=$row['id']?>">
                        <?=$row['name']?>
                    </button>
                </td>
            </form>
            <form action="events.php">
                <td>
                    <input type="hidden" name="templateID" value="MyEvents">
                    <input type="hidden" name="action" value="abandon">
                    <button type="submit" class="btn btn-danger" name="eventID" value="<?=$row['id']?>">
                        Abandonar
                    </button>
                </td>
            </form>
        </tr>
        <?php
            endforeach
        ?>
    </tbody>
</table>

<?php endif; ?>

<?php endif; ?>