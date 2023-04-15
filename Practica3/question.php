<?php

use es\ucm\fdi\aw\DAO\AnswerDAO;
use es\ucm\fdi\aw\DAO\QuestionDAO;
use es\ucm\fdi\aw\DAO\UserAnswerDAO;
use es\ucm\fdi\aw\DAO\UserQuestionDAO;
use es\ucm\fdi\aw\DTO\AnswerDTO;
use es\ucm\fdi\aw\DTO\UserAnswerDTO;

require_once 'includes/config.php';

$questionID = $_GET['questionID'];
$questionAuthor =  $_GET['author'];

$questionDAO = new QuestionDAO;
$questionDTOResults = $questionDAO->read($questionID);

$answerDAO = new AnswerDAO;

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['answerID']) && !empty($_GET['answerID'])) {
    $answerDAO->delete($_GET['answerID']);
    header("Location: {$_SESSION['url']}");
}

if (count($questionDTOResults) == 0) {
    $title = "Pregunta no encontrada";

    $error .= <<<HTML_ERROR
        <div class="alert alert-danger m-2 text-center">
            No existe esta pregunta
        </div>
        HTML_ERROR;
} else if (count($questionDTOResults) > 1) {
    $title = "Pregunta no encontrada";

    $error .= <<<HTML_ERROR
        <div class="alert alert-danger m-2 text-center">
            Hay más de una pregunta con esta ID
        </div>
    HTML_ERROR;
} else {
    $question = $questionDTOResults[0];
    $title = $question->getTitle();

    $userQuestionDAO = new UserQuestionDAO;
    $answers = $answerDAO->getQuestionAnswers($questionID);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answerMessage'])) {
    if (isset($_SESSION['user'])) {
        $answerMessage = $_POST["answerMessage"];

        $date = date('Y-m-d H:i:s');
        $answerDAO->create(new AnswerDTO(-1, $answerMessage, $date));

        $answer = $answerDAO->read(null, ["creationDate" => $date])[0];

        $answerID = $answer->getID();
        $answerAuthorID = $_SESSION["user"]->getID();

        $userAnswerDAO = new UserAnswerDAO;
        $userAnswerDAO->create(new UserAnswerDTO($answerAuthorID, $answerID, $questionID));

        header("Location: question.php?questionID=$questionID&author=$questionAuthor");
    } else {

        $title = "Pregunta no encontrada";

        $error .= <<<HTML_ERROR
        <div class="alert alert-warning m-2 justify-content-center align-center" role="alert">
            Debes identificarte para poder escribir en el foro.
        </div>
        HTML_ERROR;
    }
}
ob_start();
?>

<div class="container col-lg-8 shadow my-5">
    <?= $error ?>
    <div class="mx-5 p-4">
        <h3><?= $question->getTitle(); ?></h3>
        <p class="text-sm"><span class="op-6 text-secondary">Publicado el <b class="text-dark"><?= $question->getCreationDate() ?></b><span class="text-secondary"> por </span><b class="text-dark"><?= $questionAuthor ?></b></span></p>
        <div class="card border-primary rounded-0 shadow mb-5">
            <div class="m-4">
                <?= $question->getMessage() ?>
            </div>
        </div>
        <h5 class="justify-content-start">Respuestas (<?= count($answers) ?>)</h5>
        <?php
            foreach ($answers as $answer) :
            $answerAuthor = $answerDAO->getAnswerAuthor($answer->getID(), $questionID)[0]->getName() . " " . $answerDAO->getAnswerAuthor($answer->getID(), $questionID)[0]->getSurname()
        ?>
            <div class="card border-primary border-start-0 border-end-0 rounded-0 shadow my-3 p-4">
                <div class="d-flex flex-row">
                    <div class="d-flex flex-col col-6 justify-content-start">
                        <p class="text-sm"><b>
                                <h5><?= $answerAuthor ?></h5>
                            </b></p>
                    </div>
                    <?php if ((isset($_SESSION["user"]) && $_SESSION["user"]->getID() == $answerDAO->getAnswerAuthor($answer->getID(), $questionID)[0]->getID()) || (isset($_SESSION["isAdmin"]) && $_SESSION['isAdmin'] == true)) : ?>
                        <div class="d-flex flex-col col-5 justify-content-end">
                            <p class="text-sm"><?= $answer->getCreationDate() ?></h5>
                            </p>
                        </div>
                        <div class="d-flex flex-col col-1 justify-content-end">
                            <button type="button" class="ms-3 btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-modal-<?= $answer->getID(); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal fade" id="confirm-modal-<?= $answer->getID(); ?>" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-title">Confirmar acción</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Deseas realmente eliminar esta respuesta?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</a>
                                        <a class="btn btn-danger" href="question.php?questionID=<?= $questionID ?>&author=<?= $questionAuthor ?>&answerID=<?= $answer->getID() ?>">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="d-flex flex-col col-6 justify-content-end">
                            <p class="text-sm"><?= $answer->getCreationDate() ?></h5>
                            </p>
                        </div>
                    <?php endif ?>
                </div>
                <hr class="mb-4">
                <?= $answer->getMessage() ?>
            </div>
        <?php endforeach ?>
    </div>
    <form action="question.php?questionID=<?= $questionID ?>&author=<?= $questionAuthor ?>" method="post">
        <div class="d-flex flex-row justify-content-center pb-3">
            <div class="d-flex flex-col col-10 justify-content-center pe-1">
                <textarea class="p-2 card w-100" style="resize: none;" name="answerMessage" rows="4"></textarea>
            </div>
            <div class="d-flex flex-col justify-content-center ps-1">
                <button type="submit" class="btn btn-primary">Responder</button>
            </div>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once PROJECT_ROOT . '/includes/templates/default_template.php'; ?>