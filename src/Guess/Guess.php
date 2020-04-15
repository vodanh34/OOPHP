<?php

namespace Hile14\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
    * @var int $number The current secret number. 
    * @var int $tries Number of tries a guess has been made.
    * @var bool $winner A boolean set to FALSE as default.
    */
    private $number;
    private $tries;
    private $winner = false;

    /**
    * Constructor to initiate the object with current game settings,
    * if available. Randomize the current number if no value is sent in.
    * @param int $number The current secret number, default -1 to initiate
    * the number from start.
    * @param int $tries Number of tries a guess has been made, default 6.
    */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        if ($number === -1) {
            $this->number = rand(1, 100);
        }
        $this->tries = $tries;
    }

    /**
    * Randomize the secret number between 1 and 100 to initiate a new game.
    * @return void
    */
    public function random()
    {
        $this->number = rand(1, 100);
    }

    /**
    * Get number of tries left.
    * @return int as number of tries made.
    */
    public function tries()
    {
        return $this->tries;
    }

    /**
    * Get the secret number.
    * @return int as the secret number.
    */
    public function number()
    {
        return $this->number;
    }

    /**
    * Get the winner data.
    * @return bool as bool to see if the game is over.
    */
    /*
    public function hasWinner()
    {
        return $this->winner;
    }*/

    /**
    * Make a guess, decrease remaining guesses and return a string stating
    * if the guess was correct, too low or to high or if no guesses remains.
    * @throws GuessException when guessed number is out of bounds.
    * @return string to show the status of the guess made.
    */
    public function makeGuess($number)
    {
        if (!$this->winner) {
            if ($number > 100 or $number < 1) {
                throw new GuessException("The number is out of bound.");
            } else {
                $res = "<p>Your Guess: {$number} and it's ";
                --$this->tries;
                if ($number === $this->number) {
                    $res .= "CORRECT and you have WON!</p>";
                    $this->winner = true;
                } elseif ($number > $this->number) {
                    $res .= "TOO HIGH</p>";
                } else {
                    $res .= "TOO LOW</p>";
                }

                return $res;
            }
        } else {
            $res = "<p>You have ALREADY WON! Please hit Re-start to play again.</p>";
            return $res;
        }
    }
}
