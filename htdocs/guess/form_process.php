<?php

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

$guessNumber = $_POST["guessNr"] ?? null;
$guessBtn = $_POST["guessButton"] ?? null;
$restart = $_POST["reset"] ?? null;
$cheat = $_POST["useCheat"] ?? null;

if ($guessBtn != null and $_SESSION["tries"] >= 1) {
    try {
        $tempResult = $_SESSION["initGuess"]->makeGuess((int)$guessNumber);
        $_SESSION["message"] = $tempResult;
    } catch (GuessException $e) {
        $_SESSION["message"] = "<p>{$e}</p>";
    }
} elseif ($restart != null) {
    destroySession();
} elseif ($cheat != null) {
    $_SESSION["message"] = "<p>The correct number is: {$_SESSION["initGuess"]->number()}";
}

$url = "index.php";
header("Location: $url");
