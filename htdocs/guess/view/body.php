<div class="container">
    <div class="contents">
        <h1>Guess My Number</h1>

        <p>Guess a number between 1 and 100, you have <?= $_SESSION["initGuess"]->tries() ?> tries left.</p>

        <form action="form_process.php" method="post">
            <input type="number" name="guessNr">
            <input type="submit" name="guessButton" value="Guess the number">
            <input type="submit" name="reset" value="Re-start the game">
            <input type="submit" name="useCheat" value="Cheat">
        </form>
    </div>
</div>
