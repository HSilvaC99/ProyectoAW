<?php

use es\ucm\fdi\aw\DAO\OrderDAO;
use es\ucm\fdi\aw\DAO\UserOrderDAO;
use es\ucm\fdi\aw\DAO\UserProductDAO;

require_once 'includes/config.php';

ob_start();


$metodo = $_GET["metodo"];

?>
<div class="container">
    <h2 class="m-3 d-flex justify-content-center">Proceso de Pago</h2>

    <?php if ($metodo == 'Tarjeta Credito') :
        $title = 'Añadir pago';?>
        <div class="container justify-content-center col-lg-5">
                <?= ($addProductForm = new es\ucm\fdi\aw\forms\AddPaymentForm())->handleForm(); ?>
        </div>
    <?php elseif ($metodo == 'Transferencia Bancaria'):?>
        <div class="container justify-content-center col-lg-5">
                <p> Para completar su pedido realice una tranferencia bancaria a la siguiente cuenta:</p>
                <p class="m-3 d-flex justify-content-center"> ES34 1237 5687 23 0987654321</p>
        </div>
    <?php else:?>
        <div class="container justify-content-center col-lg-5">
                <p class="m-3 d-flex justify-content-center"> Para completar su pedido realice un bizum al siguiente número de teléfono:</p>
                <p class="m-3 d-flex justify-content-center"> +34 657 876 098</p>
        </div>
    <?php endif; ?>
</div>


   
<?php
//end:
$content = ob_get_clean();
require_once INCLUDES_ROOT . '/templates/default_template.php';
?>