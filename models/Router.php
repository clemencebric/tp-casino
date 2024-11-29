<?php
namespace Models;

class Router{

    private $routes = [];

    public function get($uri, $callback) {//this-> est equivalant de self:: mais pour une fonction pas statique 
        $this->routes["GET"][$uri]= $callback; //on va cibles l'uri avec requête GET et on déclanche un callback (un particulier en fonction de l'uri)
    }
//le $ est avant this donc pas besoin de le mettre devant routes
    public function post($uri, $callback) {//this-> est equivalant de self:: mais pour une fonction pas statique 
        $this->routes["POST"][$uri]= $callback; //on va cibles l'uri avec requête GET et on déclanche un callback (un particulier en fonction de l'uri)
    }

    public function run() {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);//PHP_URL_PATH => 
        $method = $_SERVER["REQUEST_METHOD"];

        if(!isset($this->routes[$method][$uri])){
            echo "Page introuvable";
            exit;
        }
        call_user_func($this->routes[$method][$uri]);//call_user_func methode qui permet de déclancher une fonction
    }
}