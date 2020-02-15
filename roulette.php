<?php

spl_autoload_register(function($className) {
    include_once $className . '.class' . '.php';
});

class roulette
{
    public function welcome()
    {
        $rouletteGame = new RouletteGame();
        $rouletteGame->play();
    }

}

$roulette = new roulette();
$roulette->welcome();