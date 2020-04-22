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
        <h1>Guess My Number</h1>

        <p>Guess a number between 1 and 100, you have <?= $_SESSION["initGuess"]->tries(); ?> tries left.</p>

        <form action="process" method="post">
            <input type="number" name="guessNb">
            <input type="submit" name="guessButton" value="Guess the number">
            <input type="submit" name="reset" value="Re-start the game">
            <input type="submit" name="cheat" value="Cheat">
        </form>
    </div>
</div>

<?php
if (isset($_SESSION["message"])) {
    echo $_SESSION["message"];
}
