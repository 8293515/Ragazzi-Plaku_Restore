<?php
session_start();

// Configura la connessione al database come descritto in precedenza
$conn = mysqli_connect("localhost", "root", "", "dbrestore");


// Verifica se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    echo('<script>alert("Devi essere loggato per poter adottare!")</script>') // Reindirizza l'utente alla pagina di login se non è autenticato
    exit();
}

// Ottieni i dati dell'utente dalla sessione
$email_cliente = $_SESSION['email_cliente'];

// Ottieni i dati del modulo di pagamento
$id_bio = $_POST['id_bio'];
$nome_proprio = $_POST['nomeproprio'];
$importo = $_POST['importo'];
$data_adozione = date("Y-m-d"); // Ottieni la data corrente nel formato 'YYYY-MM-DD'

// Prepara la query parametrizzata con marcatori di posizione
$query_inserimento = "INSERT INTO Adozione (EmailCliente, Id_Bio, NomeProprio, Importo, Data_Adozione) VALUES (?, ?, ?, ?, ?)";
$stmt = $connessione->prepare($query_inserimento);
$stmt->bindParam('sssss', $email_cliente, $id_bio, $nome_proprio, $importo, $data_adozione);
$stmt->execute();

 

// Chiudi la connessione al database
mysqli_close($conn);
?>



