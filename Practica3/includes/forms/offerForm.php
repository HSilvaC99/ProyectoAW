<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\ProductDAO;


require_once 'includes/config.php';


class OfferForm extends Form
{
    //  Constants
    private const FORM_ID = 'offer_form';
    private const URL_REDIRECTION = 'product.php';
    private $productID;

    //  Constructors
    public function __construct($productID)
    {
        $this->productID = $productID;
        $redirectionURL = self::URL_REDIRECTION . '?productID=' . $productID;
        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => $redirectionURL));
        
    }

    //  Methods
    protected function processForm($data)
    {   
        if (!isset($data['offer']) || $data['offer'] < 0 || $data['offer'] > 100){
            $this->m_Errors['empty_offer'] = 'Debes introducir un porcentaje de descuento.';
        }
        $productDAO = new ProductDAO;
        $productDTOResults = $productDAO->read($this->productID)[0];
       
        $offer = $data['offer'];
     
        $productDTOResults->setOffer($offer);
        $price = $productDTOResults->getPrice();
        $price = $price - ($price * (float)$productDTOResults->getOffer())/100;
        $productDTOResults->setOfferPrice($price);
        
        $productDAO->update($productDTOResults);
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
        <div class="form-floating">
            <input type="number" min="0" class="" name="offer" style="width:50px; height: auto; ">
            
            <div class="invalid-feedback">
                    Por favor, introduzca un descuento entre 0 y 100.
                </div>
            <button class="btn btn-outline-primary" id="apply-offer">Aplicar Descuento</button>
        </div>
        HTML;
    }
}
?>