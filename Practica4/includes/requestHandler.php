<?php

require_once 'config.php';

use es\ucm\fdi\aw\Application;

$data = $_REQUEST;

if (!isset($data['action']))
    return;

$action = $data['action'];
$application = Application::getInstance();
$jsonResult = '';

switch ($action) {
    case 'read_session': {
            //  Muy malo que se pase toda la sesión pero como no pusisteis gestión de roles en el usuario, es lo que hay chabules :P
            $jsonResult = json_encode($_SESSION);
        }
        break;
    case 'read_product': {
            $filters = array();

            if (isset($data['filters']))
                $filters = $data['filters'];

            $productsResults = $application->readProducts($filters);
            $jsonResult = json_encode($productsResults);
        }
        break;
    default:
        break;
}
?>

<?= $jsonResult ?>