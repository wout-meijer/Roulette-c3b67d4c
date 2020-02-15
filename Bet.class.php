<?php


class Bet
{
    public int $amount;
    public string $type;

    public function __construct($amount, $type)
    {
        $this->amount = $amount;
        $this->type = $type;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getType()
    {
        return $this->type;
    }
}