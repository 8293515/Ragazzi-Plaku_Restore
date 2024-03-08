<?php
// Connessione al database (aggiorna con le tue credenziali)


$conn = mysqli_connect("localhost", "root", "", "dbrestore");

// Verifica della connessione al database
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Inizio della sessione
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal modulo HTML
    $nome = $_POST['name'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email-2'];
    $psw = $_POST['password']; // Assicurati che il campo di input sia correttamente denominato
    $image = $_FILES["myfile"]["tmp_name"];
    if (empty($image)) {
        die("Please choose a file to upload.");
    }
    $imageData = file_get_contents($image);
    $imageData = mysqli_real_escape_string($conn, $imageData);

    // Esegui l'inserimento dei dati nel database utilizzando statement preparati
    $sql = $conn->prepare("INSERT INTO clienti (Email, Psw, Nome, Cognome,img) VALUES (?, ?, ?, ?,?)");
    $sql->bind_param("ssssb", $email, $psw, $nome, $cognome,$imageData);

    if ($sql->execute()) {
        // Inserimento riuscito
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        header("Location: index.php"); // Redirect alla pagina di successo
    } else {
        // Errore durante l'inserimento
        echo "Errore durante l'inserimento dei dati: " . $sql->error;
    }

    // Chiudi lo statement preparato
    $sql->close();
}

// Chiudi la connessione al database
$conn->close();
?>