<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DAO\ProductDAO;

$userProductDAO = new UserProductDAO;
$productDAO = new ProductDAO;

$data = $_REQUEST;
// Comprueba que se recibieron los parámetros correctos
if (!isset($data['product_id']) || !isset($data['amount'])) {

    exit;
}

// Actualiza la cantidad del producto en el carrito
$uID = isset($_SESSION["user"]) ? $_SESSION["user"]->getID() : -1;

$productID = $data['product_id'];
$amount = $data['amount'];
$subtotal = 0;
$cantidad = 0;
if ($amount > 0) {
    // Si la actualización fue exitosa, calcula el nuevo subtotal y envía una respuesta JSON
    $my_array = isset($_SESSION["user"]) ? $userProductDAO->getUserCart($uID) : $_SESSION["carritoTemporal"];
    $encontrado = false;
    foreach ($my_array as $prod) {
        $producto = $productDAO->read($prod->getID2())[0];
        if ($prod->getID1() == $uID && $prod->getID2() == $productID) {
            $amount =  $amount;
            $prod->setAmount($amount);
            $userProductDAO->updateWithCompoundKey($prod);
            
        }
        $subtotal += $producto->getOfferPrice() * $prod->getAmount();
        $cantidad += $prod->getAmount();
    }
    $response = array('success' => true, 'subtotal' => $subtotal, 'amount'=>$cantidad);
    echo json_encode($response);
} else {
    // Una pestañita para preguntar si queremos borrar el objeto
    $response = array('success' => true, 'message' => 'La cantidad debe ser mayor que cero');
    echo json_encode($response);
}

?>

