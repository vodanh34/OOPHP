<?php

namespace Anax\View;

/**
 * Render content within an article.
 */
// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<div class="container">
    <div class="contents">
        <h1>Diceroll 100</h1>
        <p>Please enter the number of players and dices you wish to play against/with.<p>
        <form class="init-dice-game" action="start" method="post">
            <label class="input-label-dice" for="players">Number of Players:</label>
            <input type="number" name="players" min="2" required>
            <label class="input-label-dice" for="dices">Number of Dices:</label>
            <input type="number" name="dices" min="2" required>
            <input class="init-dice-game-button buttom" type="submit" value="Start The Game"><br><br>
        </form>
    </div>
</div>