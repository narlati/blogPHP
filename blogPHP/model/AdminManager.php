<?php

namespace OpenClassrooms\Blog\Model;

require_once("Manager.php");

class AdminManager extends Manager
{
    public function postNewChapter($title, $content)
    {

        $chapter = $this->getConnexion()->prepare('INSERT INTO article(title, content, date) VALUES(?, ?, NOW())');
        $affectedLines = $chapter->execute(array($title, $content));

        return $affectedLines;
    }

    public function updateChapter($title, $content, $postid)
    {
        $chapter = $this->getConnexion()->prepare('UPDATE article SET title = :title, content = :content WHERE id=:id');
        $chapter->bindParam(":title", $title);
        $chapter->bindParam(":content", $content);
        $chapter->bindParam(":id", $postid);
        $affectedLines = $chapter->execute();

        return $affectedLines;
    }

    public function deleteChapter($postId)
    {
        $chapter = $this->getConnexion()->prepare('DELETE FROM article WHERE id=:idChapter');
        $chapter->bindParam("idChapter", $postId);
        $affectedLines = $chapter->execute();

        $comment = $this->getConnexion()->prepare('DELETE FROM comment WHERE id_article=:idChapter');
        $comment->bindParam("idChapter", $postId);
        $affectedLines = $comment->execute();

        return $affectedLines;
    }

    public function deleteComment($commentId)
    {
        $comment = $this->getConnexion()->prepare('DELETE FROM comment WHERE id=:idComment');
        $comment->bindParam("idComment", $commentId);
        $affectedLines = $comment->execute();

        return $affectedLines;
    }

    public function resetReport($commentId)
    {
        $comment = $this->getConnexion()->prepare('UPDATE comment set report = 0 WHERE id=:idComment');
        $comment->bindParam("idComment", $commentId);
        $affectedLines = $comment->execute();

        return $affectedLines;
    }
}

