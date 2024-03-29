<?php
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal modulo HTML
    $nome = $_POST['name'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email-2'];
    $psw = $_POST['password']; 
    $image = $_FILES["myfile"]["tmp_name"];
    $amministratore = 0;
    if (empty($image)) {
        die("Please choose a file to upload.");
    }

    $imageData = file_get_contents($image);
    $imageData = mysqli_real_escape_string($conn, $imageData);

    $sql = $conn->prepare("INSERT INTO clienti (Email, Psw, Nome, Cognome,img,Amministratore) VALUES (?, ?, ?, ?,?,?)");
    $sql->bind_param("ssssbd", $email, $psw, $nome, $cognome, $imageData, $amministratore);
    mysqli_stmt_send_long_data($sql, 4, file_get_contents($image));

    if ($sql->execute()) {
        // Inserimento riuscito
        header("Location: index.php"); // Redirect alla pagina di successo
    } else {
        // Errore durante l'inserimento
        echo "Errore durante l'inserimento dei dati: " . $sql->error;
    }

    $sql->close();
}

$conn->close();


?>