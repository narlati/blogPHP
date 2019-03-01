<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
    <h1>Mon super blog !</h1>
<?php
if (isset($_SESSION) && !empty  ($_SESSION))
{
    ?>
    <a href="index.php?action=disconnect&amp">Deconnection</a>
    <p>Bonjour <?php echo $_SESSION['pseudo'] ?> !</p>
    <a href="index.php?action=newChapter&amp">Ecriture nouveau chapitre <br></a>
    <a href="index.php?action=manageComments&amp">Gestion commentaires</a>
    <?php
}
else { ?>
    <a href="index.php?action=connection&amp">Connection</a>
    <a href="index.php?action=inscription&amp">Inscription</a>
<?php } ?>

    <p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch())
{
    ?>
    <div class="news">
        <h3>
            <?= $data['title'] ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
            <em> par <?= $data['autor'] ?></em>
        </h3>

        <div>
            <?= $data['content'] ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a>
            <a href="index.php?action=update&amp;id=<?= $data['id'] ?>">Modifier ce chapitre <br></a>
            <a href="index.php?action=delete&amp;id=<?= $data['id'] ?>">Supprimer ce chapitre</a></em>
        </div>
    </div>
    <?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
