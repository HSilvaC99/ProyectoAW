<?php

use es\ucm\fdi\aw\DAO\AnswerDAO;
use es\ucm\fdi\aw\DAO\QuestionDAO;
use es\ucm\fdi\aw\DAO\UserAnswerDAO;
use es\ucm\fdi\aw\DAO\UserQuestionDAO;

require_once 'includes/config.php';

$title = "Foro";

$questionDAO = new QuestionDAO;
$questions = $questionDAO->read();

$userQuestionDAO = new UserQuestionDAO;
$questionAuthors = $userQuestionDAO->read();

$isDisabled = !isset($_SESSION["user"]) ? " disabled" : "";
$answerDAO = new AnswerDAO;

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['questionID']) && !empty($_GET['questionID'])) {

    $answersToDelete = $answerDAO->getQuestionAnswers($_GET['questionID']);

    $questionDAO->delete($_GET['questionID']);

    foreach ($answersToDelete as $answer)
        $answerDAO->delete($answer->getID());

    header("Location: {$_SESSION['url']}");
}

ob_start();
?>
<div class="container">
    <h2 class="m-3 d-flex justify-content-center">Foro</h2>
    <div class="row">
        <?php if (!isset($questions) || empty($questions)) : ?>
            <fieldset class="col-12" <?= $isDisabled ?>>
                <div class="row d-flex justify-content-center">
                    <h5>El foro está vacío</h5>
                    <a class="btn btn-primary w-100 m-3" href="addQuestion.php" role="button">
                        <p class="pt-3"><?= !isset($_SESSION["user"]) ? "Identifícate para escribir en el foro" : "Haz una pregunta" ?></p>
                    </a>
                </div>
            </fieldset>
        <?php else : ?>
            <div class="col-10 mb-3">
                <?php foreach ($questions as $question) : ?>
                    <div class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-bottom-0 rounded-0 shadow">
                        <div class="row d-flex align-items-center">
                            <?php $questionAuthor = $questionDAO->getQuestionAuthor($question->getID())[0]->getName() . " " . $questionDAO->getQuestionAuthor($question->getID())[0]->getSurname(); ?>
                            <a class="text-primary text-decoration-none" href="question.php?questionID=<?= $question->getID(); ?>&author=<?= $questionAuthor ?>">
                                <h5><?= $question->getTitle(); ?></h5>
                            </a>
                            <div class="row">
                                <div class="col d-flex justify-content-start">
                                    <p class="text-sm"><span class="op-6">Publicado el <b><?= $question->getCreationDate() ?></b> por <b><?= $questionAuthor ?></b></span></p>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <?php $numAnswers = count($answerDAO->getQuestionAnswers($question->getID())); ?>
                                    <i>(<?= $numAnswers; ?><?php $numAnswers == 1 ? print(" respuesta") : print(" respuestas") ?>)</i>
                                </div>
                            </div>
                            <?php if ((isset($_SESSION["user"]) && $_SESSION["user"]->getID() == $questionDAO->getQuestionAuthor($question->getID())[0]->getID()) || (isset($_SESSION["isAdmin"]) && $_SESSION['isAdmin'] == true)) : ?>
                                <div class="d-flex flex-col col-1 justify-content-start">
                                    <button type="button" class="ms-3 btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-modal-<?= $question->getID() ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal fade" id="confirm-modal-<?= $question->getID(); ?>" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-title">Confirmar acción</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Deseas realmente eliminar esta pregunta?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</a>
                                                <a href="forum.php?questionID=<?= $question->getID(); ?>" class="btn btn-danger">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-2 mt-3" <?= $isDisabled ?>>
                <div class="row d-flex justify-content-center">
                    <a class="btn btn-primary w-100 m-3" href="addQuestion.php" role="button">
                        <p class="pt-3"><?= !isset($_SESSION["user"]) ? "Identifícate para<br>escribir en el foro" : "Haz una<br>pregunta" ?></p>
                    </a>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once PROJECT_ROOT . '/includes/templates/default_template.php'; ?>