<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DTO\ReviewDTO;
use es\ucm\fdi\aw\DTO\UserReviewDTO;
use es\ucm\fdi\aw\DAO\ReviewDAO;
use es\ucm\fdi\aw\DAO\UserReviewDAO;

require_once 'includes/config.php';

class ReviewForm extends Form
{
    //  Constants
    private const FORM_ID = 'review_form';
    private const URL_REDIRECTION = 'product.php';
    private $m_ProductID;

    //  Constructors
    public function __construct($productID)
    {
        $this->m_ProductID = $productID;
        parent::__construct(self::FORM_ID, array(parent::URL_REDIRECTION_KEY => $_SESSION["url"] . "#reviews"));
    }

    //  Methods
    protected function processForm($data)
    {
        if (!isset($_SESSION['user'])) {
            $this->m_Errors['user_not_identified'] = "Debes estar identificado para escribir reseñas";
        }
        else {
            $userID = $_SESSION['user']->getID();
            
            $comment = $_POST['comment'];
            if(empty($comment))
                $comment = "Sin comentario";

            $review = $_POST['review'];
            $date = date('Y-m-d H:i:s', strtotime("now"));

            $reviewDAO = new ReviewDAO;
            $reviewDAO->create(new ReviewDTO(-1, $comment, $review, $date));
            $reviewDTO = $reviewDAO->read(null, ["date" => $date])[0];
            $reviewID = $reviewDTO->getID();

            $userReviewDAO = new UserReviewDAO;
            $userReviewDAO->create(new UserReviewDTO($userID, $this->m_ProductID, $reviewID));
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
        <div class="row justify-content-center pb-3 m-2">
            <div class="card m-2 p-2">
                <label class="form-label ps-2" for="comment">Comentario</label> 
                <textarea class="p-2 card w-100" style="resize: none;" name="comment" rows="4"></textarea>
                <div class="flex-row">
                    <label class="ps-2 me-2" for="review">Valoración [1-5]</label>
                    <input class="col-1 mt-2" type="number" min="1" max="5" name="review" required>
                </div>
            </div>
            <div class="d-flex flex-col justify-content-center ps-1">
                <button type="submit" class="w-100 btn btn-primary">Enviar reseña</button>
            </div>
        </div>
        HTML;
    }
}
?>