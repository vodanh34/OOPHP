<?php
namespace Hile14\Dice;

class DiceHand
{
    private $dices;
    private $values;

    public function __construct(int $dices = 5)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
            $this->values[] = null;
        }
    }

    public function roll()
    {
        $temp = count($this->dices);
        for ($i = 0; $i < $temp; $i++) {
            $this->values[$i] = $this->dices[$i]->rollDice();
        }
    }

    public function values()
    {
        return $this->values;
    }

    public function sum()
    {
        $tempNr = 0;
        $temp = count($this->values);
        for ($i = 0; $i < $temp; $i++) {
            $tempNr += $this->values[$i];
        }
        return $tempNr;
    }
}
