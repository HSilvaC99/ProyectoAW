<?php

use es\ucm\fdi\aw\DAO\OrderDAO;
use es\ucm\fdi\aw\DAO\UserOrderDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DAO\AddressDAO;
use es\ucm\fdi\aw\forms\UpdateOrderForm;

require_once 'includes/config.php';


//if (!isset($_SESSION['user'])) goto end;

$userID = $_SESSION['user']->getID();
$orderID = $_GET['orderID'];

$orderDAO = new OrderDAO;
$results = $orderDAO->getOrderForUser($userID);

$userDAO = new UserDAO;
$users = $userDAO->getContact($userID);

$addressDAO = new AddressDAO;

$addr = $addressDAO->read();

$my_array = $addressDAO->getAddressForUser($userID);

ob_start();
?>

<div class="container">
    <br>
    <?php foreach ($results as $result) :
        if ($result['orderID'] == $orderID) : ?>
            <h2 class="m-3 d-flex justify-content-center">Pedido número: <?php echo $orderID ?></h2>

            <!-- Sección de Entrega -->
            <div class="border border-secondary rounded p-3 mb-3">
                <h3>Entrega</h3>
                <p><strong>Estado: </strong><?php echo $result['stateO']; ?></p>
                <p><strong>Fecha: </strong><?php echo $result["dateO"]; ?></p>

                <?php if (isset($_POST['edit_address'])) : ?>
                    <!-- Formulario para editar la dirección de envío -->
                    <form method="post">
                        <p><strong>Direcciones de envío: <!--</strong><input type="text" name="address" value="<?php //echo $result['addressO']; ?>"></p>-->
                        <table class="table">
                            <thead>
                                <tr>
                                <th></th>
                                <th>Dirección</th>
                                <th>Piso</th>
                                <th>Código Postal</th>
                                <th>Ciudad</th>
                                <th>Provincia</th>
                                <th>País</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                foreach ($my_array as $m) {
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='direccion_envio' value='" . $m['addressID'] . "' data-id='" . $m['addressID'] . "' onclick='uncheckAll(this)'></td>";

                                    echo "<td>" . $m['streetO'] . "</td>";
                                    echo "<td>" . $m['floorO'] . "</td>";
                                    echo "<td>" . $m['zipO'] . "</td>";
                                    echo "<td>" . $m['cityO'] . "</td>";
                                    echo "<td>" . $m['provinceO'] . "</td>";
                                    echo "<td>" . $m['countryO'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                            </table>
                        <form method="post">
                            <input type="hidden" name="dir" id="dir-input">
                                <!-- Agrega otros campos de entrada aquí -->
                            <button type="submit" name="save_address" class="btn btn-primary">Guardar</button>
                        </form>
                        <!--<button type="submit" name="save_address" class="btn btn-primary">Guardar</button>-->
                        <button type="submit" name="cancel_edit" class="btn btn-secondary">Cancelar</button>
                    </form>
                <?php else : ?>
                    <!-- Mostrar la dirección de envío actual y el botón para editar -->
                    <?php $var = $addressDAO->getAddressForOrder($result["addressO"]); ?>
                    <p><strong>Dirección de envío: </strong></p>

                    <table class="table">
                            <thead>
                                <tr>
                                <th>Dirección</th>
                                <th>Piso</th>
                                <th>Código Postal</th>
                                <th>Ciudad</th>
                                <th>Provincia</th>
                                <th>País</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                foreach ($var as $v) {
                                    echo "<tr>";
                                    
                                    echo "<td>" . $v['street'] . "</td>";
                                    echo "<td>" . $v['floor'] . "</td>";
                                    echo "<td>" . $v['zip'] . "</td>";
                                    echo "<td>" . $v['city'] . "</td>";
                                    echo "<td>" . $v['province'] . "</td>";
                                    echo "<td>" . $v['country'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                            </table>

                    <form method="post">
                        <?php if ($result["stateO"] == "pendiente" || $result["stateO"] == "en proceso") : ?>
                            <td>
                                <button type="submit" name="edit_address" class="btn btn-secondary">Editar</button>
                            </td>
                        <?php else : ?>
                            <td></td>
                        <?php endif; ?>

                    </form>
                <?php endif; ?>
            </div>


            <!-- Sección de Contacto -->
            <div class="border border-secondary rounded p-3 mb-3">
                <h3>Contacto</h3>
                <?php foreach ($users as $user) : ?>
                    <p><strong>Nombre: </strong><?php echo $user['userName'] ?></p>
                    <p><strong>Apellido: </strong><?php echo $user['sur'] ?></p>


                    <?php if (isset($_POST['edit_email'])) : ?>
                        <!-- Formulario para editar Email -->
                        <form method="post">
                            <p><strong>Email</strong><input type="text" name="email" value="<?php echo $user['em'];  ?>"></p>
                            <button type="submit" name="save_email" class="btn btn-primary">Guardar</button>
                            <button type="submit" name="cancel_edit" class="btn btn-secondary">Cancelar</button>
                        </form>
                    <?php else : ?>
                        <!-- Mostrar la dirección de envío actual y el botón para editar -->
                        <p><strong>Email: </strong><?php echo $user['em']; ?></p>
                        <form method="post">
                            <?php if ($result["stateO"] == "pendiente" || $result["stateO"] == "en proceso") : ?>
                                <td>
                                    <button type="submit" name="edit_email" class="btn btn-secondary">Editar</button>
                                </td>
                            <?php else : ?>
                                <td></td>
                            <?php endif; ?>

                        </form>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>

            <!-- Sección de Pago -->
            <div class="border border-secondary rounded p-3 mb-3">
                <h3>Pago</h3>
                <p><strong>Método de pago: </strong><?php echo $result["paymentMethodO"]; ?></p>
                <p><strong>Importe (€): </strong><?php echo $result["amountO"]; ?></p>
            </div>
        <?php break;
        endif; ?>
    <?php endforeach; ?>
</div>
<script>
            function uncheckAll(clickedCheckbox) {
                var checkboxes = document.getElementsByName("direccion_envio");
                for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] !== clickedCheckbox) {
                    checkboxes[i].checked = false;
                }
                }
                            
                // Obtener el ID del registro seleccionado
                var dir = clickedCheckbox.value;
                console.log("ID del registro seleccionado:", dir);
                            
                // Pasar el valor de dir al campo de entrada oculto
                var dirInput = document.getElementById("dir-input");
                dirInput.value = dir;
            }
        </script>
<?php
// Si se ha enviado el formulario para guardar la nueva dirección de envío
if (isset($_POST['save_address'])) {
    // Obtener la nueva dirección de envío
    //$new_address = $_POST['address'];
    $dir = $_POST["dir"];
    // Actualizar la dirección de envío en la base de datos
    $orderDAO->UpdateAddress($orderID, $dir);

    // Redirigir a la misma página para mostrar la nueva dirección de envío
    header('Location: orders.php');
    exit();
}

// Si se ha enviado el formulario para guardar la nueva dirección de envío
if (isset($_POST['save_email'])) {
    // Obtener la nueva dirección de envío
    $new_email = $_POST['email'];

    // Actualizar la dirección de envío en la base de datos
    $userDAO->UpdateEmail($userID, $new_email);

    // Redirigir a la misma página para mostrar la nueva dirección de envío
    header('Location: orders.php');
    exit();
}

// Si se ha enviado el formulario para cancelar la edición
if (isset($_POST['cancel_edit'])) {
    // Redirigir a la misma página para mostrar la dirección de envío actual
    header('Location: orders.php');
    exit();
}
?>



<?php
//end:
$content = ob_get_clean();
require_once INCLUDES_ROOT . '/templates/default_template.php';
?>