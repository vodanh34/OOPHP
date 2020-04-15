<?php 

/**
* Exception class for GuessException
*/
class GuessException extends Exception
{
    public function __toString() 
    {
        return __CLASS__ . ": {$this->message}\n";
    }
}
