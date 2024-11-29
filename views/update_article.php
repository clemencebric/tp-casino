<?php
$headTitle = "Mise à jour d'un article";


if (!isset($article) || !$article){
    hearder("Location: /418");
}
ob_start();

?>
<section class="main-sections">
    <article class="main-articles">
        <h1 class="main-articles-title">
            <?= $headTitle ?>
        </h1>
        <form action="/articles/update" method="POST">
            <label for="title">
                Title 
            </label>
            <input type="text" name="title" id="title"/>
            <label for="author">
                Auteur
            </label>
            <input type="text" name="author" id="author">

            <label for="content"> 
                Contenu de l'article 
            </label>
            <input type="hidden" value="<?= $article->id?>"name="id" required />
            <input type="hidden" value="<?= $article->created_date ?>" name="created_date" required/>
            <textarea name="content" id="content"> <?= $article->content?> </textarea>
            
            <button type="submit" class="cbta-btns">
                Modifier
            </button>
        </form>
    </article>
</section>
<?php
$mainContent = ob_get_clean();