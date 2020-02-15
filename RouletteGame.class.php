<?php

class RouletteGame
{
    private object $table;
    public int $balance = 500;

    public function __construct()
    {
        $this->table = new Table($this->balance);
    }

    public function play()
    {
        print 'Welcome to the Roulette game!' . PHP_EOL . 'Your balance is: '. $this->balance . PHP_EOL;

        $this->table->placeBet();

        $this->balance = $this->table->roll();

        if ($this->balance <= 0) {
            print "GAME OVER" . PHP_EOL;
            exit;
        }

        $playAgain = (string) readline('would you like to play again? Yes/No ');
        if (strtolower($playAgain) == 'yes' ) {
            self::play();
        }
    }
}