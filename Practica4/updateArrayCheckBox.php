<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DAO\ProductDAO;

$userProductDAO = new UserProductDAO;
$productDAO = new ProductDAO;

$data = $_REQUEST;
// Comprueba que se recibieron los parámetros correctos


// Actualiza la cantidad del producto en el carrito
$uID = isset($_SESSION["user"]) ? $_SESSION["user"]->getID() : -1;
$check = $data['check'];

// Si la actualización fue exitosa, calcula el nuevo subtotal y envía una respuesta JSON
$my_array = isset($_SESSION["user"]) ? $userProductDAO->getUserCart($uID) : $_SESSION["carritoTemporal"];

//Solo 1 elemento
if ($data['option'] == 1){
    foreach($my_array as $prod){
        if($prod->getID2() == $data['product_id'] ){
            if ($check){
                
                if (!empty($_SESSION["SELECCION_CESTA"] )){
                    $index = count($_SESSION["SELECCION_CESTA"] );
                    $_SESSION["SELECCION_CESTA"] [$index] = $prod;
                    
                }else
                    $_SESSION["SELECCION_CESTA"] [0] = $prod;

            }else{
                
                $clave = array_search($prod,$my_array); // Encontrar la clave del valor
                if ($clave !== false)
                    unset($_SESSION["SELECCION_CESTA"][$clave]); // Eliminar la clave del array
                break;
            }
        }
    }
}else if ($data['option'] == 2){ //Seleccionamos todos
    $_SESSION["SELECCION_CESTA"] = $my_array;
}else{ //Vaciamos todos
    unset($_SESSION["SELECCION_CESTA"]);
}

$count = 0;
if (!empty($_SESSION["SELECCION_CESTA"]))
    $count = count($_SESSION["SELECCION_CESTA"]);

$response = array('success' => true, 'quantity'=> $count);
echo json_encode($response);


?>

