<?php
require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";
require __DIR__ . "/view/header.php";

if (!isset($_SESSION["initGuess"])) {
    $_SESSION["initGuess"] = new Guess();
    $_SESSION["initGuess"]->random();
}

require __DIR__ . "/view/body.php";

if (isset($_SESSION["message"])) {
    echo $_SESSION["message"];
}

require __DIR__ . "/view/footer.php";
