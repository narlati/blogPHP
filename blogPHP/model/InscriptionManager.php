<?php

namespace OpenClassrooms\Blog\Model;

require_once("Manager.php");

class InscriptionManager extends Manager
{
    public function postNewUser($pseudo, $pass_hash, $email)
    {
        $db = $this->dbConnect();
        $newUser = $db->prepare('INSERT INTO user(pseudo, password, mail) VALUES(?, ?, ?)');
        $affectedLines = $newUser->execute(array($pseudo, $pass_hash, $email));

        return $affectedLines;
    }

    public function isLoginUsed($pseudo) :bool
    {
        $db = $this->dbConnect();
        $loginAlreadyUsed = $db->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
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
        $db = $this->dbConnect();
        $mailAlreadyUsed = $db->prepare('SELECT * FROM user WHERE mail = :mail');
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
        $db = $this->dbConnect();
        $isLoginExisting = $db->prepare('SELECT id, password FROM user WHERE pseudo = :pseudo');
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
                session_start();
                $_SESSION['id'] = $result['id'];
                $_SESSION['pseudo'] = $result['pseudo'];
            }
            else
            {
                return FALSE;
            }
        }
        return TRUE;
    }
}