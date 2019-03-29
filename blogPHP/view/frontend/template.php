<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Jean Forteroche</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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

    <div class="bg1" ></div>
<div class="main">
<?= $content ?>
</div>

<footer class="page-footer font-small text-white bg-dark">

    <div class="footer-copyright text-center py-3">© 2019 Copyright: Jean Forteroche
    </div>

</footer>
</body>
</html>