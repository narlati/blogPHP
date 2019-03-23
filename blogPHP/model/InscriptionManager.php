<?php

namespace OpenClassrooms\Blog\Model;

require_once("Manager.php");

class InscriptionManager extends Manager
{
    public function postNewUser($pseudo, $pass_hash, $email)
    {
        $newUser = $this->getConnexion()->prepare('INSERT INTO user(pseudo, password, mail) VALUES(?, ?, ?)');
        $affectedLines = $newUser->execute(array($pseudo, $pass_hash, $email));

        return $affectedLines;
    }

    public function isLoginUsed($pseudo) :bool
    {
        $loginAlreadyUsed = $this->getConnexion()->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
        $loginAlreadyUsed->bindParam(":pseudo", $pseudo);
        $loginAlreadyUsed->execute();

        if ($loginAlreadyUsed->rowCount() !== 0)
        {
            return FALSE;
        }
        return TRUE;
    }

    public function isMailUsed($mail) :bool
    {
        $mailAlreadyUsed = $this->getConnexion()->prepare('SELECT * FROM user WHERE mail = :mail');
        $mailAlreadyUsed->bindParam(":mail", $mail);
        $mailAlreadyUsed->execute();

        if ($mailAlreadyUsed->rowCount() !== 0)
        {
            return FALSE;
        }
        return TRUE;
    }

    public function verifyLogin($pseudo, $password)
    {
        $isLoginExisting = $this->getConnexion()->prepare('SELECT id, password FROM user WHERE pseudo = :pseudo');
        $isLoginExisting->bindParam(":pseudo", $pseudo);
        $isLoginExisting->execute();
        $result = $isLoginExisting->fetch();

        $isPasswordCorrect = password_verify($password, $result['password']);

        if (!$result)
    {
        return FALSE;
    }

        else
        {
            if ($isPasswordCorrect)
            {
                $_SESSION['id'] = $result['id'];
                $_SESSION['pseudo'] = $pseudo;
            }
            else
            {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function DisconnectUser():bool
    {
        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
        {
            session_destroy();
            return TRUE;
        }
        else {
            return FALSE;
        }

    }

}