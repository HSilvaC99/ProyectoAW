<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\QuestionDAO;
use es\ucm\fdi\aw\DAO\UserQuestionDAO;
use es\ucm\fdi\aw\DTO\QuestionDTO;
use es\ucm\fdi\aw\DTO\UserQuestionDTO;

require_once 'includes/config.php';

class QuestionForm extends Form
{
    //  Constants
    private const FORM_ID = 'question_form';
    private const URL_REDIRECTION = 'forum.php';

    //  Constructors
    public function __construct()
    {
        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => self::URL_REDIRECTION));
    }

    //  Methods
    protected function processForm($data)
    {
        $title = $data['title'];
        $message = $data['message'];
        $date = date('Y-m-d H:i:s');

        $questionDAO = new QuestionDAO;
        $questionDTO = new QuestionDTO(-1, $title, $message, $date);

        $questionDAO->create($questionDTO);
        $questionDTO = $questionDAO->getLastQuestion();

        $userID = $_SESSION['user']->getID();
        $questionID = $questionDTO->getID();

        $userQuestionDAO = new UserQuestionDAO;
        $userQuestionDTO = new UserQuestionDTO($userID, $questionID);
        $userQuestionDAO->create($userQuestionDTO);
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
        <div class="p-4">
            <h2 class="mb-3 d-flex justify-content-center">Añada su pregunta al foro</h2>

            <hr class="my-4">

            <div class="col-sm-12 my-2">
                <label for="title" class="form-label">Título de la pregunta</label>
                <input type="title" class="form-control" name="title" required>
                <div class="invalid-feedback">
                    Por favor, introduzca una dirección de correo electrónico válida.
                </div>
            </div>

            <div class="col-sm-12 my-2">
                <label for="message" class="form-label">Contenido</label>
                <textarea type="message" class="form-control" name="message" rows="20" style="resize: none" required></textarea>
                <div class="invalid-feedback">
                    Por favor, rellene los campos obligatorios.
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Añadir pregunta</button>
        </div>
        HTML_FORM;
    }
}
