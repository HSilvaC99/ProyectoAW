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

$listID = $data['listID'];
$productID = $data['product_id'];


//eliminamos
$arrayProds->deleteProdListProds($listID,$productID);


$response = array('success' => true);
echo json_encode($response);
?>

