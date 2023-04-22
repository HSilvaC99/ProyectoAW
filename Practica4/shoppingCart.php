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
if (isset($_SESSION["user"])) {
  $uID = $_SESSION["user"]->getID();
  $my_array = $usersDAO->getUserCart($uID);
} else if (!empty($_SESSION["carritoTemporal"])) { //Hay que crear el carrito a corde al usuario sin registrar
  $uID = -1;
  $my_array = $_SESSION["carritoTemporal"];
}
if (count($my_array) == 0): ?>
  <div class="container text-center shadow p-4">
    <div class="alert alert-danger justify-content-center align-center border" role="alert">
      <b></b> Tu cesta de la compra esta vacía!!
    </div>
  </div>
<?php else: ?> <div class="container text-center shadow p-4">
    <h1 class="mb-4">Que hay en mi cesta?</h1>
    <div class="container text-center shadow p-4 d-flex justify-content-center align-items-center">
      <table style="width:100%">
        <thead class="bg-info-subtle">
          <tr>
            <th scope="col">#</th>
            <th scope="col"></th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col"></th>
          </tr>
        </thead>

        <?php
        $val = 0;
        foreach ($my_array as $prod) :
          if ($prod->getID1() == $uID) :
            $producto = $prodDAO->read($prod->getID2())[0];
            $subtotal = $subtotal + ($producto->getOfferPrice() * $prod->getAmount());
            $url = "product.php?productID=" . $producto->getID();
        ?>
            <tbody>
              <tr>
                <th scope="row"><?= $val ?></th>
                <td>
                  <div class="d-flex justify-content-end">
                    <div class="img-fluid" id="product-img" style="width: 80px; height: 60px;"><a href="<?php echo $url; ?>"><img class="img-fluid mt-2" src="<?= $productsPath . $producto->getImgName(); ?>"></a></div>
                  </div>
                </td>
                <td><a href="<?php echo $url; ?>">
                    <p class="mt-3"><?= $producto->getName() ?></p>
                  </a></td>
                <td><input type="number" min="1" class="text-center" name="amount" value="<?= $prod->getAmount() ?>" style="width:50px; height:30px;" id="amount-<?= $producto->getID() ?>" onchange="actualizarTabla(<?= $prod->getID2() ?>)"></td>
                <td>
                  <p class="mt-3" id="price-<?= $producto->getID() ?>"><?= $producto->getOfferPrice() * $prod->getAmount() ?></p>
                </td>
                <p id="price-unity-<?= $producto->getID() ?>" style="display:none"><?= $producto->getOfferPrice() ?></p>

                <td>
                  <?= ($delete =  new es\ucm\fdi\aw\forms\DeleteProductFromCartForm($producto->getID()))->handleForm(); ?>
                </td>

              </tr>
          <?php $val++;
          endif;
        endforeach; ?>

            </tbody>

      </table>
    </div>
    <hr class="border border-dark border-2 opacity-25 mt-4"> 
    <div class = "row">
      <div class="col-md-6 mt-4 mb-4 fw-bold justify-content-start d-flex ">
        <a class="btn btn-primary " id="buy-now" href="purchase.php?productID=<?= $productID ?>">Comprar elementos del carrito</a>

      </div>
      <h4 class="col-md-6 mt-4 mb-4 fw-bold justify-content-end d-flex ">Subtotal: <span id="subtotal"> <?= $subtotal ?> </span> €</h4>

    </div>
  </div>
  
  <script defer src="js/updateCart.js"></script>

<?php endif;

$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>