<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="AreaAmministratoreStyle.css">
<head>
    <!-- ... (come prima) -->
    <script>
        // ... (come prima)

        function deleteSpecie(specieId) {
            var confirmDelete = confirm("Sei sicuro di voler eliminare questa specie?");
            if (confirmDelete) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "deleteSpecie.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        updateTableSpecie(); // Aggiornato il nome della funzione
                    }
                };
                xhr.send("specieId=" + specieId);
            }
        }

        function deleteBiodiversita(biodiversitaId) {
            var confirmDelete = confirm("Sei sicuro di voler eliminare questo elemento?");
            if (confirmDelete) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "deleteBiodiversita.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        updateTableBiodiversita(); // Aggiornato il nome della funzione
                    }
                };
                xhr.send("biodiversitaId=" + biodiversitaId);
            }
        }

        function updateTableSpecie() { // Aggiornato il nome della funzione
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updateTableSpecie.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("table-specie").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function updateTableBiodiversita() { // Aggiornato il nome della funzione
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updateTableBiodiversita.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("table-biodiversita").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // ... (come prima)
    </script>
    <!-- ... (come prima) -->
</head>

<body>

    <?php include 'nav.php'; ?>

    <div class="container-personale">
    <?php
        // Connessione al database (sostituisci con le tue credenziali)
        $conn = mysqli_connect("localhost", "root", "", "dbrestore");

        // Verifica della connessione
        if ($conn->connect_error) {
            die("Connessione al database fallita: " . $conn->connect_error);
        }

        // Recupera e mostra la tabella delle Specie
        $querySpecie = "SELECT * FROM Specie";
        $resultSpecie = $conn->query($querySpecie);

        if ($resultSpecie->num_rows > 0) {
            echo "<h2>Specie</h2>";
            echo "<table id='table-specie' border='1'>"; // Aggiornato l'ID della tabella
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

        // Recupera e mostra la tabella della Biodiversità
        $queryBiodiversita = "SELECT * FROM Biodiversita";
        $resultBiodiversita = $conn->query($queryBiodiversita);

        if ($resultBiodiversita->num_rows > 0) {
            echo "<h2>Biodiversità</h2>";
            echo "<button onclick='createNewItem()'>Crea Nuovo Elemento</button>";
            echo "<table id='table-biodiversita' border='1'>"; // Aggiornato l'ID della tabella
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

    </div>

    <br><br><br>

    <?php include 'footer.html'; ?>

</body>

</html>