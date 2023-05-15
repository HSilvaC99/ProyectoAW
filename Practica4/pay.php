<?php

use es\ucm\fdi\aw\DAO\OrderDAO;
use es\ucm\fdi\aw\DAO\UserOrderDAO;
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DAO\CardDAO;
use es\ucm\fdi\aw\DTO\CardDTO;

require_once 'includes/config.php';

ob_start();


$metodo = $_GET["metodo"];

$cardDAO = new CardDAO();

?>
<div class="container">
    <h2 class="m-3 d-flex justify-content-center">Proceso de Pago</h2>
    <form method="post">

    <?php if ($metodo == 'Tarjeta Credito') :
        $title = 'Añadir pago';?>
        <div class="container justify-content-center col-lg-5">
            <div class="row m-3 p-4">
                <div class="col-12 my-1">
                    <label for="number" class="form-label">Número de Tarjeta de Crédito</label>
                    <input type="text" class="form-control" id="number"name="number" required>
                </div>
                <div class="col-6 my-1">
                    <label for="expirate" class="form-label">Fecha de Caducidad</label>
                    <input type="text" class="form-control" id="expirate" name="expirate" required>
                </div>
                <div class="col-6 my-1">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" required>
                </div>
                <div class="form-group my-1">
                    <label for="name" class="form-label">Nombre del Titular</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <form method="post">
                    <button name="buy" type="submit"  class="btn btn-primary my-3">Pagar</button>
                 </form>
                </div>
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
    </form>
</div>

<?php
    if (isset($_POST['buy'])) {
        $number = $_POST['number'];
        $expirate = $_POST['expirate'];
        $cvv = $_POST['cvv'];
        $name = $_POST['name'];
        $cardDAO->insertCard($number, $expirate, $cvv, $name);
        header('Location: orders.php');
            exit();
    }
?>

   
<?php
//end:
$content = ob_get_clean();
require_once INCLUDES_ROOT . '/templates/default_template.php';
?>