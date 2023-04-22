<?php

use es\ucm\fdi\aw\DAO\ProductDAO;

require_once 'includes/config.php';

$productDAO = new ProductDAO;
$productDTOresults = $productDAO->read();
$productsPath = 'images/products/';

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['productID']) && !empty($_GET['productID'])) {
    unlink($productsPath . $productDAO->read($_GET['productID'])[0]->getImgName());
    $productDAO->delete($_GET['productID']);
    header("Location: products.php");
}

ob_start();
?>
<script defer src="js/productsView.js"></script>
<script defer src="js/productSearchFilter.js"></script>
<script defer src="js/productSearchbar.js"></script>
<div class="container">
    <div class="my-4">
        <div class="input-group">
            <legend>Buscar producto</legend>
            <input type="search" id="product-searchbar" class="form-control rounded" placeholder="Buscar" aria-label="Search" aria-describedby="search-addon"/>
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <hr>
    <div class="container-fluid pb-4">
        <div class="row justify-content-start" id="products-root">
        </div>
    </div>
</div>

<?php
$title = 'Productos';
$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>