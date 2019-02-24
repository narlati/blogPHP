<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1>Mon super blog !</h1>
<form action="index.php?action=postNewChapter&amp;" method="post">


    <textarea class="myeditable-textarea" name="title">Modifiez le titre en cliquant ici.</textarea>
    <textarea class="myeditable-textarea" name="content">Ecrivez votre chapitre en cliquant ici.</textarea>
    <div>
        <input type="submit" />
    </div>

</form>

<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=d5q1jdupsghfho1anh2ljbby59ele3799np15qugih4dmm07"></script>
<script>
    tinymce.init({
        selector: '.myeditable-textarea',
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
