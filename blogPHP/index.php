<?php
require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                    reportComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'inscription') {
            inscriptionPage();
        }
        elseif ($_GET['action'] == 'inscriptionUser') {
            if (!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
                verificationInformations($_POST['pseudo'], $_POST['password'], $_POST['password2'], $_POST['mail']);
            }
            else {
                throw new Exception('formulaire incomplet ici.');
            }
        }
        elseif ($_GET['action'] == 'connection') {
            connectionPage();
        }
        elseif ($_GET['action'] == 'connectionUser')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                verificationConnectionLog($_POST['pseudo'], $_POST['password']);
            }
            else {
                throw new Exception('erreur identifiant et/ou mot de passe.');
            }
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
