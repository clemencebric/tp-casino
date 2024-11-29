<?php

$headTitle = "Roulette";

ob_start();


?>
<link rel="stylesheet" href="../sources/css/roulette.css">
<script src="../sources/js/roulettejs.js" defer></script>


<section class="container">
        <div class="carte-roulette">
        <h1 class="main-articles-title">
            bienvenue sur la roulette !
        </h1>
  
        <div class="dessous-roulette">
        <article class="slot-machine">
            <div class="reel" id="reel1">🍒</div>
            <div class="reel" id="reel2">🍒</div>
            <div class="reel" id="reel3">🍒</div>
        </div>
            <button id="spinButton">Lancer</button>
            <div id="result" class="partie-message">Essayez de tirer !</div>
        </article>
        </div>
       
   
</section>

<?php
$mainContent = ob_get_clean();
