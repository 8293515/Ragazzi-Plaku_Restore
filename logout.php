<?php
session_start();

// Distruggo tutte le variabili di sessione
session_unset();

// Distruggo la sessione
session_destroy();

header("Location: index.php")
    ?>