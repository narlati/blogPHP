<?php ob_start(); ?>
    <div class="offset-md-3 col-md-6 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title"><?= $post['title'] ?></h2>
            <p class="blog-post-meta">le <?= $post['creation_date_fr'] ?></p>
            <p><?= $post['content'] ?></p>
        </div>


    <form action="index.php?action=addComment&amp;id=<?= $post['id']?>" method="post">
        <div class="form-group">
            <label for="author"></label>
            <input type="text" class="form-control" id="author" name="author" placeholder="votre pseudo"/>
        </div>
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea id="comment" class="form-control" name="comment" placeholder="Votre commentaire"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Validez</button>
    </form>

    <br>

    <?php
    while ($comment = $comments->fetch())
    {
        ?>
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">

        <div class="col-md-12 px-0">

        <p><strong><?= htmlspecialchars($comment['name']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>

        <form action="index.php?action=reportComment&amp;id=<?= $comment['id']?>&amp;idp=<?= $post['id']?>" method="post">
            <input type="submit" value="Signalez le commentaire">
        </form>
        </div>
    </div>

<?php
    }
    ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>

