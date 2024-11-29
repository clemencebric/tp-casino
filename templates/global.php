<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="<?= "/sources/css/style.css?v=" . filemtime(ROOT."/sources/css/style.css") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $headTitle ?? "BLogVoyage" ?></title>
   
</head>
<body>
    <header class="main-head"> 
        <!--contiendra le logo le nom du site et le menu de navigation-->
        <figure class="logo-figure">
            <img src="<?= "/assets/logo/logo.png"  ?>" alt="Logo blog voyage" class="logo-img"/>
            <figcaption class="logo-text">
                <h1>Blog Voyage </h1>
            </figcaption>
        </figure>
        <nav class="main-nav">
            <ul class="main-nav-links">
                <li><a href="/">Accueil</a></li>
                <li><a href="/articles">Nos articles</a></li>
                <li><a href="/articles/1">Article 1</a></li>
                <li><a href="/roulette">Jouer</a></li>
                <li><a href="/contact">Contact</a></li>
               
            </ul>
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>


    </header>

    <main class="main-content"> 
        <?= $mainContent?? "Erreur 404" ?>
    </main>

    <footer class="main-foot">
        <!--liens légaux coordonnées copyright-->
        <p class="copyright"> © Clemence - 2024 </p>
    
    </footer>
    <script src="<?= "/sources/js/burger.js?v=" . filemtime(ROOT."/sources/js/burger.js") ?>"></script>
    
</body>
</html>