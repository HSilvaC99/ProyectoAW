<?php
    require_once 'includes/src/role.php';
    require_once 'includes/src/privileges.php';

    $defaultRole = Role::getDefaultRole();

    if ($defaultRole->getPrivileges()->hasPrivilege('events.my_team.read')):
?>

<p class="h2">Mi equipo</p>
<br>

<?php else: ?>

<div class="alert alert-warning">
    Debes estar registrado para ver esta página
</div>

<?php endif; ?>