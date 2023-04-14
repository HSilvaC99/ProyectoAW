<?php

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UsersProductsDAO;
use es\ucm\fdi\aw\DAO\UserDAO;

require_once 'includes/config.php';
$title = 'Carrito';

ob_start();

$prodDAO = new ProductDAO;
$usersDAO = new UsersProductsDAO;
$productsPath = 'images/products/';
$subtotal = 0;
$userCart = array();
if (isset($_SESSION["user"])) {
    $uID = $_SESSION["user"]->getID();
    $userCart = $usersDAO->getUserCart($uID);
} else if (!empty($_SESSION["carritoTemporal"])) { //Hay que crear el carrito a corde al usuario sin registrar
    $uID = -1;
    $userCart = $_SESSION["carritoTemporal"];
}
if (count($userCart) == 0) { ?>
    <div class="container text-center shadow p-4">
        <div class="alert alert-danger justify-content-center align-center border" role="alert">
            <b></b> Tu cesta de la compra esta vacía!!
        </div>
    </div>
<?php
} else {
?> <div class="container text-center shadow p-4">
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
                foreach ($userCart as $prod) :
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
                                <td><a href="<?= $url; ?>">
                                        <p class="mt-3"><?= $producto->getName() ?></p>
                                    </a></td>
                                <td><input type="number" min="1" class="text-center" name="amount" value="<?= $prod->getAmount() ?>" style="width:50px; height:30px;" id="amount-<?= $producto->getID() ?>" onchange="actualizarTabla(<?= $prod->getID2() ?>)"></td>
                                <td>
                                    <p class="mt-3" id="price-<?= $producto->getID() ?>"><?= $producto->getOfferPrice() * $prod->getAmount() ?></p>
                                </td>
                                <p id="price-unity-<?= $producto->getID() ?>" style="display:none"><?= $producto->getOfferPrice() ?></p>

                                <td>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#product-modal-<?= $producto->getID(); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                        </svg>
                                    </button>
                                    <div class="modal fade" id="product-modal-<?= $producto->getID(); ?>" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal-title">Confirmar acción</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Deseas realmente eliminar este producto?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</a>
                                                    <a class="btn btn-danger" href="shopping-cart.php?productID=<?= $producto->getID() ?>">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                    <?php $val++;
                    endif;
                endforeach; ?>

                        </tbody>

            </table>
        </div>
        <h4 class="mt-4 mb-4 fw-bold justify-content-end d-flex">Subtotal: <span id="subtotal"> <?= $subtotal ?> </span> €</h4>
    </div>
    <script>
        function actualizarTabla(productID) {
            // Obtener la cantidad de productos del input
            const cantidad = parseInt(document.getElementById(`amount-${productID}`).value);
            console.log(cantidad)
            // Calcular el nuevo precio para el producto
            const PxU = parseFloat(document.getElementById(`price-unity-${productID}`).textContent);
            console.log(PxU)
            const nuevoPrecio = cantidad * PxU;
            console.log(nuevoPrecio)

            // Actualizar el texto dentro del <td> que contiene el precio
            document.getElementById(`price-${productID}`).textContent = nuevoPrecio.toFixed(2);

            // Calcular el subtotal de la tabla sumando los precios de todos los productos
            let subtotal = 0;
            document.querySelectorAll('table tbody tr').forEach(row => {
                const precioPorUnidad = parseFloat(row.querySelector('td:nth-child(5) p').textContent);
                subtotal += precioPorUnidad;
            });
            console.log(subtotal)
            // Actualizar el texto dentro del <p> que contiene el subtotal
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
        }
    </script>
<?php } ?>

<?php


$content = ob_get_clean();


require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>