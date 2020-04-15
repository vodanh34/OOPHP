<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Redirect to the game page and initialise the game.
 */
$app->router->get("guess-game/start", function () use ($app) {
    //Initialise the game with neccessarily values
    if (!isset($_SESSION["initGuess"])) {
        $_SESSION["initGuess"] = new Hile14\Guess\Guess();
    }

    return $app->response->redirect("guess-game/play");
});

/**
 * Play the game
 */
$app->router->get("guess-game/play", function () use ($app) {
    $title = "Guess My Number";

    $app->page->add("guess/play");
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Processing the POST data
 */
$app->router->post("guess-game/process", function () use ($app) {
    $guessNumber = $_POST["guessNb"] ?? null;
    $guessBtn = $_POST["guessButton"] ?? null;
    $restart = $_POST["reset"] ?? null;
    $cheat = $_POST["cheat"] ?? null;

    if ($guessBtn != null and $_SESSION["initGuess"]->tries() >= 1) {
        try {
            $tempResult = $_SESSION["initGuess"]->makeGuess((int)$guessNumber);
            $_SESSION["message"] = $tempResult;
        } catch (GuessException $e) {
            $_SESSION["message"] = "<p>{$e}</p>";
        } //finally {
        //     return $app->response->redirect("guess-game/play");
        // }
    } elseif ($restart != null) {
        $_SESSION["initGuess"] = new Hile14\Guess\Guess();
        $_SESSION["message"] = "";
    } elseif ($cheat != null) {
        $_SESSION["message"] = "<p>The correct number is: {$_SESSION["initGuess"]->number()}";
    }

    return $app->response->redirect("guess-game/play");
});
