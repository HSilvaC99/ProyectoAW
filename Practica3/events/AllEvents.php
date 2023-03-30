<?php
    require_once dirname(__DIR__).'/includes/config.php';

    use \es\ucm\fdi\aw\src\Privileges as Privileges;
    use \es\ucm\fdi\aw\src\DAO\EventDAO as EventDAO;

    $privileges = Privileges::getCurrentUserPrivileges();

    if ($privileges->hasPrivilege('events.all_events.read')):
?>

<p class="h2">Eventos</p>
<br>

<table class="table table-striped">
    <thead>
        <th scope="col">Nombre</th>
    </thead>
    <tbody>
        <?php
            $eventsDAO = new EventDAO();
            $results = $eventsDAO->getAll();
            
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
                </tr>
            <?php
                endforeach
            ?>
    </tbody>
</table>
<?php else: ?>

<div class="alert alert-warning">
    No tiene permisos para acceder a esta página
</div>

<?php endif; ?>