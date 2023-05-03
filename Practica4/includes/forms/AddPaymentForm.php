<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\CardDAO;
use es\ucm\fdi\aw\DTO\CardDTO;

require_once 'includes/config.php';

class AddPaymentForm extends Form
{
    //  Constants
    private const FORM_ID = 'addPayment_form';
    private const URL_REDIRECTION = 'orders.php';
    private const ENCODE_TYPE = 'multipart/form-data';

    //  Constructors
    public function __construct()
    {
        parent::__construct(
            self::FORM_ID, 
            array(
                parent::URL_REDIRECTION_KEY => self::URL_REDIRECTION,
                parent::ENCODE_TYPE_KEY => self::ENCODE_TYPE
            )
        );
    }

    //  Methods
    /*protected function processForm($data)
    {

        $cardDAO = new CardDAO;

        $number = $data["number"];
        $expirate = $data["expirate"];
        $cvv = $data["cvv"];
        $name = $data["name"];

        $cardDAO->create(new CardDTO(null, $number, $expirate, $cvv, $name));
    }*/

    protected function processForm($data)
    {

        $cardDAO = new CardDAO;

        $number = $data["number"];
        $expirate = $data["expirate"];
        $cvv = $data["cvv"];
        $name = $data["name"];

        $cardDAO->insertCard($number, $expirate, $cvv, $name);
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

        return <<<HTML_FORM
        <div class="container shadow">

        {$errorsHTML}

        <div class="row m-3 p-4">
            <div class="col-12 my-1">
                <label for="number" class="form-label">Número de Tarjeta de Crédito</label>
                <input type="text" class="form-control" name="number" required>
            </div>
            <div class="col-6 my-1">
                <label for="expirate" class="form-label">Fecha de Caducidad</label>
                <input type="text" class="form-control" name="expirate" required>
            </div>
            <div class="col-6 my-1">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" name="cvv" required>
            </div>
            <div class="form-group my-1">
                <label for="name" class="form-label">Nombre del Titular</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <input type="submit" value="Pagar" class="btn btn-primary my-3">
        </div>
        HTML_FORM;
    }
}
