<?php
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $sql = "SELECT * FROM clienti WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response = array("success" => false, "message" => "L'email è già registrata.");
    } else {
        $response = array("success" => true, "message" => "L'email è disponibile.");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>