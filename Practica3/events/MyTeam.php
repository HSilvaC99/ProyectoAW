<?php
    require_once dirname(__DIR__).'/includes/config.php';

    use \es\ucm\fdi\aw\src\Privileges as Privileges;

    $privileges = Privileges::getCurrentUserPrivileges();

    if ($privileges->hasPrivilege('events.my_team.read')):
?>

<p class="h2">Mi equipo</p>
<br>

<?php else: ?>

<div class="alert alert-warning">
    No tienes privilegios para acceder a esta página
</div>

<?php endif; ?>