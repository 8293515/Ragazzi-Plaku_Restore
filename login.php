<?php
// Inizializza o ripristina la sessione
session_start();

// Configura la connessione al database come descritto in precedenza
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM clienti WHERE Email = ? AND Psw = ?";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param('ss',$email,$password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();

        // Imposta le informazioni dell'utente nella sessione
        $_SESSION['username'] = $row['Email'];

        $response = array("success" => true, "username" => $row['Nome']);
    } 
    else 
    {
        $response = array("success" => false, "message" => "Credenziali non valide");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Aggiungi questa riga
} else {
    echo json_encode(array("success" => false, "message" => "Metodo di richiesta non valido"));
}

$conn->close();
?>