<?php ob_start(); ?>

    <p class="btn">Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch())
{
    ?>
        <div class="jumbotron offset-md-3 col-md-6 p-3 p-md-5 text-white rounded bg-dark">
            <div class="col-md-12 px-0">
                <h1 class="display-4 font-italic"><?= $data['title'] ?></h1>
                <div class="lead my-3 text-truncate">
                    <?= $data['content'] ?>
                </div>

                <p class="lead mb-0"><a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="text-white font-weight-bold">Continuez la lecture et commentez</a></p>
                <?php
if (isset($_SESSION) && !empty  ($_SESSION))
{
?>
                <p class="lead mb-0"><a href="index.php?action=update&amp;id=<?= $data['id'] ?>" class="text-white font-weight-bold">Modifier ce chapitre </a></p>
                <p class="lead mb-0"><a href="index.php?action=delete&amp;id=<?= $data['id'] ?>" class="text-white font-weight-bold">Supprimer ce chapitre</a></p>
<?php } ?>
            </div>
        </div>
    <?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
