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
        <div class="the-game">
            <h1>Diceroll 100</h1>
            <p><b>Turn: <?= $_SESSION["turn"] ?></b></p>
            <p class="dice-utf8">
                <?php
                if (isset($_SESSION["diceRoll"])) {
                    foreach ($_SESSION["diceRoll"] as $item) : ?>
                        <i class="dice-<?= $item ?>"></i>
                    <?php endforeach;
                }?></p>
            <p><?= isset($_SESSION["message"]) ? $_SESSION["message"] : null ?></p>
            <p>Roll Sum: <?= isset($_SESSION["playerTempSum"]) ?
                $_SESSION["playerTempSum"] : null ?></p>
            <p><?= isset($_SESSION["diceSum"]) ? "Total Score: " .
                $_SESSION["diceSum"] : null ?></p>
            <form action="process-roll" method="post">
                <input type="submit" value="Roll Dices" class="button"><br><br>
            </form>
            <form action="process-save" method="post">
                <input type="submit" value="Save Dices" class="button"><br><br>
            </form>
        </div>
        
        <div class="game-info">
            <h1>Game History</h1>
            <?php
            for ($i = 0; $i < ($_SESSION["playerAmount"] - 1); $i++) {
                $tempStringSum = "computer" . ($i + 1) . "Sum";
                $tempStringValues = "computer" . ($i + 1) . "Values";
                echo "<div>";
                echo "<h3>Computer" . ($i + 1) . "</h3>";
                if (isset($_SESSION[$tempStringValues])) {
                    echo "<p class=\"dice-utf8\">";
                    foreach ($_SESSION[$tempStringValues] as $value) {
                        echo "<i class=\"dice-" . $value . "\"></i>";
                    }
                    echo "</p>";
                }
                echo "<p>Total Score: " . $_SESSION[$tempStringSum] . "</p>";
                echo "</div>";
            }?>
        </div>
    </div>
</div>
