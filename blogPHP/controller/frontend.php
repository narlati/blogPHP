<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/InscriptionManager.php');

function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostView.php');
}

function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

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

function reportComment($commentId)
{
    $reportManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $commentReported = $reportManager->setReport($commentId);

    if ($commentReported === false) {
        throw new Exception('Impossible de report ce commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $commentId);
    }
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
        $pass_hache = password_hash($password, PASSWORD_DEFAULT);
    }
    else
    {
        throw new Exception('Les deux mots de passes ne sont pas identiques ou ne contient pas au minimum 4 caracteres.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        throw new Exception('L\'adresse mail est incorrect.');
    }

    if (!$checkmail = $inscriptionManager->isMailUsed($email))
    {
        throw new Exception('Cette adresse mail est deja prise :( .');
    }

    $affectedLines = $inscriptionManager->postNewUser($pseudo, $pass_hache, $email);

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
        throw new Exception('Mauvais pseudo ou mot de passe.');
    }

    $pseudo = trim($pseudo);
    $login = $inscriptionManager->verifyLogin($pseudo, $password);
    if ($login === false) {
        throw new Exception('Mauvais pseudo ou mot de passe.');
    }
    else {
        header('Location: index.php');
    }
}