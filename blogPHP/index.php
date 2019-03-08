<?php
require('controller/controller.php');

try {
    session_start();
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post($_GET['id']);
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
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idp']) && $_GET['idp'] > 0) {
                    reportComment($_GET['id'], $_GET['idp']);
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
        elseif ($_GET['action'] == 'disconnect')
        {
            disconnectUser();
        }
        elseif ($_GET['action'] == 'newChapter') {
            if (!isset($_SESSION['id']))
            {
                connectionPage();
            } else {
                newChapter();
            }
        }
        elseif ($_GET['action'] == 'postNewChapter') {
            if (!isset($_SESSION['id']))
            {
                connectionPage();
            } else {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    postNewChapter($_POST['title'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
        elseif ($_GET['action'] == 'update') {
            if (!isset($_SESSION['id']))
            {
                connectionPage();
            } else {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    update();
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }
        }
        elseif ($_GET['action'] == 'updateChapter') {
            if (!isset($_SESSION['id']))
            {
                connectionPage();
            } else {
                    updateChapter($_POST['title'], $_POST['content'], ($_GET['id']));
            }
        }
        elseif ($_GET['action'] == 'delete') {
            if (!isset($_SESSION['id'])) {
                connectionPage();
            } else {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    delete($_GET['id']);
                }
                else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }

        }
        elseif ($_GET['action'] == 'manageComments') {
            if (!isset($_SESSION['id']))
            {
                connectionPage();
            } else {
                manageComment();
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if (!isset($_SESSION['id'])) {
                connectionPage();
            } else {
                deleteComment($_GET['id']);
            }
        }
        elseif ($_GET['action'] == 'reset') {
            if (!isset($_SESSION['id'])) {
                connectionPage();
            } else {
                resetReport($_GET['id']);
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
