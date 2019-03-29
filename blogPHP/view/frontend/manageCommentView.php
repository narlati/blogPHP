<?php ob_start(); ?>
    <div class="shadow-lg p-3 mb-5 bg-white rounded offset-md-1 col-md-10">
    <p class="btn">Les commentaires ayant été signalés :</p>


<?php

    if ($data = $comment->fetch()) {
        do {
            ?><div class="shadow-sm p-3 mb-5 bg-white rounded offset-md-1 col-md-10">
            <div class="jumbotron offset-md-2 col-md-8 bg-white rounded">
                <p class="blog-post-meta">
                    le <?= $data['comment_date_fr'] ?>
                    par <?= $data['name'] ?>
                </p>

                <div>
                    <?= $data['content'] ?>
                    <br/>
                    <a href="index.php?action=reset&amp;id=<?= $data['id'] ?>" class="btn btn-success">Accepter ce
                        commentaire<br></a>
                    <a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" class="btn btn-danger">Supprimer
                        ce commentaire</a>
                </div>
            </div>
            </div>
            <?php
        } while ($data = $comment->fetch());
    }
        else
        {
            ?>
            <div class="=shadow-lg p-3 mb-5 bg-white rounded offset-md-1 col-md-10">
            <div class="jumbotron offset-md-2 col-md-8 bg-white rounded">
            <p class="blog-post-meta">
                Aucun commentaire signalé, travail terminé !
            </p>
            </div>
            </div>
            <?php
        }
    $comment->closeCursor();
?>    </div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>