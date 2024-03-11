<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="PagamentoStyle.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina di Pagamento</title>
    <!-- Aggiungi eventuali stili aggiuntivi o script necessari qui -->
    <?php
    session_start();
    // Verifica se l'ID della biodiversità è stato inviato con il modulo POST
    if (isset($_SESSION['IdBio'])) {
        $id_bio = $_SESSION['IdBio'];

        // Ora puoi utilizzare $id_bio come necessario nel tuo script di pagamento
        // ...
    } else {
        // Gestione dell'errore nel caso in cui id_bio non sia presente
        echo "Errore: ID della biodiversità non presente.";
    }

    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('cvv').addEventListener('input', formatCVV);
            document.getElementById('ccn').addEventListener('input', formatCreditCardNumber);
            document.getElementById('scadenza').addEventListener('input', formatExpirationDate);
        });
        function formatCreditCardNumber() {
            var ccnInput = document.getElementById('ccn');
            ccnInput.value = ccnInput.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
        }

        // Funzione per formattare la data di scadenza
        function formatExpirationDate() {
            var expirationDateInput = document.getElementById('scadenza');
            if (expirationDateInput.value.length < 4) {
                expirationDateInput.value = expirationDateInput.value.replace(/[^\d]/g, '').replace(/(.{2})/g, '$1/').trim();
            }

        }

        function formatCVV() {
            var cvvInput = document.getElementById('cvv');
            cvvInput.value = cvvInput.value.replace(/\D/g, '').trim(); // Accetta solo caratteri numerici
        }

    </script>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="page-title-section">
        <div class="container">
            <h2 class="page-title">Pagina di pagamento</h2>
        </div>
    </div>


    <div class="container">
        <h2>Informazioni di pagamento</h2>

        <form method="post" action="pagamentoeffettuato.php">
            <div class="payment-section">
                <div class="billing-card-container">
                    <div class="billing-details">
                        <h3>Dati di Fatturazione</h3>
                        <form>
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" required>

                            <label for="cognome">Cognome:</label>
                            <input type="text" id="cognome" name="cognome" required>

                            <label for="indirizzo">Indirizzo:</label>
                            <input type="text" id="indirizzo" name="indirizzo" required>

                            <label for="cap">CAP:</label>
                            <input type="text" id="cap" name="cap" required>

                    </div>

                    <br>

                    <div class="card-details">
                        <h3>Dati Carta</h3>

                        <label for="titolare">Titolare carta:</label>
                        <input type="text" id="titolare" name="titolare" required>

                        <label for="numerocarta">Numero carta:</label>
                        <input id="ccn" type="tel" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19"
                            minlength="19" placeholder="xxxx xxxx xxxx xxxx" required>


                        <label for="scadenza">Data di Scadenza:</label>
                        <input type="text" id="scadenza" name="scadenza" maxlength="5" minlength="5" required>

                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" maxlength="3" minlength="3" required>

                        <div class="selection-section-top"></div>

                        <div class="selection-section">
                            <!-- Selection grid layout for animals and plants -->
                            <h3>Specie adottata</h3>
                            <label>Scegli il nome del tuo adottato:</label>
                            <input type="text" name="NomeProprio"><br><br><br>
                            <div class="selection-grid">
                                <!-- Opzione Scelta -->
                                <div class="selection-option">
                                    <?php
                                    // Recupera i dati della specie adottata dalla sessione
                                    $id_bio = $_SESSION['IdBio'];
                                    $nomecomune = $_SESSION['NomeComune'];
                                    $sesso = $_SESSION['Sesso'];
                                    $eta = $_SESSION['Eta'];
                                    $img = $_SESSION['ImgInd'];
                                    $nomeSpecie = $_SESSION['Specie'];
                                    $importo = $_SESSION['Importo'];

                                    // Output dinamico dei dati nella pagina
                                    echo '<img src="data:image/jpeg;base64,' . $img . '" alt="' . $nomeSpecie . '">';
                                    echo '<div class="selection-content">';
                                    echo '<p> Nome Specie:' . $nomeSpecie . '</p>';
                                    echo '<p> Nome Comune:' . $nomecomune . '</p>';
                                    echo '<p> Sesso:' . $sesso . '</p>';
                                    echo '<p> Età:' . $eta . '</p>';
                                    echo '<p>Costo:' . $importo . '</p';
                                    echo '</div>';
                                    ?>
                                </div>
                            </div>

                        </div>

                        <br>
                        <input type="submit" class="custom-btn btn-4" value="Dona">
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    <?php include 'footer.html'; ?>

</body>

</html>