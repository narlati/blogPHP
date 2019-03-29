<?php ob_start(); ?>


<?php
while ($data = $posts->fetch())
{
    ?><div class="shadow-lg p-3 mb-5 bg-white rounded offset-md-1 col-md-10">
        <div class="jumbotron offset-md-2 col-md-8 bg-white rounded">
            <div class="col-md-12 px-0">
                <h1 class="display-4 font-italic"><?= $data['title'] ?></h1>
                <div class="lead my-3 text-truncate">
                    <?= $data['content'] ?>
                </div>

                <p class="lead mb-0"><a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="text-dark font-weight-bold"> <i class="fas fa-book"></i> Continuez la lecture et commentez</a></p>
                <?php
if (isset($_SESSION) && !empty  ($_SESSION))
{
?>
                <p class="lead mb-0"><a href="index.php?action=update&amp;id=<?= $data['id'] ?>" class="text-dark font-weight-bold"><i class="fas fa-edit"></i> Modifier ce chapitre </a></p>
                <p class="lead mb-0"><a href="index.php?action=delete&amp;id=<?= $data['id'] ?>" class="text-dark font-weight-bold"><i class="fas fa-trash-alt"></i> Supprimer ce chapitre</a></p>
<?php } ?>
            </div>
        </div>
    </div>
    <?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
