<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupero dei dati dal modulo di pagamento
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$indirizzo = $_POST['indirizzo'];
$cap = $_POST['cap'];
$titolare = $_POST['titolare'];
$scadenza = $_POST['scadenza'];
$ccv = $_POST['ccv'];
$emailCliente = $_SESSION['username']; 
$id_bio = $_SESSION['IdBio'];
$nomeProprio = $_POST['NomeProprio']; 
$importo = $_SESSION['Importo'];


// Inserimento dei dati nella tabella Adozione
$sql = "INSERT INTO adozioni (EmailCliente, Id_Bio, NomeProprio, Importo, Data_Adozione) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);


// Controllo della preparazione dello statement
if ($stmt === false) {
    die("Errore nella preparazione dello statement: " . $conn->error);
}

// Binding dei parametri
$stmt->bind_param("ssss", $emailCliente, $id_bio, $nomeProprio, $importo);

$sqlUpdate = "UPDATE biodiversita SET disponibile = 0 WHERE Id_Bio = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("i", $id_bio);
$stmtUpdate->execute();
// Esecuzione dello statement
if ($stmt->execute() === TRUE) {
    header("Location:index.php");
} else {
    echo "Errore durante l'inserimento dei dati: " . $conn->error;
}


$stmt->close();
$stmtUpdate->close();
$conn->close();
?>