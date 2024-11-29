<?php 

namespace Models;
//methode 2 pour pouvoir utiliser les methode natives sans utiliser les namespaces
//ajouter des anti slashs

class Article {

    //les mots clés d'accès sont : public, protected et private
    //on peut les typer
    public static int $id;
    public static string $title;
    public static string $content;
    public static string $author;
    public static string $created_date;
    public static string $modification_date;


    private static $bdd;

    public function __construct($bdd = null){

        if(!is_null($bdd)){
            self::setBdd($bdd);
        }
    }
    //id ------------------
    //accesseur
    public static function getId():int{//int = le type de retour
        return self::$id;//static : on utilise self::$variable  Methode classique on utilise $this->id ;
    }
    //setter
    public static function setId(int $id): void {
        self::$id = $id; 
    }

    //title-----------------

    //accesseur
    public static function getTitle():string{//int = le type de retour
        return self::$title;//static : on utilise self::$variable  Methode classique on utilise $this->id ;
    }
    //setter
    public static function setTitle(string $title): void {
        self::$title = $title; 
    }

    //content---------------

    public static function getContent():string{//int = le type de retour
        return self::$content;//static : on utilise self::$variable  Methode classique on utilise $this->id ;
    }
    //setter
    public static function setContent(string $content): void {
        self::$content = $content; 
    }
    
    //author-----------------

    public static function getAuthor():string{//int = le type de retour
        return self::$author;//static : on utilise self::$variable  Methode classique on utilise $this->id ;
    }
    //setter
    public static function setAuthor(string $author): void {
        self::$author = $author; 
    }

    //created Date-----------

    public static function getCreatedDate():string{//int = le type de retour
        return self::$created_date;//static : on utilise self::$variable  Methode classique on utilise $this->id ;
    }
    //setter
    public static function setCreatedDate(string $created_date): void {
        self::$created_date = $created_date; 
    }

    public static function getModificationDate(): \Datetime{//int = le type de retour
        $date = new \Datetime(self::$modification_date);
        return $date;//static : on utilise self::$variable  Methode classique on utilise $this->id ;
    }
    //setter
    public static function setModificationDate(string $modification_date): void {
        self::$modification_date = $modification_date; 
    }


    public static function setAllParams($params) {
        [
        "id" => $id,
        "title" => $title,
        "content" => $content,
        "author" => $author,
        "created_date" => $created_date,
        "modification_date" => $modification_date,
        ] = get_object_vars($params);
        self::setId($id);
        self::setTitle($title);
        self::setContent($content);
        self::setAuthor($author);
        self::setCreatedDate($created_date);
        self::setModificationDate($modification_date);

    }
    public static function add(
        string $title,
        string $content,
        string $author
    ): void {
        try {
            $req = self::$bdd->prepare("INSERT INTO articles(title, content, author) VALUES (:title, :content, :author)");
            $req->bindValue(":title", $title, \PDO::PARAM_STR); //on insigne des valeurs à :title et aux autres variables à changer
            $req->bindValue(":content", $content, \PDO::PARAM_STR);
            $req->bindValue(":author", $author, \PDO::PARAM_STR);

            if (!$req->execute()) {
                Utils::launchException("Une erreur s'est produite lors de l'ajout d'un article");
            };

            } catch (\Exception $e) {
                Utils::readException($e);
            }
        }

    public static function getList() {
        try {
            $req = self::$bdd->prepare("SELECT * FROM articles ORDER BY id ASC"); //du plus petit au plus grand (orde d'ajout)

            if (!$req->execute()) {
                Utils::launchException("une erreur c'est produite lors de la récupération de la liste des articles");
            }
            $articles = $req->fetchAll(\PDO::FETCH_OBJ);
            $req->closeCursor();//libérer le tampon mémoire qui conserve ... dans la bdd

            if(!$articles) {
                Utils::launchException("la table article est vide");
            }
            return $articles;

        } catch (\Exception $e) {
            Utils::readException($e);
        }
    }
    
    public static function getById(int $id) {
        try {
            $req = self::$bdd->prepare("SELECT * FROM articles WHERE id=:id");
            $req->bindValue(":id", $id, \PDO::PARAM_INT);

            if (!$req->execute()) {
                Utils::launchException("Une erreur s'est produite lors de la récupération de l'article");
            }

            $article = $req->fetch(\PDO::FETCH_OBJ);

            if (!$article){
                Utils::launchException("l'article ciblé est introuvable");
            }
            self::setAllParams($article);
            return $article;

        } catch(\Exception $e) {
            Utils::readException($e);
        }
    }
    public static function update(
        int $id,
        string $title,
        string $content,
        string $author,
        string $created_date
    ) {
        try {
            $req = self::$bdd->prepare("UPDATE articles SET title=:title, content=:content, author=:author, created_date=:created_date WHERE id=:id");
            $req->bindValue(":id", $id, \PDO::PARAM_INT);
            $req->bindValue(":title", $title, \PDO::PARAM_STR);
            $req->bindValue(":content", $content, \PDO::PARAM_STR);
            $req->bindValue(":author", $author, \PDO::PARAM_STR);
            $req->bindValue(":created_date", $created_date, \PDO::PARAM_STR);

            if (!$req->execute()) {
                Utils::launchException("Une erreur s'est produite lors de la mise à jour de l'article");
            }

            return true ;

        } catch (\Exception $e){
            Utils::readException($e);
        }
    }

/*
    public static function deleteAll() {
        return self::$bdd->exec("DELETE FROM articles");
    }
*/
    public static function deleteArticle(int $id) {
        return self::$bdd->exec("DELETE FROM articles WHERE id=$id");
    }
    //creer des methodes BDD
    public static function setBdd($bdd) {
        self::$bdd = $bdd;    
    }
}

?>