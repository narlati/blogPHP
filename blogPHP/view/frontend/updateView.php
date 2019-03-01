<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1>Mon super blog !</h1>
<form action="index.php?action=updateChapter&amp;id=<?= $post['id'] ?>" method="post">

    <textarea class="myeditable-textarea" name="title"> <?= $post['title'] ?></textarea>
    <textarea class="myeditable-textarea" name="content"> <?= $post['content'] ?></textarea>
    <div>
        <input type="submit" />
    </div>

</form>

<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=d5q1jdupsghfho1anh2ljbby59ele3799np15qugih4dmm07"></script>
<script>
    tinymce.init({
        selector: '.myeditable-textarea',
        protect: [
            /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
            /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
            /<\?php.*?\?>/g  // Protect php code
        ],
        content_css : 'public/css/style.css'
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
