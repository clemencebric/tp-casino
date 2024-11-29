<?php

namespace Models;
use PDO;
use Exception;
class BDD{
    public static function connect() {
        $database = parse_ini_file(ROOT."/config/bdd.ini");
        $host = $database["host"];
        $dbname= $database["dbname"];
        $username= $database["username"];
        $password= $database["password"];

        try {

            $bdd = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8", //dsn = ou est ce que l'on va aller cibler la bdd config du serveur de bdd
                $username,
                $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT]
            );

            return $bdd;//retourner quelque chose

        } catch (Exception $e ) {
            die("erreur:". $e->getMessage());
        }
    }
}

?>