<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/InscriptionManager.php');
require_once('model/AdminManager.php');


function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostView.php');
}

function post($id)
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    if (!$post = $postManager->getPost($id))
    {
        throw new Exception('bad url', 404);
    }
    $comments = $commentManager->getComments($id);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function reportComment($commentId, $postId)
{
    $reportManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentReported = $reportManager->setReport($commentId);

    if ($commentReported === false) {
        throw new Exception('Impossible de report ce commentaire !');
    }
    else {
        post($postId);
    }
}

function manageComment()
{
    $reportManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $comment = $reportManager->getReportComment();

    require('view/frontend/manageCommentView.php');
}

function inscriptionPage()
{
    require('view/frontend/inscriptionView.php');
}

function verificationInformations($pseudo, $password, $password2, $email)
{
    $inscriptionManager = new \OpenClassrooms\Blog\Model\InscriptionManager();
    if (!is_string($pseudo))
    {
        throw new Exception('Le pseudo est invalide.');
    }

    $pseudo = trim($pseudo);
    if (!$checkUser = $inscriptionManager->isLoginUsed($pseudo))
    {
        throw new Exception('Ce pseudo est deja pris :( .');
    }

    if (is_string($password) && strlen($password) >= 4 && $password === $password2)
    {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    }
    else
    {
        throw new Exception('Les deux mots de passes ne sont pas identiques ou ne contient pas au minimum 4 caracteres.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        throw new Exception('L\'adresse mail est incorrect.');
    }

    if (!$checkMail = $inscriptionManager->isMailUsed($email))
    {
        throw new Exception('Cette adresse mail est deja prise :( .');
    }

    $affectedLines = $inscriptionManager->postNewUser($pseudo, $pass_hash, $email);

    if ($affectedLines === false) {
        throw new Exception('Erreur sur l\'inscription, veuillez contacter l\'administrateur du site.');
    }
    else {
        header('Location: index.php');
    }
}

function connectionPage()
{
    require('view/frontend/connectionView.php');
}

function verificationConnectionLog($pseudo, $password)
{
    $inscriptionManager = new \OpenClassrooms\Blog\Model\InscriptionManager();
    if (!is_string($pseudo))
    {
        throw new Exception('erreur identifiant et/ou mot de passe.');
    }

    $pseudo = trim($pseudo);
    $login = $inscriptionManager->verifyLogin($pseudo, $password);
    if ($login === false) {
        throw new Exception('erreur identifiant et/ou mot de passe.');
    }
    else {
        header('Location: index.php');
    }
}

function disconnectUser()
{
    $deconnectionUser = new \OpenClassrooms\Blog\Model\InscriptionManager();
    if (!$deconnectionUser->disconnectUser())
    {
        throw new Exception('Vous n etes pas co.');
    }
    else {
        header('Location: index.php');
    }
}

function newChapter()
{
    require('view/frontend/redactionView.php');
}

function postNewChapter($title, $content)
{
    $InscriptionManager = new \OpenClassrooms\Blog\Model\AdminManager();

    $affectedLines = $InscriptionManager->postNewChapter($title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le chapitre!');
    }
    else {
        header('Location: index.php');
    }
}

function update()
{
    $updateManager = new \OpenClassrooms\Blog\Model\PostManager();
    $post = $updateManager->getPost($_GET['id']);

    require('view/frontend/updateView.php');
}

function updateChapter($title, $content, $postid)
{
    $InscriptionManager = new \OpenClassrooms\Blog\Model\AdminManager();
    if (!$title || $content)
    {
        throw new Exception('Tous les champs ne sont pas remplis !');
    }
    $affectedLines = $InscriptionManager->updateChapter($title, $content, $postid);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le chapitre!');
    }
    else {
        header('Location: index.php');
    }
}

function delete($postId)
{
    $InscriptionManager = new \OpenClassrooms\Blog\Model\AdminManager();
    $affectedChapter = $InscriptionManager->deleteChapter($postId);

    header('Location: index.php');
}

function deleteComment($postId)
{
    $InscriptionManager = new \OpenClassrooms\Blog\Model\AdminManager();
    $affectedChapter = $InscriptionManager->deleteComment($postId);

    header('Location: index.php?action=manageComments');
}

function resetReport($postId)
{
    $InscriptionManager = new \OpenClassrooms\Blog\Model\AdminManager();
    $affectedChapter = $InscriptionManager->resetReport($postId);

    header('Location: index.php?action=manageComments');
}