<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Area Personale</title>
    <link rel="stylesheet" href="AreaPersonaleStyle.css">
</head>
<script>
function modificaCampo(campo) {
    // Verifica se la modifica è già in corso
    var modificaInCorso = document.getElementById("input_" + campo) !== null;

    // Disabilita il link di modifica se la modifica è in corso
    if (modificaInCorso) {
        return;
    }

    // Recupera il valore corrente del campo
    var valoreCorrente = document.getElementById(campo).innerText;

    // Crea un campo di input per la modifica
    var inputModifica = document.createElement("input");
    inputModifica.type = "text";
    inputModifica.value = valoreCorrente;
    inputModifica.id = "input_" + campo;
    inputModifica.className = "campo-input"; // Aggiungi una classe per lo stile

    // Sostituisci il testo con il campo di input
    document.getElementById(campo).innerHTML = "";
    document.getElementById(campo).appendChild(inputModifica);

    // Aggiungi un pulsante di conferma
    var pulsanteConferma = document.createElement("button");
    pulsanteConferma.innerHTML = "✔ Conferma";
    pulsanteConferma.className = "conferma-btn"; // Aggiungi una classe per lo stile
    pulsanteConferma.onclick = function() { confermaModifica(campo); };
    document.getElementById(campo).appendChild(pulsanteConferma);
}

function confermaModifica(campo) {
    // Recupera il nuovo valore
    var nuovoValore = document.getElementById("input_" + campo).value;

    // Invia il nuovo valore al server utilizzando AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "modificacliente.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Aggiorna il valore sulla pagina solo se la modifica è stata confermata dal server
            if (xhr.responseText == "success") {
                document.getElementById(campo).innerHTML = nuovoValore;
            } else {
                alert("Errore durante la modifica");
            }
        }
    };

    // Invia i dati al server
    xhr.send("campo=" + campo + "&valore=" + encodeURIComponent(nuovoValore));
}
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
            $queryAdozioni = "SELECT B.Nome_Comune, B.Specie, B.ImgInd, A.NomeProprio, A.Data_Adozione, A.Importo
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
                    echo "Data adozione: " . $rowAdozione['Data_Adozione'] . "<br>";
                    echo "Costo adozione: " . $rowAdozione['Importo'] . "</p>";
                    echo "</li>";
                }

                echo "</ul>";
                echo "</div>";
            }
            else{
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
  <?php include 'footer.html'?>
  
  </body>
</html>