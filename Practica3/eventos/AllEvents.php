<?php
    require_once dirname(__DIR__).'\includes\config.php';

    use es\ucm\fdi\aw\Role as Role;
    use es\ucm\fdi\aw\UserRolesDAO as UserRolesDAO;

    $defaultRole = Role::getDefaultRole();

    if ($defaultRole->getPrivileges()->hasPrivilege('events.all_events.read')):
?>

<p class="h2">Eventos</p>
<br>

<?php
    $userRolesDAO = new UserRolesDAO();
    $results = $userRolesDAO->getAll();

    var_dump($results);
?>

<?php else: ?>

<div class="alert alert-warning">
    No tiene permisos para acceder a esta página
</div>

<?php endif; ?>