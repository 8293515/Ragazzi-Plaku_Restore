<?php
// Rigenera la tabella Specie
$conn = mysqli_connect("localhost", "root", "", "dbrestore");

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$querySpecie = "SELECT * FROM Specie";
$resultSpecie = $conn->query($querySpecie);

if ($resultSpecie->num_rows > 0) {
    echo "<h2>Specie</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nome Scientifico</th><th>Parco</th><th>Immagine</th><th>Tipo</th><th>Azioni</th></tr>";

    while ($rowSpecie = $resultSpecie->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowSpecie['NomeScientifico'] . "</td>";
        echo "<td>" . $rowSpecie['Parco'] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($rowSpecie['ImgSpecie']) . "' alt='Immagine Specie'></td>";
        echo "<td>" . $rowSpecie['Tipo'] . "</td>";
        echo "<td><button onclick='deleteSpecie(\"" . $rowSpecie['NomeScientifico'] . "\")'>Elimina</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nessuna specie trovata.</p>";
}

$queryBiodiversita = "SELECT * FROM Biodiversita";
$resultBiodiversita = $conn->query($queryBiodiversita);

if ($resultBiodiversita->num_rows > 0) {
    echo "<h2>Biodiversità</h2>";
    echo "<button onclick='createNewItem()'>Crea Nuovo Elemento</button>";
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

$conn->close();
?>