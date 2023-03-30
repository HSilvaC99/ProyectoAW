<?php
require_once dirname(__DIR__) . '/includes/config.php';

use \es\ucm\fdi\aw\src\DAO\EventDAO as EventDAO;
use \es\ucm\fdi\aw\src\DAO\EventUsersDAO as EventUsersDAO;

if (!isset($_GET['eventID'])) {
	goto no_event_id;
}

$eventID = $_GET['eventID'];

$eventDAO = new EventDAO();
$result = $eventDAO->get('id', $eventID);

if (!$result) {
	goto no_event_result;
}

$result = $result[0];
?>

<h2 class="h2"><?= $result['name'] ?></h2>
<p>
	<?= $result['description'] ?>
</p>
<h3 class="h3">Roles ocupados</h3>

<h3 class="h3">Jugadores</h3>
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
			foreach ($results as $result) :
		?>
			<tr>
				<td class="text-nowrap"><?= $result['name'] ?></td>
				<td class="text-nowrap"><?= ($result['team'] ?? 'Ninguno') ?></td>
				<td class="text-nowrap"><?= $result['event_role'] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<h3 class="h3">Acciones</h3>
<form action="events.php">
	<input type="hidden" name="templateID" value="MyEvents">
	<input type="hidden" name="action" value="join">
	<div class="col">
		<div class="form-group">
			<label for="eventRole">Rol</label>
			<select class="form-select" id="eventRole" aria-label="Event role" name="event_role">
				<option value="fusilero" selected>Fusilero</option>
				<option value="tirador_selecto">Tirador selecto</option>
				<option value="apoyo">Apoyo</option>
				<option value="francotirador">Francotirador</option>
			</select>
		</div>
	</div>
	<br>
	<button type="submit" class="btn btn-primary" name="eventID" value="<?= $row['id'] ?>">
		Apuntar
	</button>
</form>
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