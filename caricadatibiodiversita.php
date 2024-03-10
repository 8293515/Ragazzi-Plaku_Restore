<?php
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica il metodo della richiesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni il nome scientifico dalla richiesta POST
    $nomeScientifico = $_POST['NomeScientifico'];

    // Prepara la query per ottenere i dati dalla tabella biodiversita
    $query = "SELECT *,S.Tipo FROM biodiversita INNER JOIN Specie S ON biodiversita.specie = S.NomeScientifico WHERE biodiversita.Specie = ? AND disponibile = 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nomeScientifico);
    $stmt->execute();

    // Ottieni il risultato della query
    $result = $stmt->get_result();

    // Chiudi la connessione al database
    $stmt->close();
    $conn->close();

    $datiindividui = [];

    // Restituisci i dati come JSON
    while ($row = $result->fetch_assoc()) {
        $imageInfo = getimagesizefromstring($row['ImgInd']);
        $imageType = $imageInfo['mime'];
        $base64img = base64_encode($row['ImgInd']);
        $datiindividui[] = [
            'IdBio' => $row['Id_Bio'],
            'NomeComune' => $row['Nome_Comune'],
            'Sesso' => $row['Sesso'],
            'Eta' => $row['Età'],
            'ImgInd' => $base64img,
            'Specie' => $row['Specie'],
            'Tipo' => $row['Tipo'],
            'Importo' => $row['CostoAdozione']
        ];
    }

    // Imposta l'header JSON prima di stampare i dati
    header('Content-Type: application/json');

    // Stampa i dati JSON
    echo json_encode($datiindividui);
} 
else {
    // Se il metodo della richiesta non è POST, restituisci un messaggio di errore JSON
    header('Content-Type: application/json');
    echo json_encode(["Errore" => "Metodo di richiesta non valido"]);
}
?>