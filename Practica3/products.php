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

<div class="container">
    <div class="row justify-content-center m-3">
        <?php foreach ($productDTOresults as $productDTO) : ?>
            <div class="card m-2 my-2 shadow d-flex flex-col h-auto" style="width: 300px;">
                <div class="d-flex flex-fill" id="product-img">
                    <img class="img-fluid object-fit-contain" src="<?= $productsPath . $productDTO->getImgName(); ?>">
                </div>
                <hr class="my-3">
                <div class="text-start">
                    <a class="text-decoration-none text-reset" href="product.php?productID=<?= $productDTO->getID() ?>"><?= $productDTO->getName(); ?></a>
                </div>
                <div class="row mb-3">
                    <div class="col text-start">
                        <div class="text-black text-decoration-none">
                        <?php if ($productDTO->getOffer() != 0) { ?>
                            <?php if ($productDTO->getOffer() == 100 || $productDTO->getPrice() == 0) { ?>  
                                <b class=" text-decoration-line-through text-danger"><?= $productDTO->getPrice() ?>€</b>
                                <b class="text-decoration text-success"> GRATIS! </b>
                            <?php } else { ?>
                                <b><?= number_format($productDTO->getOfferPrice(),2) ?>€</b>
                                <b class="text-decoration-line-through text-danger"><?= $productDTO->getPrice() ?>€</b>
                                <b class="text-decoration text-danger">OFERTA! </b>
                            <?php } ?>
                        <?php }else { ?>
                            <?php if ($productDTO->getPrice() == 0) { ?>  
                                <b class=" fs-4"><?= $productDTO->getPrice() ?>€</b>
                                <b class="text-decoration text-success"> GRATIS! </b>
                            <?php }else { ?>
                                <b class="fs-4"><?= $productDTO->getPrice() ?>€</b>
                            <?php } ?>
                        <?php } ?>
                        </div>
                    </div>
                    <?php if (isset($_SESSION["isAdmin"]) && $_SESSION['isAdmin'] == true) : ?>
                        <div class="col text-end">
                            <a href="editProduct.php?productID=<?= $productDTO->getID() ?>" class="py-1 btn btn-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"></path>
                                </svg>
                            </a>
                            <button type="button" class="py-1 btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#product-modal-<?= $productDTO->getID(); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal fade" id="product-modal-<?= $productDTO->getID(); ?>" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Confirmar acción</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Deseas realmente eliminar este producto?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="products.php" method="get">
                                            <input type="hidden" name="productID" value="<?= $productDTO->getID(); ?>">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?php if (isset($_SESSION["isAdmin"]) && $_SESSION['isAdmin'] == true) : ?>
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary text-center" href="addProduct.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                </svg>
                Añadir producto
            </a>
        </div>
    <?php endif ?>
</div>

<style>
    #product-img {
        transition: all 0.3s;
    }

    #product-img:hover {
        transform: scale(1.05);
    }
</style>

<?php
$title = 'Productos';
$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>