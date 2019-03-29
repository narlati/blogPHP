<?php ob_start(); ?>
<div class="shadow-lg p-3 mb-5 bg-white rounded offset-md-1 col-md-10">
<div class="background-connection">
    <form action="index.php?action=connectionUser&amp;" method="post" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
            <label for="pseudo" class="sr-only">PSEUDO</label>
            <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="PSEUDO"/><br>
            <label for="password" class="sr-only">MOT DE PASSE</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="MOT DE PASSE"/><br>
            <input type="submit" value="CONNEXION" class="btn btn-lg btn-primary btn-block"/>
    </form>
</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
