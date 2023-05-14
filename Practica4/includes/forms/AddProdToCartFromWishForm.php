<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DTO\UserDTO;
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DTO\UserProductDTO;



require_once 'includes/config.php';


class AddProdToCartFromWishForm extends Form
{
    //  Constants
    private const FORM_ID = 'wish_form';
    private const URL_REDIRECTION = 'WishList.php';
    private $productID;
    private $userID;

    //  Constructors
    public function __construct($userID, $productID, $listID)
    {
        $this->userID = $userID;
        $this->productID = $productID;
        
    
        $redirectionURL = self::URL_REDIRECTION . '?listID=' . $listID . '&productID=' . $this->productID;


        
        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => $redirectionURL));
        
    }

    //  Methods
    protected function processForm($data)
    {
        $cartDAO = new UserProductDAO();
        $prodDTO = $cartDAO->getCartProduct($this->userID, $this->productID);
        if ($prodDTO->getAmount() != 0) {
            $amount = $prodDTO->getAmount() + 1;
            $prodDTO->setAmount($amount);
            $cartDAO->updateWithCompoundKey($prodDTO);
        } else {
            $userProductDTO = new UserProductDTO($this->userID, $this->productID, 1);
            $cartDAO->create($userProductDTO);
        }

        // Devuelve una respuesta JSON indicando que el formulario se ha enviado correctamente
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
        // $response = array('success' => true, 'productID' => $this->productID);
        // echo json_encode($response);
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
            <div class="col-md-12  mt-3">
                <button type="submit" class="btn btn-warning btn-lg rounded-pill border w-100" id="add-to-cart-{$this->productID}">Añadir a la cesta</button>             
            </div>
        HTML;
        
    }
}
?>