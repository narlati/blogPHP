<?php ob_start(); ?>
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <main class="inner cover error">
        <p class="cover-heading text-light text-center">Oups, il n'y a rien ici !</p>
    </main>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>