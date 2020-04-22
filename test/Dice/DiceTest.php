<?php

namespace Hile14\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test Dice Class
 */
class DiceTest extends TestCase
{
    /**
     * Test rollDice function.
     */
    public function testRollDice()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Hile14\Dice\Dice", $dice);
        
        $res = $dice->rollDice();
        $exp = $dice->getLastRoll();
        $this->assertEquals($exp, $res);
    }
}
