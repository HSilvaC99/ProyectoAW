<?php

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DAO\WishListDAO;
use es\ucm\fdi\aw\DAO\WishListsUsersDAO;
use es\ucm\fdi\aw\DAO\DesiredProductsDAO;

require_once 'includes/config.php';
$title = 'Lista Deseos';
$productsPath = 'images/products/';
$my_array = array();

$product = new ProductDAO();
$wishListDAO=new WishListDAO;
$listasUsuario=new WishListsUsersDAO;
$arrayProds=new DesiredProductsDAO;
$uID = $_SESSION["user"]->getID();
$my_array= $listasUsuario->getUserLists($uID);
if(!isset($_GET["listID"])){
    $listaPred = $my_array[0]->getListID();
   
}else{
    $listaPred = $_GET["listID"];
}
foreach($my_array as $listas){
     $wishListDTO = $wishListDAO->read($listas->getListID())[0];
    if ($wishListDTO->getID() == $listaPred){
        $nombreLista = $wishListDAO->getListName( $listaPred);
    }
}


if (!isset($_SESSION['user'])){ ?>

    <body>
    <div class="container">
    <div class="flex-fill p-3">
      <div class="alert alert-warning">
        Debes identificarte para acceder a esta página.
      </div></div></div>
    </body>
        
    <?php
} else {
ob_start();
?>

<div class="container text-center shadow p-4 " id="main">
    <div class="row border-bottom border-2 border-primary">
        <div class="col-md-6 ">
            <h1 class="text-start" id="listas">Tus listas</h1>
        </div>
        <div class="col-md-6 text-end mt-3 " >
            <a onmouseover="blueColor()"  onmouseout="blackColorCL()"  id="crear-lista" href="#" data-bs-toggle="modal" data-bs-target="#myModal" style="text-decoration: none; color: black;">Crear lista | </a>
            <a onmouseover="greenColorList()" onmouseout="blackColorCL()" id="edit-lista" href="#" data-bs-toggle="modal" data-bs-target="#myModalEdit" style="text-decoration: none; color: black;">Editar lista | </a>
            <a onmouseover="redColorList()" onmouseout="blackColorCL()" id="delete-lista" href="#" data-bs-toggle="modal" data-bs-target="#myModalDelet" style="text-decoration: none; color: black;">Eliminar lista</a>
        </div>
        <!-- MODAAAL-->
        <!-- Modal editar-->
        <div class="modal fade" id="myModalEdit" tabindex="-1" aria-labelledby="myModalLabelEdit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabelEdit">Editar lista</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="list-name" class="form-label">Nombre de la lista</label>
                            <input type="text" class="form-control" id="list-name-to-edit" value='<?=$nombreLista?>'>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="crearListaBtn" data-bs-dismiss="modal" onclick="createList(1,'<?=$nombreLista?>',<?=$listaPred?>)"  class="btn btn-primary">Editar lista</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal borrar-->
        <div class="modal fade" id="myModalDelet" tabindex="-1" aria-labelledby="myModalLabelDel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabelDel">Eliminar la lista</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Deseas realmente eliminar la lista: <?=$nombreLista?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="deletListaBtn" data-bs-dismiss="modal" onclick="createList(2,'<?=$nombreLista?>',<?=$listaPred?>)" class="btn btn-danger">Eliminar lista</button>
                    </div>
                </div>
            </div>
        </div>
       <!-- Modal crear-->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Crear una nueva lista</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="list-name" class="form-label">Nombre de la lista</label>
                            <input type="text" class="form-control" id="list-name">
                        </div>
                        <div class="alert alert-info" role="alert">
                            Usa las listas para guardar artículos que quieras comprar más adelante. Todas las listas son privadas, a menos que las compartas con otros usuarios.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="crearListaBtn" data-bs-dismiss="modal" onclick="createList(0)"  class="btn btn-primary">Crear lista</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row " id = "filas">
        <div class="col-md-3 border">
        
        <?php
        $cont = 0;
        foreach($my_array as $listas){
            
            $wishListDTO = $wishListDAO->read($listas->getListID())[0];
            //<hr class="border border-dark border-opacity-25 "> 
            $tipo = $wishListDTO->getType()==1 ?  "Privada" : "Publica";

            if (!isset($_GET["listID"]) && $cont == 0){
                $listaPred = $listas->getListID();
            
                ?>
                <div id="lista-<?= $listas->getListID() ?>" class="mt-3 d-flex " style=" justify-content: space-between; background-color: #e6f2f5; height: 60px;" onmouseover="redColor(<?= $listas->getListID() ?>)"  onmouseout="blackColor(<?= $listas->getListID() ?>)">
                    <a href="wishList.php?listID=<?= $listas->getListID()?>" class="ms-3 mt-2" style="text-decoration: none; color: black;" ><span style="text-align: left; font-size: 25px;" id="link-<?= $listas->getListID() ?>"><?= $wishListDTO->getName() ?></span></a>
                    <span class="me-3 mt-3" style="text-align: right;" id="link-tipo-<?= $listas->getListID() ?>"><?= $tipo?></span>
                </div>
                <?php
            }else{
                if(isset($_GET["listID"]))
                    $listaPred = $_GET["listID"];
                
                ?>
                <div id="lista-<?= $listas->getListID() ?>" class="mt-3 d-flex " style=" justify-content: space-between;  height: 60px;" onmouseover="redColor(<?= $listas->getListID() ?>)"  onmouseout="blackColor(<?= $listas->getListID() ?>)">
                    <a href="wishList.php?listID=<?= $listas->getListID() ?>" class="ms-3 mt-2" style="text-decoration: none; color: black;"><span style="text-align: left; font-size: 25px;" id="link-<?= $listas->getListID() ?>"><?= $wishListDTO->getName() ?></span></a>
                    <span class="me-3 mt-3" style="text-align: right;" id="link-tipo-<?= $listas->getListID() ?>"><?= $tipo?></span>
                </div>
                <?php
            }
            $cont++;
        }?>
        </div>
        <div class="col-md-9 border">  
            <span id="id-lista-<?= $listaPred ?>" style="display:none;" ><?=$listaPred  ?></span>
            <!------>
            
            <?php
                //Aqui es donde obtenemos la unica lista que mostraremos
                $arrayProdsDTO=$arrayProds->getListProds($listaPred);
                foreach($arrayProdsDTO as $prod){
                    $producto=$product->read($prod->getProductID())[0];
                    $url = "product.php?productID=" . $producto->getID();
                    ?>
                    <div id="eliminado" class="row mt-4 justify-content-start d-flex " style="display:none;">
                        <hr class="border border-dark border-opacity-25 shadow mb-1" id="h1" style="display:none;"> 
                        <div class="col-md-12 justify-content-start d-flex " id="p" style="display:none;">
                            <span  style="display:none;" id="producto-eliminado"></span>
                        </div>
                        <div class="col-md-4 me-5 justify-content-start d-flex " id="p1" style="display:none;">
                            <span style="color:green ">
                                <i class="fas fa-check-circle text-success rounded-circle me-2" id="icon" style="display:none;"></i>
                                <span style="display:none;" id="elim">Eliminado | </span>
                                <a onclick= " undo(<?= $listaPred ?>,<?=$producto->getID() ?>,<?=$prod->getDate() ?>)" href="" style="display:none; "class="text-decoration-none" id="des">Deshacer</a>
                            </span>
                        </div>
                        <hr class="border border-dark border-opacity-25 shadow " id="h2" style="display:none;"> 
                    </div>
                    <span style = "display:none;" id="eliminado<?=$producto->getID() ?>"> <?= $producto->getName() ?></span>
                    <div class = "row mt-4 " id = "prod-<?=$producto->getID()?>">
                   
                        <div class = " col-md-2 border" >
                            <div class="img-fluid " id="product-img" style="width: 160px; height: 160px;"><a href="<?php echo $url; ?>"><img class="img-fluid mt-2" src="<?= $productsPath . $producto->getImgName(); ?>"></a></div>
                        </div>
                        
                        <div class = "order col-md-6 border border-secondary">
                            <div class = "row">
                                <div class="col-md-12 justify-content-start d-flex a-truncate-cut fw-bold" aria-hidden="true" style="height: 2.6em;" >
                                    <a href="<?php echo $url; ?>" style=" text-decoration: none; color: black;">
                                        <span style="font-size: 20px;"><?= $producto->getName() ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class = "order col-md-4 border border-secondary">
                            <?php
                                setlocale(LC_TIME, "es_ES.utf8"); // Establecer el locale en español
                                $fecha = "2023-05-10 17:34:03";
                                $fecha_formateada = strftime("%d de %B de %Y", strtotime($prod->getDate()));
                                $mes_formateado = strtolower(strftime("%B", strtotime($prod->getDate())));
                                
                            ?>
                            <span>Articulo añadido el <?= $fecha_formateada?></span>
                            <div class="row">
                                <?= ($AddProdToCartFromWishForm = new es\ucm\fdi\aw\forms\AddProdToCartFromWishForm($_SESSION["user"]->getID(), $producto->getID(),$listaPred))->handleForm(); ?>
                                <div id="confirmation-message-<?= $producto->getID() ?>"></div>

                                <div class="dropdown  col-md-6 mt-2">
                                    <button class="btn btn-outline-secondary rounded-pill shadow border dropdown-toggle  w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="mover-<?=$producto->getID()?>">
                                        Mover
                                    </button>
                                        <ul class="dropdown-menu">
                                        <?php
                                            foreach($my_array as $listas) : ?>
                                                <?php $wishListDTO = $wishListDAO->read($listas->getListID())[0];
                                                if ($wishListDTO->getID() != $listaPred): 
                                                ?>
                                                <li><span class="dropdown-item" style="text-align: left;" id="mover-<?=$producto->getID() ?>" onclick="moveToSelectedList(<?=$wishListDTO->getID() ?>, <?=$listaPred ?>,<?=$producto->getID()?>)"><?= $wishListDTO->getName() ?></span></li>
                                               
                                            <?php endif; endforeach ?>
                                        </ul>
                                </div>
                                <div class="col-md-6  mt-2">
                                    <a class="btn btn-outline-secondary rounded-pill shadow col-md-6 border w-100" id="delete-<?=$producto->getID()?>" onclick="deleteProdList(<?=$producto->getID()?>, <?=$listaPred ?>,'<?=$producto->getName() ?>')">Eliminar</a>

                                </div>
                            </div>
                            <!--<a class="btn btn-outline-secondary ms-4 mt-3 rounded-pill shadow" id="mover-<?=$producto->getID()?>" >Mover</a>-->
                        </div>
                    </div>
                    <hr class="border border-dark border-opacity-25 shadow" > 
                    <?php
                }
            ?>
            
        </div>
    </div>
</div>
<?php
}
$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>

<script src="js/wishList.js"></script>