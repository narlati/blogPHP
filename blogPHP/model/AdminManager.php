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
}

