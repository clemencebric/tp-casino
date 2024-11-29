<?php

namespace Models;
//consinuer a utiliser les classes natives de php
//methode 1
use Exception; //on continue de pouvoir utiliser cette methode native de php, elle a son propre namespace

class Utils {
    public static function launchException(string $message) {
        throw new Exception($message);
    }

    public static function readException(Exception $e) {
        die ("Erreur : ". $e->getMessage());
    }

}
