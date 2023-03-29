<?php
    require_once dirname(__DIR__).'/includes/config.php';

    use \es\ucm\fdi\aw\src\Role as Role;

    $role = Role::getCurrentUsersRole();

    if ($role->getPrivileges()->hasPrivilege('events.my_events.read')):
?>

<p class="h2">Mis eventos</p>
<br>

<?php else: ?>

<div class="alert alert-warning">
    Debes estar registrado para ver esta página
</div>

<?php endif; ?>