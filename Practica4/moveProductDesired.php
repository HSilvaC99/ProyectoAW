<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DAO\WishListDAO;
use es\ucm\fdi\aw\DAO\WishListsUsersDAO;
use es\ucm\fdi\aw\DAO\DesiredProductsDAO;
use es\ucm\fdi\aw\DTO\DesiredProductsDTO;

$my_array = array();

$product = new ProductDAO();
$wishListDAO=new WishListDAO;
$listasUsuario=new WishListsUsersDAO;
$arrayProds=new DesiredProductsDAO;
$uID = $_SESSION["user"]->getID();
$my_array= $listasUsuario->getUserLists($uID);

$data = $_REQUEST;

$oldListID = $data['oldListID'];
$newListID = $data['newListID'];
$productID = $data['product_id'];

$arrayProdsDTO = $arrayProds->getListProds($newListID);
foreach($arrayProdsDTO as $prod){
    if ($prod->getProductID() == $productID){
        $response = array('error' => 'El producto ya existe en la lista destino', 'success' => false);
        echo json_encode($response);
        return;
    }
}
//eliminamos
$arrayProds->deleteProdListProds($oldListID,$productID);

//añadimos
$date = date("Y-m-d H:i:s");
$prodDTO = new DesiredProductsDTO($newListID,$productID,$date);
$arrayProds->create($prodDTO);


$response = array('success' => true);
echo json_encode($response);
?>

