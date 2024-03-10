<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina di selezione Parco</title>
    <link rel="stylesheet" href="SceltaStyle.css">
</head>

<body>
    <?php include 'nav.php';?>




    <div class="page-title-section">
        <div class="container">
            <h2 class="page-title">Pagina di selezione Parco</h2>
        </div>
    </div>


        <!-- Animal selection section with grid layout -->
        <div class="animal-section">
            <h2>Seleziona il Parco per procedere all'adozione</h2>

            <!-- Grid layout for animal options -->
            <div class="animal-grid">
                <!-- Animal option 1 -->
                <div class="animal-option">
                    <img src="images/Parco-Artico.jpg" alt="ParcoArtico">
                    <label for="parcoartico">Parco Artico</label>
                    <p>Situato nel Sud della Nuova Zelanda accoglie diverse specie artiche.</p>
                    <form method="post" action="DatiParco.php">
                    <input type="hidden" value="Parco Artico" id="nomeparco" name="nomeparco">
                    <input type="submit" value="Scegli" class="custom-btn btn-4">
                    </form>
                </div>

                <!-- Animal option 2 -->
                <div class="animal-option">
                    <img src="images/Parco-Savana.jpg" alt="Savana">
                    <label for="savana">Savana</label>
                    <form method="post" action="DatiParco.php">
                    <input type="hidden" value="Savana" id="nomeparco" name="nomeparco">
                    <input type="submit" value="Scegli" class="custom-btn btn-4">
                    </form>
                </div>

                <!-- Animal option 3 (Add more as needed) -->
                <div class="animal-option">
                    <img src="images/Parco-Giungla.jpg" alt="Giungla">
                    <label for="giungla">Giungla</label>
                    <form method="post" action="DatiParco.php">
                    <input type="hidden" value="Giungla" id="nomeparco" name="nomeparco">
                    <input type="submit" value="Scegli" class="custom-btn btn-4">
                    </form>
                </div>

                <div class="animal-option">
                    <img src="images/Parco-Alpino.jpg" alt="ParcoAlpino">
                    <label for="parcoalpino">Parco Alpino</label>
                    <form method="post" action="DatiParco.php">
                    <input type="hidden" value="Parco Alpino" id="nomeparco" name="nomeparco">
                    <input type="submit" value="Scegli" class="custom-btn btn-4">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add other sections and content as needed -->

    <?php include 'footer.html';?>
</body>

</html>
