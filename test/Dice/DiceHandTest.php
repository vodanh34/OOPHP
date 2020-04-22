<?php

namespace Hile14\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test DiceHand Class
 */
class DiceHandTest extends TestCase
{
    /**
     * Test Constructor with 0 argument.
     */
    public function testConstructorNoArgument()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Hile14\Dice\DiceHand", $diceHand);

        $diceHand->roll();
        $res = count($diceHand->values());
        $exp = 5;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test Constructor with 1 argument.
     */
    public function testConstructorOneArgument()
    {
        $diceHand = new DiceHand(7);
        $this->assertInstanceOf("\Hile14\Dice\DiceHand", $diceHand);

        $diceHand->roll();
        $res = count($diceHand->values());
        $exp = 7;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test Sum function
     */
    public function testSumFunction()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Hile14\Dice\DiceHand", $diceHand);

        $diceHand->roll();
        $res = $diceHand->sum();
        $exp = array_sum($diceHand->values());
        $this->assertEquals($exp, $res);
    }
}
