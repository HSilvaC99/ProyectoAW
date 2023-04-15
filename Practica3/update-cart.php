<?php

use es\ucm\fdi\aw\DAO\UsersProductsDAO;
use es\ucm\fdi\aw\DAO\ProductDAO;

require_once 'includes/config.php';
$usersProductsDAO = new UsersProductsDAO;
$productDAO = new ProductDAO();


// Comprueba que se recibieron los parámetros correctos
if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {

    exit;
}

// Actualiza la cantidad del producto en el carrito
$uID = isset($_SESSION["user"]) ? $_SESSION["user"]->getID() : -1;
$productID = $_POST['product_id'];
$quantity = $_POST['quantity'];
if ($cantidad > 0) {
    // Si la actualización fue exitosa, calcula el nuevo subtotal y envía una respuesta JSON
    $my_array = isset($_SESSION["user"]) ? $usersProductsDAO->getUserCart($uID) : $_SESSION["carritoTemporal"];
    foreach ($my_array as $prod) {
        if ($prod->getID1() == $uID) {
            $producto = $productDAO->read($prod->getID2())[0];
            $subtotal += $producto->getPrice() * $prod->getAmount();
            $amount =  $prodDTO->getAmount() + $cantidad;
            if (isset($_SESSION["user"])){
                $producto->setAmount($amount);
                $usersProductsDAO->updateWithCompoundKey($producto);
            }
        }
    }
    $response = array('success' => true, 'subtotal' => $subtotal);
    echo json_encode($response);
} else {
    // Una pestañita para preguntar si queremos borrar el objeto
    $response = array('success' => false, 'message' => 'La cantidad debe ser mayor que cero');
    echo json_encode($response);
}


$content = ob_get_clean();
require_once 'includes/templates/events_template.php';

?>

