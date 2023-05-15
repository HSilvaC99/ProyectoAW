<?php

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;

require_once 'includes/config.php';
$title = 'Carrito';

ob_start();

$prodDAO = new ProductDAO;
$usersDAO = new UserProductDAO;
$productsPath = 'images/products/';
$subtotal = 0;
$my_array = array();
$_SESSION["SELECCION_CESTA"] =  array();
if (isset($_SESSION["user"])) {
    $uID = $_SESSION["user"]->getID();
    $my_array = $usersDAO->getUserCart($uID);
} else if (!empty($_SESSION["carritoTemporal"])) { //Hay que crear el carrito a corde al usuario sin registrar
    $uID = -1;
    $my_array = $_SESSION["carritoTemporal"];
}
?>
<div class="container text-center shadow p-4" id="containter" style="display: none;">
  <div class="alert alert-info justify-content-center align-center border" role="alert" id ="cesta-empty" style="display: none;">
    <b></b> Tu cesta de la compra esta vacía.
  </div>
</div> 
<?php if (count($my_array) == 0): ?>
  <div class="container text-center shadow p-4" id="containter">
    <div class="alert alert-info justify-content-center align-center border" role="alert" id ="cesta-empty">
      <b></b> Tu cesta de la compra esta vacía.
    </div>
  </div>
  
<?php else: ?> 
    <div class="container text-center shadow p-4 " id="main">
    <h1 class="text-start " id="cesta">Cesta</h1>
    <?php if ($uID!= -1): ?>
        <div class="justify-content-start d-flex">
        <a href="#" id="anular-seleccion" style="display:none;" class="align-start" onclick="deselectPurchase()">Anular la selección de todos los artículos</a> <!--Se muestra cuando estan todos seleccionados-->
        <a href="#" id="no-seleccionado" class=" text-start" onclick="selectPurchase()">No se han seleccionado artículos. Seleccionar todos los artículos</a> <!--Se muestra cuando no hay ninguno seleccionado-->
        <a href="#" id="seleccionar-todos" style="display:none;" class="align-start" onclick="selectPurchase()">Seleccionar todos los artículos</a> <!--Se muestra cuando hay uno seleccionado-->
        </div>
    <?php endif;?>
    <h6 class="text-end me-4 " id="px">Precio</h6>
    <div class="row " id = "filas">
      <hr class="border border-dark border-opacity-25 "> 
     
        <?php
        $val = 0;
        $cantidad = 0;
        foreach ($my_array as $prod) :
          $producto = $prodDAO->read($prod->getID2())[0];
          if ($prod->getID1() == $uID) :
            $subtotal = $subtotal + ($producto->getOfferPrice() * $prod->getAmount());
            $cantidad = $cantidad +  $prod->getAmount();
            $url = "product.php?productID=" . $producto->getID();
        ?>
            <div class = "row" id = "prod-<?=$producto->getID()?>">
            <?php if ($uID!= -1): ?>
              <div class="form-check col-md-1  justify-content-center d-flex mt-5 mb-5 ">
                <input onclick="selectOneForPurchase(<?= $producto->getID() ?>)" type="checkbox" class="form-check-input mt-4 " id="check-<?= $producto->getID() ?>" style="border: 2px solid black;" >
              </div>
              <?php endif;?>
              <div class = " col-md-2  " >
                <div class="img-fluid " id="product-img" style="width: 160px; height: 160px;"><a href="<?php echo $url; ?>"><img class="img-fluid mt-2" src="<?= $productsPath . $producto->getImgName(); ?>"></a></div>
              </div>
              <!----------------Contendio del producto------------------->
              <div class = "order col-md-8 ">
                <div class = "row">
                  <div class="col-md-12 justify-content-start d-flex a-truncate-cut fw-bold" aria-hidden="true" style="height: 2.6em;" >
                    <a href="<?php echo $url; ?>" style=" text-decoration: none; color: black;">
                      <span><?= $producto->getName() ?></span>
                    </a>
                  </div>
                  <div class="col-md-12 justify-content-start d-flex">
                      <span class="text-success">En stock</span>
                  </div>
                  <div class="col-md-12 justify-content-start d-flex">
                    <span class="a-size-small a-color-secondary sc-product-sss">    <b>Envío GRATIS</b> disponible</span>
                  </div>
                  <div class = "col-md-12 justify-content-start d-flex">
                    <ul class="nav justify-content-center p-0 ">
                      <span class="mt-2">Cantidad: </span>
                      <li class="nav-link px-3">
                        
                        <input type="number" min="0" class="text-center shadow rounded-3" name="amount" value="<?= $prod->getAmount() ?>" style="width:50px; height:37px;" id="amount-<?= $producto->getID() ?>" onchange="actualizarTabla(<?= $prod->getID2() ?>)" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                        
                      </li>
                      <span class="mt-2 opacity-50">| </span>
                      <li class="nav-link px-4">
                        <button type="submit" class="btn btn-danger" onclick="deleteProduct(<?= $producto->getID() ?>)">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                          </svg>
                        </button>
                        
                      </li>
                      <span class="mt-2 opacity-50">| </span>
                      <li class="nav-link px-4">
                      <span>Lista de deseos</span>
                      </li>
                        <span class="mt-2 opacity-50">| </span>
                      <li class="nav-link px-4">
                        <span>Ver otros productos como este</span>
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </div>
              <!----------------------------------->
              <div class="col-md-1 fw-bold">
                <span id="price-<?= $producto->getID() ?>" ><?= number_format($producto->getOfferPrice() * $prod->getAmount(), 2) ?> €</span>
                <span id="price-unity-<?= $producto->getID() ?>" style="display:none "><?= $producto->getOfferPrice() ?></span> 
              </div>
             
              <hr class="border border-dark border-opacity-25 "> 
              </div>
          <?php $val++;
          endif;
          ?>
          <!-- Botón para abrir el modal -->
          <button style="display: none;" id = "button-<?= $producto->getID() ?>" type="button" class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#confirm-dialog-<?= $producto->getID() ?>">Eliminar producto</button>

          <!-- Modal -->
          <div class="modal fade" id="confirm-dialog-<?= $producto->getID() ?>" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title">Confirmar acción</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-button" onclick="closeModal(<?= $producto->getID() ?>)"></button>
                </div>
                <div class="modal-body">
                  <p>¿Deseas realmente eliminar este producto de la cesta?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="confirm-cancel" onclick="closeModal(<?= $producto->getID() ?>)">Cancelar</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="confirm-ok" onclick="deleteProduct(<?= $producto->getID() ?>)">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
          <?php
        endforeach; ?>
    <div class = "row ">
        <div class="col-md-11  mt-1 mb-3 fw-bold justify-content-end d-flex ">
        <?php if($cantidad == 1): ?>
          <span id="amountOneVal" style="font-weight: normal;">Subtotal (<span id="amountProduct"><?= $cantidad ?></span> producto): </span> 
          <span id="amountVal" style="font-weight: normal; display: none;">Subtotal (<span id="amountProducts"><?= $cantidad ?></span> productos): </span>
        <?php elseif ($cantidad > 1): ?>
          <span id="amountOneVal" style="font-weight: normal; display: none;">Subtotal (<span id="amountProduct"><?= $cantidad ?></span> producto): </span> 
          <span id="amountVal" style="font-weight: normal;">Subtotal (<span id="amountProducts"><?= $cantidad ?></span> productos): </span>
        <?php endif;?>

        </div>
        <div class="col-md-1 mt-1 mb-3  fw-bold justify-content-center d-flex ">
          <span id="subtotal"> <?= number_format($subtotal,2) ?> €</span> 
        </div>

    </div>
    <div class="text-end">
      <a class="btn btn-primary ms-4" id="buy-now" href="purchase.php?subtotal=<?= $subtotal ?>" onclick="verifyPurchase(<?= $uID ?>, <?= $subtotal ?>, event)">Comprar elementos seleccionados</a>
      <span id="sesion" style="display:none "><?= count($_SESSION["SELECCION_CESTA"]) ?></span> 
    </div>
  
  <script defer src="js/updateCart.js"></script>
  <script defer src="js/selectProd.js"></script>
  <script defer src="js/purchase.js"></script>

<?php endif;

$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>

<style>
  #buy-now {
    font-size: 24px;
    padding: 12px 24px;
  }
</style>
