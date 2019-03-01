<?php

namespace OpenClassrooms\Blog\Model;

require_once("Manager.php");

class AdminManager extends Manager
{
    public function postNewChapter($title, $content)
    {
        $db = $this->dbConnect();
        $chapter = $db->prepare('INSERT INTO article(title, content, date) VALUES(?, ?, NOW())');
        $affectedLines = $chapter->execute(array($title, $content));

        return $affectedLines;
    }

    public function updateChapter($title, $content, $postid)
    {
        $db = $this->dbConnect();
        $chapter = $db->prepare('UPDATE article SET title = :title, content = :content WHERE id=:id');
        $chapter->bindParam(":title", $title);
        $chapter->bindParam(":content", $content);
        $chapter->bindParam(":id", $postid);
        $affectedLines = $chapter->execute();

        return $affectedLines;
    }

    public function deleteChapter($postId)
    {
        $db = $this->dbConnect();
        $chapter = $db->prepare('DELETE FROM article WHERE id=:idChapter');
        $chapter->bindParam("idChapter", $postId);
        $affectedLines = $chapter->execute();

        $comment = $db->prepare('DELETE FROM comment WHERE id_article=:idChapter');
        $comment->bindParam("idChapter", $postId);
        $affectedLines = $comment->execute();

        return $affectedLines;
    }
}

