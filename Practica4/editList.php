<?php
require_once 'includes/config.php';
use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DAO\WishListDAO;
use es\ucm\fdi\aw\DTO\WishListDTO;
use es\ucm\fdi\aw\DAO\WishListsUsersDAO;
use es\ucm\fdi\aw\DAO\DesiredProductsDAO;
use es\ucm\fdi\aw\DTO\DesiredProductsDTO;
use es\ucm\fdi\aw\DTO\WishListsUsersDTO;
$my_array = array();

$product = new ProductDAO;
$wishListDAO=new WishListDAO;
$listasUsuario=new WishListsUsersDAO;
$arrayProds=new DesiredProductsDAO;
$uID = $_SESSION["user"]->getID();
$my_array= $listasUsuario->getUserLists($uID);

$data = $_REQUEST;
$name= $data['listName'];

if (!empty($data['listID']))
    $listIDtoDel= $data['listID'];

$listas = $wishListDAO->read();
$pos = count($listas);
$listID = $listas[$pos-1]->getID()+1;
//create funciona
if($data['op']==0) {
    $listDTO = new WishListDTO($listID,$name,1);
    //tenemos que añadirlo a las listas
    $wishListDAO->create($listDTO);
    //añadimos a las listas del usuario
    $listUser = new WishListsUsersDTO($listID,$uID);
    $listasUsuario->create($listUser);
    $response = array('success' => true, 'pos' => $listas[$pos-1]->getID());
    echo json_encode($response);
}
//update
else if($data['op']==1) {
   
    $l = $wishListDAO->read($listIDtoDel)[0];
    $l->setName($name);
    $wishListDAO->update($l);
    $response = array('success' => true, 'pos' => $listas[$pos-1]->getID());
    echo json_encode($response);
}
//delete
else if($data['op']==2) {
    //Tenemos que eliminar la lista del usuario
    $listasUsuario->deleteList($listIDtoDel,$uID);

    //tenemos que eliminar la lista de la bd
    $wishListDAO->deleteList($listIDtoDel);
    $response = array('success' => true, 'pos' => $listas[0]->getID());
    echo json_encode($response);
}
?>

