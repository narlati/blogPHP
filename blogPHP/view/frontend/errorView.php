<?php ob_start(); ?>
    <div class="shadow-lg p-3 mb-5 bg-white rounded offset-md-1 col-md-10">
    <main class="inner cover error">
        <p class="cover-heading text-light text-center">Oups, il n'y a rien ici !</p>
    </main>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>