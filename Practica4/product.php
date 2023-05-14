<?php

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\ReviewDAO;
use es\ucm\fdi\aw\DAO\UserReviewDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DAO\WishListsUsersDAO;
use es\ucm\fdi\aw\DAO\WishListDAO;

require_once 'includes/config.php';

ob_start();

$productID = $_GET["productID"];

//Products
$productDAO = new ProductDAO;
$user = new UserDAO;
$wishListDAO=new WishListDAO;
$listasUsuario=new WishListsUsersDAO;
$role = "guest";
if (isset($_SESSION["user"])) {
    $arrayOfLists= $listasUsuario->getUserLists($_SESSION["user"]->getID());
    $role = $user->getUserRoles($_SESSION["user"]->getID())[0]->getRoleName();
}

$productDTOResults = $productDAO->read($productID);
$productsPath = 'images/products/';
$error = "";

//User Intermediate
$userReviewDAO = new UserReviewDAO;

//User
$user = new UserDAO;

//Reviews
$reviewDAO = new ReviewDAO;
$reviewDTOResults = $reviewDAO->getProductReviews($productID);

if (isset($_GET["offer"])) {
    if ($_GET["offer"] < 0 || $_GET["offer"] > 100) {
        $title = "Descuento imposible de aplicar";

        $error = <<<HTML_ERROR
            <div class="alert alert-danger m-2 text-center">
                El descuento debe estar en un rango de 0-100
            </div>'; 
            HTML_ERROR;
    } else {
        $offer = $_GET["offer"];
        $productDTOResults[0]->setOffer($offer);
        $price = $productDTOResults[0]->getPrice();
        $price = $price - ($price * $productDTOResults[0]->getOffer()) / 100;
        $productDTOResults[0]->setOfferPrice($price);
        $productDAO->update($offer);
    }
}

if (isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
    echo "Cantidad: " . $quantity;

    if (isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productID] = array('quantity' => $quantity);
    }
    header('Location: product.php?productID=' . $productDTO->getID());
    exit;
}

if (count($productDTOResults) == 0) {
    $title = "Producto no encontrado";

    $error = '
        <div class="alert alert-danger m-2 text-center">
            No existe este producto
        </div>';
} else if (count($productDTOResults) > 1) {
    $title = "Producto no encontrado";

    $error = <<<HTML_ERROR
        <div class="alert alert-danger m-2 text-center">
            Hay más de un producto con esta ID
        </div>
    HTML_ERROR;
} else {
    $product = $productDTOResults[0];
    $title = $product->getName();
}
$error
?>
<div class="container">
    <div class="row m-3 p-4 d-flex flex-row shadow">
        <div class="col col-md-6 d-flex flex-col">
            <img class="img-fluid object-fit-contain" src="<?= $productsPath . $product->getImgName(); ?>">
        </div>
        <div class="col col-md-6 border">
            <div class="d-flex justify-content-start">
                <h3> <?= $product->getName() ?> </h3>
            </div>
            

            <hr class="mt-2">
            <?php if ($product->getOffer() != 0) :
                if ($product->getOffer() == 100) : ?>
                    <div class="row ">
                        <h3 class="col md-5 ms-3"><?= number_format($product->getOfferPrice(), 2) ?>€</h3>
                        <h3 class="text-decoration text-success col md-5"> GRATIS! </h3>
                        <h5 class="text-decoration-line-through text-danger row m-3"><?= number_format($product->getPrice(), 2) ?>€</h5>
                    </div>
                <?php else : ?>
                    <h3><?= number_format($product->getOfferPrice(), 2) ?>€</h3>
                    <h5 class="text-decoration-line-through text-danger"><?= number_format($product->getPrice(), 2) ?>€</h5>
                <?php endif ?>
            <?php else : ?>
                <h3><?= number_format($product->getPrice(), 2) ?>€</h3>
            <?php endif ?>
            <div class="d-flex flex-row">
                <?php if ($role == "admin") : ?>
                    <?= ($offerForm = new es\ucm\fdi\aw\forms\OfferForm($productID))->handleForm(); ?>
                <?php endif ?>
            </div>
            <div class="buttons py-3">
                <!-- AQUI HAY QUE HACER OTRO FORM PARA EL BOTON DE COMPRAR -->
                <a class="btn btn-primary " id="buy-now" href="purchase.php?productID=<?= $productID ?>">Comprar ya</a>
                <div class="row">
                    <div class="col-md-5">
                        <?php if (!isset($_SESSION["user"])) : ?>
                            <?= ($cartForm = new es\ucm\fdi\aw\forms\CartForm(null, $productID))->handleForm(); ?>
                        <?php else : ?>
                            <?= ($cartForm = new es\ucm\fdi\aw\forms\CartForm($_SESSION["user"]->getID(), $productID))->handleForm(); ?>
                        <?php endif ?>

                    </div>
                    <?php if (isset($_SESSION["user"])) : ?>
                        <div class="col-md-7 ">
                            <div class="row">
                                <div class="col-md-8 mt-2 ">
                                    <div class="dropdown">
                                        <span>Selecciona lista de deseos: </span>
                                        <button class="btn btn-outline-secondary rounded-pill shadow border dropdown-toggle w-100" id="boton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Lista de deseos</button>
                                        <ul class="dropdown-menu" id="lista-deseos">
                                            <?php foreach($arrayOfLists as $listas) : ?>
                                            <?php $wishListDTO = $wishListDAO->read($listas->getListID())[0]; ?>
                                            <li><a class="dropdown-item" href="#" data-list-id="<?= $wishListDTO->getID() ?>"><?= $wishListDTO->getName() ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2 ">
                                    <span>Añadir: </span>
                                    <button class="btn rounded-pill shadow border heart-button">
                                        ❤️
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span style="display:none" id="prodID"><?= $productID ?></span>
                    <?php endif ?>

                </div>
            </div>
            

        </div>
        <div class="mt-5 py-2">
            <?= $product->getDescription() ?>
        </div>

        <h2 id="reviews">Reseñas (<?= count($reviewDTOResults) ?>)</h2>
        <?php foreach ($reviewDTOResults as $review) : ?>
            <div class="card m-1 ps-4 pt-2 pb-2">
                <?php $user = $reviewDAO->getReviewAuthor($productID, $review->getID())[0] ?>
                <div class="row">
                    Usuario: <?= $user->getName() ?> <?= $user->getSurname() ?>
                </div>
                <div class="row">
                    Comentario: <?= $review->getComment() ?>
                </div>
                <div class="row">
                    Valoración: <?= $review->getReview() ?>
                </div>
                <div class="row">
                    Fecha: <?= $review->getDate() ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?= ($reviewForm = new es\ucm\fdi\aw\forms\ReviewForm($productID))->handleForm(); ?>
</div>
</div>

<?php
$content = ob_get_clean();
require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>

<script src="js/wishList.js"></script>
