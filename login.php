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
        $imageInfo = getimagesizefromstring($row['img']);
        $imageType = $imageInfo['mime'];
        $base64img = base64_encode($row['img']);
        $amministratore = $row['Amministratore'];

        // Imposta le informazioni dell'utente nella sessione
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['Email'];
        $_SESSION['image'] = $base64img;
        $_SESSION['imageinfo'] = $imageInfo;
        if($amministratore == 1){
            $_SESSION['isAdmin'] = true;
        }

        $response = array("success" => true, "img" => $base64img , "imginfo" => $imageType);
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