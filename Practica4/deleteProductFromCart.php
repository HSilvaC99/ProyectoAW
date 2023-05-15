<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DAO\ProductDAO;

$userProductDAO = new UserProductDAO;
$productDAO = new ProductDAO;

$data = $_REQUEST;
// Comprueba que se recibieron los parámetros correctos
if (!isset($data['product_id'])) {

    exit;
}

// Actualiza la cantidad del producto en el carrito
$uID = isset($_SESSION["user"]) ? $_SESSION["user"]->getID() : -1;

$productID = $data['product_id'];
$resta = 0;
$cart = new UserProductDAO();
$result = false;

if ( isset($_SESSION['user'])){
    $result = $cart->deleteProduct($uID, $productID);
}else{
    $i=0;
    $clave=0;
    foreach($_SESSION["carritoTemporal"] as $prod){
        if ($prod->getID2() == $productID)
            $clave = $i;
        
        $i++;
    }
    unset($_SESSION["carritoTemporal"][$clave]);
    $_SESSION["carritoTemporal"] = array_values($_SESSION["carritoTemporal"]);
    $result = true;
}

$my_array = isset($_SESSION["user"]) ? $userProductDAO->getUserCart($uID) : $_SESSION["carritoTemporal"];
$encontrado = false;
$subtotal = 0;
$cantidad = 0;
foreach ($my_array as $prod) {
    $producto = $productDAO->read($prod->getID2())[0];
    $subtotal += $producto->getOfferPrice() * $prod->getAmount();
    $cantidad += $prod->getAmount();
}

$response = array('success' => true, 'subtotal' => $subtotal, 'amount'=>$cantidad);
echo json_encode($response);

    


?>

