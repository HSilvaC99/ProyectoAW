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
        <div class="col-md-6 ">
            <h5 class="text-end mt-3" id="new-list">Crear lista</h5>
        </div>
    </div>
    <div class="row " id = "filas">
        <div class="col-md-2 border">
        <?php
        $cont=0;
        foreach($my_array as $listas){
            $wishListDTO = $wishListDAO->read($listas->getListID())[0];
            //<hr class="border border-dark border-opacity-25 "> 
            $tipo = $wishListDTO->getType()==1 ?  "Privada" : "Publica";
            if ($cont==0)
                $listaPred = $listas->getListID();
            
            ?>
            <div id="lista-<?= $listas->getListID() ?>" class="mt-3" style="display: flex; justify-content: space-between; background-color: #e6f2f5;">
                <span style="text-align: left;"><?= $wishListDTO->getName() ?></span>
                <span style="text-align: right;"><?= $tipo?></span>
            </div>

            <?php
            $cont++;
        }?>
        </div>
        <div class="col-md-10  border">  
            <span id="id-lista-<?= $listaPred ?>" style="display:none;" ><?=$listaPred  ?></span>
            <?php

                //Aqui es donde obtenemos la unica lista que mostraremos
                $arrayProdsDTO=$arrayProds->getListProds($listaPred);
               foreach($arrayProdsDTO as $prod){
                    $producto=$product->read($prod->getProductID())[0];
                    ?>
                    <div class = "row mt-4 " id = "prod-<?=$producto->getID()?>">
                         
                        <div class = " col-md-2 border" >
                            <div class="img-fluid " id="product-img" style="width: 160px; height: 160px;"><a href="<?php echo $url; ?>"><img class="img-fluid mt-2" src="<?= $productsPath . $producto->getImgName(); ?>"></a></div>
                        </div>
                        <div class = "order col-md-6 border border-secondary">
                            <div class = "row">
                                <div class="col-md-12 justify-content-start d-flex a-truncate-cut fw-bold" aria-hidden="true" style="height: 2.6em;" >
                                    <a href="<?php echo $url; ?>" style=" text-decoration: none; color: black;">
                                    <span><?= $producto->getName() ?></span>
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
                            <a class="btn btn-warning ms-4 mt-3 rounded-pill " id="add-to-cart-<?=$producto->getID()?>" >Añadir a la cesta</a>
                            <a class="btn btn-outline-secondary ms-4 mt-3 rounded-pill shadow" id="delete-<?=$producto->getID()?>" >Eliminar</a>
                            <a class="btn btn-outline-secondary ms-4 mt-3 rounded-pill shadow" id="mover-<?=$producto->getID()?>" >Mover</a>
                        </div>
                    </div>
                    <hr class="border border-dark border-opacity-25 shadow"> 
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