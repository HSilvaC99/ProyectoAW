<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DTO\UserDTO;
use es\ucm\fdi\aw\DAO\UsersProductsDAO;
use es\ucm\fdi\aw\DTO\UsersProductsDTO;



require_once 'includes/config.php';


class CartForm extends Form
{
    //  Constants
    private const FORM_ID = 'cart_form';
    private const URL_REDIRECTION = 'product.php';
    private $productID;
    private $userID;

    //  Constructors
    public function __construct($userID, $productID)
    {
        $this->userID = $userID;
        $this->productID = $productID;
        
    
        $redirectionURL = self::URL_REDIRECTION . '?productID=' . $productID;
        
        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => $redirectionURL));
        
    }

    //  Methods
    protected function processForm($data)
    {   
        echo "<pre>";
        if($this->userID == null){
            //Hay que añadir el usuario como guest y añadirle los productos a su carrito
            $_SESSION["guest"] = "dragosMola";
            
            if (empty($_SESSION["carritoTemporal"])){
                $_SESSION["carritoTemporal"] = array();
                if ($data['amount'] > 0 && !empty($data['amount']))
                    $_SESSION["carritoTemporal"][0] = new UsersProductsDTO( -1, $this->productID, $data['amount']);
                
            }else{
                if ($data['amount'] > 0 && !empty($data['amount'])){
                    $encontrado = false;
                    $mi_array = $_SESSION["carritoTemporal"];
                    foreach($mi_array as $prod){
                        if ($prod->getID2() == $this->productID){
                            $amount = $prod->getAmount() + $data['amount'];
                            $prod->setAmount($amount);
                            $encontrado=true;
                            break;
                        }
                    }
                    if ($encontrado==false){
                        $index = count($mi_array);
                        $mi_array[$index] = new UsersProductsDTO( -1, $this->productID, $data['amount']);
                    }
                    $_SESSION["carritoTemporal"] = $mi_array;
                }
            }
        }else{
            if (!isset($data['amount'])){
                $this->m_Errors['empty_amount'] = 'Debes introducir una cantidad valida';
                return;
            }else if ($data['amount'] > 0 && !empty($data['amount'])){
                echo('<pre>');
                $cartDAO = new UsersProductsDAO();
                $prodDTO = $cartDAO->getCartProduct($this->userID, $this->productID);
                if ( $prodDTO->getAmount() != 0){ 
                    $amount =  $prodDTO->getAmount() + $data['amount'];
                    $prodDTO->setAmount($amount);
                    $cartDAO->updateWithCompoundKey($prodDTO);
                }else{
                    $usersProductsDTO = new UsersProductsDTO( $this->userID, $this->productID, $data['amount']);
                    $cartDAO->create($usersProductsDTO);
                }
            }else{
                $this->m_Errors['empty_amount'] = 'Debes introducir una cantidad valida';
                return;
            }
        }
        
    }

    protected function generateFormFields($data)
    {
        $errorsHTML = '';

        if (count($this->m_Errors) > 0) {
            foreach ($this->m_Errors as $error) {
                $errorsHTML .= <<<HTML_ERROR
                <div class="alert alert-danger m-2 justify-content-center align-center" role="alert">
                    <b>Error:</b> {$error}
                </div>
                HTML_ERROR;
            }
        }
       
        return <<<HTML
            {$errorsHTML}
            <div class="form-floating py-3 d-flex">
            <input type="number" min="1" class="text-center" name="amount" value="1" style="width:50px; height:50px; ">
                <div class="invalid-feedback">
                    Por favor, introduzca una cantidad entre 1 y 100.
                </div>
                <button class="btn btn-outline-primary ms-4" id="amount">Añadir al carrito</button>
            </div>
        HTML;
        
    }
}
?>