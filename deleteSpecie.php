<?php
// Connessione al database (sostituisci con le tue credenziali)
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Ottieni l'ID della specie da eliminare
$specieId = $_POST['specieId'];

// Query per eliminare la specie
$queryDeleteSpecie = "DELETE FROM Specie WHERE NomeScientifico = '$specieId'";

if ($conn->query($queryDeleteSpecie) === TRUE) {
    echo "Specie eliminata con successo.";
} else {
    echo "Errore durante l'eliminazione della specie: " . $conn->error;
}

// Chiudi la connessione al database
$conn->close();
?>