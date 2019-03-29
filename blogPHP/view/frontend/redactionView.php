<?php ob_start(); ?>
<div class="shadow-lg p-3 mb-5 bg-white rounded offset-md-1 col-md-10">

<p class="btn" xmlns="http://www.w3.org/1999/html"> Ecrivez votre prochain chapitre :</p>

<form action="index.php?action=postNewChapter&amp;" method="post" class="needs-validation offset-md-3 col-md-6">
    <input type="text" name="title" class="form-control" placeholder="Titre du chapitre">
    <br>
    <textarea class="myeditable-textarea form-control" name="content" >Ecrivez votre chapitre en cliquant ici.</textarea>
    <br>
    <input type="submit" class="btn btn-success btn-lg offset-md-5"/>
</form>

</div>

<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=d5q1jdupsghfho1anh2ljbby59ele3799np15qugih4dmm07"></script>
<script>
    tinymce.init({
        selector: '.myeditable-textarea',
        protect: [
            /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
            /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
            /<\?php.*?\?>/g  // Protect php code
        ],
        invalid_styles : 'background-color,color,font-size,padding,margin,text-align,font-family',
        paste_as_text: true
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
