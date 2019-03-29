<?php ob_start(); ?>
<div class="shadow-lg p-3 mb-5 bg-white rounded offset-md-1 col-md-10">
<p><a href="index.php">ACCUEIL</a></p>

<p>Remplissez le formulaire suivant pour vous inscrire :</p>

<form action="index.php?action=inscriptionUser&amp;" method="post">
    <div>
        <label for="pseudo">pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" />
    </div>
    <div>
        <label for="mail">adresse mail</label><br />
        <input type="email" id="mail" name="mail" />
    </div>
    <div>
        <label for="password">mot de passe</label><br />
        <input type="password" id="password" name="password" />
    </div>
    <div>
        <label for="password">verification du mot de passe</label><br />
        <input type="password" id="password2" name="password2" />
    </div>
    <div>
        <input type="submit" value="Confirmez l'inscription." />
    </div>
</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>


