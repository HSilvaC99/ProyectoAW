<?php

namespace es\ucm\fdi\aw\forms;

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
