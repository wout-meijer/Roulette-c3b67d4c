<?php


class Table
{
    private array $bets;
    private int $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }

    public function addBet($bet)
    {
        $this->bets[] = $bet;
    }

    public function placeBet()
    {
        $amount = (int) readline('How much would you like to bet: ' . PHP_EOL);

        if ($amount > $this->balance) {
            print('Invalid input, please try again' . PHP_EOL);
            self::placeBet();
        }

        print('What would you like to bet on?' . PHP_EOL);
        echo "1) Number" . PHP_EOL;
        echo "2) Odd/Even" . PHP_EOL;
        echo "3) Red/Black" . PHP_EOL;

        $input = (int) readline("Chose a number: ");

        $type = '';
        switch ($input) {
            case 1:
                $type =  [
                  'betType'   => 'number',
                  'userInput' => (int) readline("What number would you like to bet on? ")
                ];
                break;
            case 2:
                $type = [
                    'betType'   => 'oddEven',
                    'userInput' => (string) readline("Would you like to bet on odd or even? ")
                ];
                break;
            case 3:
                $type = [
                    'betType'   => 'color',
                    'userInput' => (string) readline("What color would you like to bet on? ")
                ];
                break;
            default:
                print('Invalid input, please try again' . PHP_EOL);
                self::placeBet();
        }

        $bet = new Bet($amount, self::sanitizeType($type));
        $this->balance = $this->balance - $amount;
        $this->addBet($bet);

        $anotherBet = (string) readline('would you like to add another bet? Yes/No ');
        if (strtolower($anotherBet) == 'yes' ) {
            self::placeBet();
        }
    }

    public function roll()
    {
        print 'rolling..' . PHP_EOL;

        sleep(1);

        $wheel = new Wheel();
        $roll = $wheel->roll();

        $newBalance = $this->balance;
        foreach ($this->bets as $bet) {
            if ($roll->color == $bet->type ?? $roll->oddEven == $bet->type) {
                $newBalance +=  $bet->amount * 2;
            } elseif($roll->number == $bet->type) {
                $newBalance += $bet->amount * 35;
            }
        }
        print('Rolled: ' . $roll->number . ' ' . $roll->color . ' your new balance is: ' . $newBalance . PHP_EOL);

        sleep(1);

       return $newBalance;
    }

    private function sanitizeType($type)
    {
        $isValid = false;
        switch ($type['betType']) {
            case 'number':
                $isValid = $this->isInRange($type['userInput'], 1, 36);
                break;
            case 'oddEven':
                $isValid = $this->isAnOption($type['userInput'], 'odd', 'even');
                break;
            case 'color':
                $isValid = $this->isAnOption($type['userInput'], 'red', 'black');
                break;
        }

        if ($isValid) {
            return strtolower($type['userInput']);
        }

        print('Invalid input, please try again'. PHP_EOL);
        $this->placeBet();
    }

    private function isInRange($val, $min, $max): bool
    {
        return ($val >= $min && $val <= $max);
    }

    private function isAnOption($val, $first, $second): bool
    {
        return (strtolower($val) == $first || strtolower($val) == $second);
    }
}