<?php
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
$specieId = $_POST['specieId'];
$queryDeleteSpecie = "DELETE FROM Specie WHERE NomeScientifico = '$specieId'";

if ($conn->query($queryDeleteSpecie) === TRUE) {
    echo "Specie eliminata con successo.";
} else {
    echo "Errore durante l'eliminazione della specie: " . $conn->error;
}


$conn->close();
?>