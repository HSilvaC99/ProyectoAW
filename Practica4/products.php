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
    <div class="my-4">
        <div class="input-group">
            <legend>Buscar producto</legend>
            <input type="search" id="product-searchbar" class="form-control rounded" placeholder="Buscar" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="card py-2 shadow-lg col-sm-12 col-lg-3">
                <form>
                    <div id="filterBy">
                        <legend>Filtrar por</legend>
                        <div class="form-group mb-2">
                            <label for="filterCriteriaFirearmType">Tipo</label>
                            <select name="filterCriteriaFirearmType" id="filterCriteriaFirearmType" class="form-control">
                                <option value="pistol">Pistola</option>
                                <option value="automaticRifle">Rifle automática</option>
                                <option value="lmg">LMG</option>
                                <option value="sniperRifle">Francotirador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filterCriteriaFirearmManufacturer">Fabricante</label>
                            <select name="filterCriteriaFirearmManufacturer" id="filterCriteriaFirearmManufacturer" class="form-control">
                                <option value="tokyoMarui">Tokyo Marui</option>
                                <option value="kingArms">King Arms</option>
                                <option value="aps">APS</option>
                                <option value="a&k">A&K</option>
                                <option value="amoeba">Amoeba</option>
                                <option value="ics">ICS</option>
                                <option value="kjWorks">KJ Works</option>
                                <option value="weTech">WE Tech</option>
                                <option value="g&p">G&P</option>
                                <option value="specnaArms">Specna Arms</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div id="orderBy">
                        <legend>Ordenar por</legend>
                        <div class="form-group">
                            <label for="orderCriteria">Criterio</label>
                            <select name="orderCriteria" id="orderCriteria" class="form-control">
                                <option value="name">Nombre</option>
                                <option value="firearmManufacturer">Fabricante</option>
                                <option value="manufactureDate">Fecha de fabricación</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container-fluid pb-4 col-sm-12 col-lg-9">
                <div class="row justify-content-start" id="products-root">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$title = 'Productos';
$content = ob_get_clean();

require_once PROJECT_ROOT . '/includes/templates/default_template.php';
?>

<script defer src="js/productsView.js"></script>
<script defer src="js/producFilterHandler.js"></script>
<script defer src="js/productSearchbar.js"></script>