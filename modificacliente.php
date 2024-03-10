<?php
session_start();

// Connessione al database
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Recupera dati dall'utente
$emailCliente = $_SESSION['username'];
$campo = $_POST['campo'];
$valore = $_POST['valore'];

// Prepara la query per l'aggiornamento
$queryAggiornamento = "UPDATE clienti SET $campo = ? WHERE Email = ?";
$stmtAggiornamento = $conn->prepare($queryAggiornamento);
$stmtAggiornamento->bind_param("ss", $valore, $emailCliente);

// Esegui l'aggiornamento e verifica il successo
if ($stmtAggiornamento->execute()) {
    echo "success";
} else {
    echo "error";
}

// Chiudi la connessione al database
$stmtAggiornamento->close();
$conn->close();
?>