<p class="h4">Eventos disponibles</p>
<hr>

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
    
    $eventsDAO = new EventDAO($connection);
    $availableEvents = $eventsDAO->getAll();

    if (count($availableEvents) == 0) {
        echo <<<EOS
        <div class="alert alert-info">
            No hay eventos disponibles por el momento.
        </div>
        EOS;

        goto end;
    }

    end:
?>

<?php
    if (count($availableEvents) > 0):
?>

<table class="table table-striped">
    <thead>
        <th scope="col">Nombre</th>
    </thead>
    <tbody>
        <form action="eventos.php">
            <input type="hidden" name="subpage" value="event_template">
            <?php
                foreach ($availableEvents as $row):
            ?>
                <tr scope="row">
                    <td class="text-nowrap">
                        <button type="submit" class="btn btn-link text-decoration-none text-primary" name="event_id" value="<?=$row['id']?>">
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

<?php
    endif
?>