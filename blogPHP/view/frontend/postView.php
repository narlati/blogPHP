<?php $title = htmlspecialchars($post['title']);?>

<?php ob_start(); ?>
    <h1>Mon super blog !</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?= $post['title'] ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= $post['content'] ?>
        </p>
    </div>

    <h2>Commentaires</h2>

    <form action="index.php?action=addComment&amp;id=<?= $post['id']?>" method="post">
        <div>
            <label for="author">Auteur</label><br/>
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br/>
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<?php
while ($comment = $comments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['name']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>



    <form action="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>" method="post">
        <input type="submit" value="Signalez le commentaire">
    </form>

    <?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>

