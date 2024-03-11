<?php
// Connessione al database (sostituisci con le tue credenziali)
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Ottieni l'ID della biodiversità da eliminare
$biodiversitaId = $_POST['biodiversitaId'];

// Query per eliminare la biodiversità
$queryDeleteBiodiversita = "DELETE FROM Biodiversita WHERE Id_Bio = '$biodiversitaId'";

if ($conn->query($queryDeleteBiodiversita) === TRUE) {
    echo "Biodiversità eliminata con successo.";
} else {
    echo "Errore durante l'eliminazione della biodiversità: " . $conn->error;
}

// Chiudi la connessione al database
$conn->close();
?>