<?php 
require_once __DIR__ . '/includes/config.php'; 

$productModel = new \es\ucm\fdi\aw\DAO\ProductDAO(); 
$products = $productModel->getAll(); 

$title = 'Productos';

$content = <<<EOS
<div class="album py-5">
  <div class="container">
    <div class="row row-cols-sm-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-4 justify-content-center align-items-center">
EOS;

foreach ($products as $product) {
  $content .= <<<EOS
  <div class="card m-2">
    <img src="img/productos/{$product["img_name"]}" class="card-img-top object-fit-contain" style="height: 300px;">
    <div class="card-body">
      <hr class="my-1">
      <a href="#"><h5 class="card-title">{$product["title"]}</h5></a>
    </div>
  </div>
  EOS;
}

$content .= <<<EOS
    </div>
  </div>
</div>
EOS;

require __DIR__ . '/includes/template/template.php';
?>