<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Redirect to the game init page and initialise the game if haven't else
 * goes directly to the game.
 */
$app->router->get("dice-game/init", function () use ($app) {
    if (!isset($_SESSION["diceHand"])) {
        $title = "Diceroll 100";

        $app->page->add("dice/init");

        return $app->page->render([
            "title" => $title
        ]);
    } else {
        return $app->response->redirect("dice-game/play");
    }
});

/**
 * Redirect to the game page and initialise the game.
 */
$app->router->post("dice-game/start", function () use ($app) {
    $_SESSION["diceHand"] = new Hile14\Dice\DiceHand($_POST["dices"]);
    $_SESSION["playerSum"] = 0;
    $_SESSION["turn"] = 1;
    $_SESSION["playerAmount"] = $_POST["players"];
    $_SESSION["winner"] = false;

    for ($i = 0; $i < ($_POST["players"] - 1); $i++) {
        $tempString = "computer" . ($i + 1) . "Sum";
        $_SESSION[$tempString] = 0;
    }

    return $app->response->redirect("dice-game/play");
});

/**
 * Play the game
 */
$app->router->get("dice-game/play", function () use ($app) {
    $title = "Diceroll 100";

    $app->page->add("dice/play");
    //$app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title
    ]);
});

/**
 * Processing the POST roll data
 */
$app->router->post("dice-game/process-roll", function () use ($app) {
    if ($_SESSION["winner"]) {
        $_SESSION["message"] = $_SESSION["winningUser"] . " has already won!";
    } else {
        $_SESSION["diceHand"]->roll();
        $_SESSION["diceRoll"] = $_SESSION["diceHand"]->values();
        $_SESSION["playerTempSum"] = $_SESSION["diceHand"]->sum();
        $_SESSION["endTurn"] = false;
        $_SESSION["saved"] = true;

        if (isset($_SESSION["message"])) {
            $_SESSION["message"] = null;
        }

        foreach ($_SESSION["diceRoll"] as $roll) {
            if ($roll === 1) {
                $_SESSION["endTurn"] = true;
            }
        }

        if ($_SESSION["endTurn"]) {
            $_SESSION["turn"] += 1;

            return $app->response->redirect("dice-game/process-cpu");
        }
    }

    return $app->response->redirect("dice-game/play");
});

/**
 * Processing the POST save data
 */
$app->router->post("dice-game/process-save", function () use ($app) {
    if ($_SESSION["winner"]) {
        $_SESSION["message"] = $_SESSION["winningUser"] . " has already won!";
    } else {
        if (isset($_SESSION["diceRoll"])) {
            if ($_SESSION["endTurn"]) {
                $_SESSION["message"] = "The previous turn has ended. " .
                    "Please re-roll the dice before saving for the new turn.";
                $_SESSION["saved"] = false;
            } elseif ($_SESSION["saved"]) {
                $_SESSION["diceSum"] += $_SESSION["diceHand"]->sum();
                if ($_SESSION["diceSum"] < 100) {
                    $_SESSION["saved"] = false;
                    $_SESSION["turn"] += 1;

                    return $app->response->redirect("dice-game/process-cpu");
                } else {
                    $_SESSION["winner"] = true;
                    $_SESSION["winningUser"] = "Player";
                    $_SESSION["message"] = "Congratulation! " . $_SESSION["winningUser"] .
                        " has Won!";
                }
            } elseif (!$_SESSION["saved"]) {
                $_SESSION["message"] = "You have already saved!";
            }
        }
    }

    return $app->response->redirect("dice-game/play");
});

/**
 * Processing the computer move
 */
$app->router->get("dice-game/process-cpu", function () use ($app) {
    for ($i = 0; $i < ($_SESSION["playerAmount"] - 1); $i++) {
        if (!$_SESSION["winner"]) {
            $tempStringSum = "computer" . ($i + 1) . "Sum";
            $tempStringValues = "computer" . ($i + 1) . "Values";
            $tempChecker = false;
            $_SESSION["diceHand"]->roll();
            $_SESSION[$tempStringValues] = $_SESSION["diceHand"]->values();

            foreach ($_SESSION[$tempStringValues] as $value) {
                if ($value === 1) {
                    $tempChecker = true;
                }
            }

            if (!$tempChecker) {
                $_SESSION[$tempStringSum] += $_SESSION["diceHand"]->sum();
            }

            if ($_SESSION[$tempStringSum] > 100) {
                $_SESSION["winner"] = true;
                $_SESSION["winningUser"] = "Computer" . ($i + 1);
                $_SESSION["message"] = "Congratulation!" . $_SESSION["winningUser"] .
                    " has Won!";
            }
        }
    }

    return $app->response->redirect("dice-game/play");
});
