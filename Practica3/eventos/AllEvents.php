<?php
    require_once dirname(__DIR__).'/includes/config.php';

    use \es\ucm\fdi\aw\src\Role as Role;
    use \es\ucm\fdi\aw\DAO\EventDAO as EventDAO;

    $defaultRole = Role::getDefaultRole();

    if ($defaultRole->getPrivileges()->hasPrivilege('events.all_events.read')):
?>

<p class="h2">Eventos</p>
<br>

<table class="table table-striped">
    <thead>
        <th scope="col">Nombre</th>
    </thead>
    <tbody>
        <form action="eventos.php">
            <input type="hidden" name="templateID" value="ViewSingleEvent">
            <?php
                $eventsDAO = new EventDAO();
                $results = $eventsDAO->getAll();
        
                foreach ($results as $row):
            ?>
                <tr scope="row">
                    <td class="text-nowrap">
                        <button type="submit" class="btn btn-link text-decoration-none text-primary" name="eventID" value="<?=$row['id']?>">
                            <?=$row['nombre']?>
                        </button>    
                    </td>
                </tr>
            <?php
                endforeach
            ?>
        </form>
    </tbody>
</table>
<?php else: ?>

<div class="alert alert-warning">
    No tiene permisos para acceder a esta página
</div>

<?php endif; ?>