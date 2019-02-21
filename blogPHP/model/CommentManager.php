<?php

namespace OpenClassrooms\Blog\Model;

require_once("Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, name, content, DATE_FORMAT(date, \'%d/%m/%Y\') AS comment_date_fr,report FROM comment WHERE id_article = ?');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comment(id_article, name, content, date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function setReport($commentId)
    {
        $db = $this->dbConnect();
        $report = $db->prepare("UPDATE comment SET report = report+1 WHERE id = ?");
        $report->execute(array($commentId));

        return $report;
    }
}