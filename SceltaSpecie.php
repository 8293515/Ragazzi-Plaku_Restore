<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// Controllo se la query string "login_required" è presente
if (!isset($_SESSION['loggedin'])) {
    // Script JavaScript per mostrare un alert
    echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    alert("Devi effettuare il login per poter adottare!");
                });
              </script>';
}
?>
<script src="scripts/sceltaspeciejs.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina di selezione Animali e Piante</title>
    <link rel="stylesheet" href="SpecieStyle.css">
    <?php include 'nav.php'; ?>
    <script>createPage();</script>

</head>

<body>
    <div class="page-title-section">
        <div class="container">
            <h2 class="page-title">Selezione Animale e Pianta</h2>
        </div>
    </div>

    <div class="selection-section-top"></div>

    <div class="selection-section">
        <!-- Selection grid layout for animals and plants -->
        <h3>Fauna</h3>
        <div class="selection-grid" id="fauna-grid">
            <!-- Animal option 1 -->
        </div>
    </div>

    <div class="selection-section">
        <h3>Flora</h3>
        <div class="selection-grid" id="flora-grid">
        </div>
    </div>

    <br><br><br>

    <?php include 'footer.html'; ?>

    <!-- Modal -->
    <div id="adoptModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalSpecie()">&times;</span>
            <div id="adoptModalContent" class="modal-grid">
                <!-- Contenuto iniziale del modal -->
                <p>Caricamento...</p>
            </div>
        </div>
    </div>

</body>

</html>