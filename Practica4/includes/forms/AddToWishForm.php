<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;
use es\ucm\fdi\aw\DTO\UserDTO;
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DTO\UserProductDTO;



require_once 'includes/config.php';


class AddToWishForm extends Form
{
    //  Constants
    private const FORM_ID = 'wish_form';
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
            <div class="dropdown  col-md-6 mt-2">
                <button class="btn btn-outline-secondary rounded-pill shadow border dropdown-toggle  w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="mover">
                    Mover
                </button>
                    <ul class="dropdown-menu">
                    <li><span class="dropdown-item" style="text-align: left;" id="mover" ></span>holaa</li>
                    </ul>
            </div>
        HTML;
        
    }
}
?>