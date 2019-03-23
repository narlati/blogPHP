<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet"/>
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php">Jean Forteroche</a>
    <div class=" navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
<?php
if (isset($_SESSION) && !empty  ($_SESSION))
{
    ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=newChapter">Ecrivez un nouveau chapitre</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=manageComments">Gerez les commentaires</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=disconnect">Deconnexion</a>
    </li>
    <?php
}
else { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=connection">Connexion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="index.php?action=inscription">Inscription</a>
    </li>

<?php } ?>
        </ul>
    </div>
</nav>
<div class="bg">
    <img src="public/images/background.png" alt="background-writer-content">
</div>
<div class="main">
<?= $content ?>
</div>
</body>
</html>