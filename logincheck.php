<?php
session_start();

// Controllo se l'utente è loggato
if (!isset($_SESSION['loggedin'])) {
    // Se l'utente non è loggato, lo reindirizzo a sceltaspecie.php con un messaggio di avviso
    header("Location: sceltaspecie.php");
} else {
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }
    header("Location:pagamento.php");
}
?>