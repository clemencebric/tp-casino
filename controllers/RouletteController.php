<?php

namespace Controllers;

class RouletteController {
    public static function index() {
        require_once ROOT . "/views/roulette.php";
        require_once ROOT . "/templates/global.php";
    }
    // Symboles et leurs poids (proba d'apparition)
// Chaque symbole a une probabilité spécifique d’apparaître. Les symboles
//avec des gains élevés sont rendus plus rares.

    public static function play() {
        header('Content-Type: application/json');
        

        $symbols_with_weights = [
            '🍋' => 40,
            '🍒' => 30,
            '⭐' => 15,
            '🔔' => 10,
            '💎' => 5,
        ];
    
        // Table des gains (combinaison => gain)
        $paytable = [
            '🍋🍋🍋' => 40,
            '🍒🍒🍒' => 50,
            '⭐⭐⭐' => 100,
            '🔔🔔🔔' => 150,
            '💎💎💎' => 200,
        ];
    
        // Générer 3 symboles
        $reel1 = self::getRandomSymbol($symbols_with_weights);
        $reel2 = self::getRandomSymbol($symbols_with_weights);
        $reel3 = self::getRandomSymbol($symbols_with_weights);
        // Résultat de la machine à sous
        $combination = $reel1 . $reel2 . $reel3;
        // Calculer le gain
        $gain = $paytable[$combination] ?? 0;
        // Réponse JSON
        echo json_encode([
            'success' => true,
            'reels' => [$reel1, $reel2, $reel3],
            'gain' => $gain,
        ]);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    
        exit;
    }
    

    private static function getRandomSymbol($symbols_with_weights) {
        $rand = mt_rand(1, array_sum($symbols_with_weights)); // Générer un nombre aléatoire
        foreach ($symbols_with_weights as $symbol => $weight) {
        if ($rand <= $weight) {
        return $symbol;
        }
        $rand -= $weight; // Réduire le seuil
        }
        return null; // Cas improbable
    }
}
