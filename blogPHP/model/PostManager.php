<?php

namespace OpenClassrooms\Blog\Model;

require_once("Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $req = $this->getConnexion()->query('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y\') AS creation_date_fr, autor FROM article ORDER BY id DESC');

        return $req;
    }

    public function getPost($postId)
    {
        $req = $this->getConnexion()->prepare('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y\') AS creation_date_fr, autor FROM article WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }
}