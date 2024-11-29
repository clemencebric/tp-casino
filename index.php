<?php 
use Models\Autoloader;
ini_set("date.timezone", "Europe/Paris");

require_once "./utils/Defines.php"; 
require_once "./models/Autoloader.php";
//require => on essaye d'importer le fichier à tout prix
//require_once => si le fichier est déja importé, on passe la ligne

/* on utilise l'autoloader pour importer tous les models */

Autoloader::register();
use Models\BDD;
use Models\Article;
use Models\Router;
use Controllers\ErrorsController;
use Controllers\ArticlesController;
use Controllers\BlogController;
use Controllers\RouletteController;

$article = new Article(BDD::connect());

$article_test =[
    "title" => "Test",
    "content" => "Contenu de test",
    "author" => "webdevoo"
];


/*utilisation classique de la classe article */
/*
$article->add (
    $article_test["title"],
    $article_test["content"],
    $article_test["author"],
);*/

/*
//crud => create read update delete

var_dump($article::getList()); //afficher la liste
echo "<hr/>";
var_dump($article::getById(1)); //afficher un element


$article_updated = [
    "id" => 1,
    "title" => "Test modifié",
    "content" => "Contenu modifié",
    "author" => "WebdevooUpdated",
    "created_date" => new Datetime("now")
];

$article::update(
    $article_updated["id"],
    $article_updated["title"],
    $article_updated["content"],
    $article_updated["author"],
    $article_updated["created_date"]->sub(\DateInterval::createFromDateString("1 hour"))->format("Y/m/d H:i:s"),
);

*/
$router = new Router();
 
$uri = $_SERVER["REQUEST_URI"];
$idParam = (int) preg_replace("/[\D]+/", "", $uri);
 
switch (true) {
    case ($uri === "/"):
      $router->get("/", BlogController::index());
      break;
    case ($uri === "/roulette"):
        $router->get("/roulette", RouletteController::index());
        exit;

    case ($uri === "/roulette/play"):
        RouletteController::play();
        break;
    
    case (str_contains($uri, "/articles")): //on va chercher dans $uri le /article, et si il y est on passe dans la boucle
      if ($idParam && !str_contains($uri,"/update")) {
        $router->get("/articles/$idParam", ArticlesController::getById($idParam));
        exit;
      }
      else if ($idParam && str_contains($uri, "/update")) {
        $router->get("/articles/update/$idParam", ArticlesController::update($idParam));
        exit;
      }
      else if(!$idParam && str_contains($uri, "/update")){
        $router->post("/articles/update", ArticlesController::updateArticle());
        exit;
      }
      else if(!$idParam && str_contains($uri, "/delete")){
        $router->post("/articles/delete", ArticlesController::deleteArticle());
        exit;
      }
      $router->get("/articles", ArticlesController::getList());
      break;
      default:
        ErrorsController::launchError("404");
        break;
  }
 

  
/*
$router->get("/", function() {
    echo "Page d'accueil";
});

$router->get("/articles", function() {
    var_dump(Article::getList());
});

$router->get("/articles/{id}", function(int $id) {
    if(!is_null($id)){
        var_dump(Article::getById($id));
    }
});
*/
$router->run();