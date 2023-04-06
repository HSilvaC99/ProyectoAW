<?php

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\reviewsDAO;

require_once 'includes/config.php';

ob_start();

$productID = $_GET["productID"];
$reviewID = $_GET["review_id"];

//Products

$productDAO = new ProductDAO;
$productDTOResults = $productDAO->read($productID);
$productsPath = 'images/products/';
$error = "";

//Reviews

$reviewsDAO = new reviewsDAO;
$reviewsDTOResults = $reviewsDAO->read($reviewID);

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

    $price = strval($product->getPrice());
    $numCharacters = strlen($price);
    $intPart = intval($price);
    $decimalPart = "";
    
    $decimalPart = (str_contains($price, ".")) ? substr($price, -2) : "00";
}
$error


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

    $price = strval($product->getPrice());
    $numCharacters = strlen($price);
    $intPart = intval($price);
    $decimalPart = "";
    
    $decimalPart = (str_contains($price, ".")) ? substr($price, -2) : "00";
}
$error
?>
<div class="container shadow">
    <div class="row m-3 p-4 d-flex flex-row shadow">
        <div class="col col-md-6 d-flex flex-col">
            <img class="shadow" src="<?= $productsPath . $product->getImgName(); ?>">
        </div>
        <div class="col col-md-6">
            <div class="d-flex justify-content-start">
                <h3> <?= $product->getName() ?> </h3>
            </div>
            <hr class="mt-2">
            <h3><?= $product->getPrice() ?>€</h3>
            
            <div class="buttons d-flex flex-row mt-5 gap-3">
                <button class="btn btn-primary" id="buy-now">Buy Now</button>
                <button class="btn btn-outline-primary" id="add-to-cart">Add to Cart</button>
            </div>
        </div>
        <div class="mt-5"><?= 
        <div class="mt-5"><?= $product->getDescription() ?></div>
    </div>
</div>
<?php
$content = ob_get_clean();
?>

<?php require_once PROJECT_ROOT . '/includes/templates/default_template.php'; ?>