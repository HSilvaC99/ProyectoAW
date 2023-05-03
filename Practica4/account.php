<?php

use es\ucm\fdi\aw\forms\AccountForm;
use es\ucm\fdi\aw\DAO\AddressDAO;
use es\ucm\fdi\aw\DAO\UserAddressDAO;

require_once 'includes/config.php';

ob_start();
$title = 'Mi cuenta';
?>
<?php
if (isset($_SESSION["user"])) {
    $userID = $_SESSION["user"]->getID();
    $addressDAO = new AddressDAO();
    $userAddressDAO = new UserAddressDAO();
    $var = $addressDAO->getAddressForUser($userID);
    $vID = 0;
?>

    <div class="container shadow p-4">
        <h1 class="mb-4 text-center">Datos del usuario</h1>

        <?= ($modUser = new AccountForm($userID))->handleForm(); ?>

        <?php if($var != NULL) {
             ?>

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
                    <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    foreach ($var as $v) {
                        echo "<tr>";
                        echo "<td>" . $v['addressID'] . "</td>";
                        echo "<td>" . $v['streetO'] . "</td>";
                        echo "<td>" . $v['floorO'] . "</td>";
                        echo "<td>" . $v['zipO'] . "</td>";
                        echo "<td>" . $v['cityO'] . "</td>";
                        echo "<td>" . $v['provinceO'] . "</td>";
                        echo "<td>" . $v['countryO'] . "</td>";
                        ?><form method="POST">
                        <td> <button type="submit" name="delete" id="delete-{$v['addressID']}" class="py-1 btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#product-modal" value="<?php $v['addressID']?>">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                </svg>
                            </button>  </td></form>
                        <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                </table>
                <?php } else echo "No hay direcciones de envío registradas.";
                
                ?> 
    </div>

    

<?php
}

?>

<?php  

if (isset($_POST['delete'])) {
    $addressDAO->delete($v['addressID']);
    //$userAddressDAO->deleteAddress($v['addressID']);
    header('Location: account.php');
    exit();
}





$content = ob_get_clean();


require_once PROJECT_ROOT . '/includes/templates/default_template.php';

?>