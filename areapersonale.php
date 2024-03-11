<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Area Personale</title>
    <link rel="stylesheet" href="AreaPersonaleStyle.css">
</head>
<script src="scripts/areapersonajs.js">

</script>

<body>

    <?php include 'nav.php'; ?>

    <div class="page-title-section">
        <div class="container">
            <h2 class="page-title">Area Personale</h2>
        </div>
    </div>

    <div class="container-personale">
        <?php

        // Connessione al database (sostituisci con le tue credenziali)
        $conn = mysqli_connect("localhost", "root", "", "dbrestore");

        // Verifica della connessione
        if ($conn->connect_error) {
            die("Connessione al database fallita: " . $conn->connect_error);
        }

        // Ottenere le informazioni del cliente
        $emailCliente = $_SESSION['username'];
        $queryCliente = "SELECT Nome, Cognome, Email FROM clienti WHERE Email=?";
        $stmtCliente = $conn->prepare($queryCliente);
        $stmtCliente->bind_param("s", $emailCliente);
        $stmtCliente->execute();
        $resultCliente = $stmtCliente->get_result();

        if ($resultCliente->num_rows > 0) {
            $rowCliente = $resultCliente->fetch_assoc();
            echo "<h2>Area Personale di " . $rowCliente['Nome'] . " " . $rowCliente['Cognome'] . "</h2>";

            // Mostrare le informazioni del cliente
            echo "<div class='account-info'>";
            echo "<h3>Informazioni dell'Account</h3>";
            echo "<p>Nome: <span id='Nome'>" . $rowCliente['Nome'] . "</span> <a href='#' onclick='modificaCampo(\"Nome\")'>Modifica</a></p>";
            echo "<p>Cognome: <span id='Cognome'>" . $rowCliente['Cognome'] . "</span> <a href='#' onclick='modificaCampo(\"Cognome\")'>Modifica</a></p>";
            echo "<p>Email: <span id='Email'>" . $rowCliente['Email'] . "";
            echo "</div>";

            // Ottenere le specie adottate dal cliente
            $queryAdozioni = "SELECT B.Nome_Comune, B.Specie, B.ImgInd,B.Sesso,B.Età, A.NomeProprio, A.Data_Adozione, A.Importo
                              FROM adozioni A
                              INNER JOIN biodiversita B ON A.Id_Bio = B.Id_Bio
                              WHERE A.EmailCliente = ?";

            $stmtAdozioni = $conn->prepare($queryAdozioni);
            $stmtAdozioni->bind_param("s", $emailCliente);
            $stmtAdozioni->execute();
            $resultAdozioni = $stmtAdozioni->get_result();

            if ($resultAdozioni->num_rows > 0) {
                // Mostrare le specie adottate
                echo "<div class='species-adopted'>";
                echo "<h3>Individui Adottati</h3>";
                echo "<ul class='species-list'>";

                while ($rowAdozione = $resultAdozioni->fetch_assoc()) {
                    echo "<li class='species-item'>";
                    echo "<img class='species-image' src='data:image/jpeg;base64," . base64_encode($rowAdozione['ImgInd']) . "' alt='" . $rowAdozione['Specie'] . "'>";
                    echo "<p> Nome: " . $rowAdozione['NomeProprio'] . "<br>";
                    echo "Specie: " . $rowAdozione['Specie'] . "<br>";
                    echo "Sesso: " . $rowAdozione['Sesso'] . "<br>";
                    echo "Età: " . $rowAdozione['Età'] . " anni<br>";
                    echo "Data adozione: " . $rowAdozione['Data_Adozione'] . "<br>";
                    echo "Costo adozione: " . $rowAdozione['Importo'] . "</p>";
                    echo "</li>";
                }

                echo "</ul>";
                echo "</div>";
            } else {
                echo "<p>Non hai adottato nessun individuo.</p>";
            }
        } else {
            echo "Cliente non trovato.";
        }

        // Chiudi la connessione al database
        $conn->close();
        ?>

    </div>
    <br><br><br>

    </div>
    </div>
    <?php include 'footer.html' ?>

</body>

</html>