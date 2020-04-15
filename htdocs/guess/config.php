<?php
/**
 * Set the error reporting.
 */
error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors

/**
 * Default exception handler.
 */
set_exception_handler(function ($e) {
    echo "<p>Anax: Uncaught exception:</p><p>Line "
        . $e->getLine()
        . " in file "
        . $e->getFile()
        . "</p><p><code>"
        . get_class($e)
        . "</code></p><p>"
        . $e->getMessage()
        . "</p><p>Code: "
        . $e->getCode()
        . "</p><pre>"
        . $e->getTraceAsString()
        . "</pre>";
});

// Starts the session
session_name("hile14");
session_start();

function destroySession() 
{
    // Unset all of the session variables.
    $_SESSION = [];

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
    return "<p>The game has been restarted!</p>";
}
