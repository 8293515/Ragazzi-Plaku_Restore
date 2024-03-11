<?php

$conn = mysqli_connect("localhost", "root", "", "dbrestore");


if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$biodiversitaId = $_POST['biodiversitaId'];
$queryDeleteBiodiversita = "DELETE FROM Biodiversita WHERE Id_Bio = '$biodiversitaId'";

if ($conn->query($queryDeleteBiodiversita) === TRUE) {
    echo "Biodiversità eliminata con successo.";
} else {
    echo "Errore durante l'eliminazione della biodiversità: " . $conn->error;
}
$conn->close();
?>