<?php

namespace Hile14\Dice;

/**
* Dice class to roll the dice
*/
class Dice
{
    private $number;
    private $lastRoll;

    public function rollDice()
    {
        $this->number = rand(1, 6);
        $this->lastRoll = $this->number;
        return $this->number;
    }

    public function getLastRoll()
    {
        return $this->lastRoll;
    }
}
