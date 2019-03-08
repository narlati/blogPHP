<?php ob_start(); ?>
    <p class="btn">Les commentaires ayant ete report :</p>

<?php
while ($data = $comment->fetch())
{
    ?>
    <div class="news jumbotron offset-md-3 col-md-6 p-3 p-md-5 text-white rounded bg-dark">
        <p class="blog-post-meta">
            le <?= $data['comment_date_fr'] ?>
            par <?= $data['name'] ?>
        </p>

        <div>
            <?= $data['content'] ?>
            <br/>
            <a href="index.php?action=reset&amp;id=<?= $data['id'] ?>" class="btn btn-success">Accepter ce commentaire<br></a>
                <a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" class="btn btn-danger">Supprimer ce commentaire</a>
        </div>
    </div>
    <?php
}
$comment->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>