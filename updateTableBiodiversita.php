<?php
// Connessione al database (sostituisci con le tue credenziali)
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Recupera e mostra la tabella della Biodiversità
$queryBiodiversita = "SELECT * FROM Biodiversita";
$resultBiodiversita = $conn->query($queryBiodiversita);

if ($resultBiodiversita->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome Comune</th><th>Specie</th><th>Sesso</th><th>Età</th><th>Costo Adozione</th><th>ImgInd</th><th>Disponibile</th><th>Azioni</th></tr>";

    while ($rowBiodiversita = $resultBiodiversita->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowBiodiversita['Id_Bio'] . "</td>";
        echo "<td>" . $rowBiodiversita['Nome_Comune'] . "</td>";
        echo "<td>" . $rowBiodiversita['Specie'] . "</td>";
        echo "<td>" . $rowBiodiversita['Sesso'] . "</td>";
        echo "<td>" . $rowBiodiversita['Età'] . "</td>";
        echo "<td>" . $rowBiodiversita['CostoAdozione'] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($rowBiodiversita['ImgInd']) . "' alt='Immagine Individuale'></td>";
        echo "<td>" . $rowBiodiversita['disponibile'] . "</td>";
        echo "<td><button onclick='deleteBiodiversita(" . $rowBiodiversita['Id_Bio'] . ")'>Elimina</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nessuna biodiversità trovata.</p>";
}

// Chiudi la connessione al database
$conn->close();
?>