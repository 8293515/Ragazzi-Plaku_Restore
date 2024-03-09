<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina di selezione Animali e Piante</title>
    <link rel="stylesheet" href="SpecieStyle.css">
    <?php include 'nav.php'; ?>
    <script>
       document.addEventListener("DOMContentLoaded", function () {
    // Esegui una chiamata AJAX per ottenere le informazioni sulla specie dal server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "generadatispecie.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var specieData = JSON.parse(xhr.responseText);
            console.log(specieData);


            // Crea la griglia della fauna
            var faunaGrid = createSelectionGrid('fauna-grid');

            // Crea la griglia della flora
            var floraGrid = createSelectionGrid('flora-grid');

            // Itera attraverso i dati e crea gli elementi
            var maxCells = 3; // Massimo numero di celle per griglia
            var currentGrid = faunaGrid; // Inizia con la griglia della fauna
            var currentCellCount = 0;

            specieData.forEach(function (data) {
                if (currentCellCount === maxCells) {
                    // Se abbiamo raggiunto il massimo di celle, passa a una nuova griglia
                    currentGrid = currentGrid === faunaGrid ? createSelectionGrid('fauna-grid') : createSelectionGrid('flora-grid');
                    currentCellCount = 0;
                }

                var selectionOption = createSelectionOption(data);
                currentGrid.appendChild(selectionOption);

                currentCellCount++;
            });
        }
    };

    xhr.send();
});
    // Funzione per creare un elemento selection-option
            function createSelectionOption(data) {
                var selectionOption = document.createElement('div');
                selectionOption.className = 'selection-option';

                var img = document.createElement('img');
                img.src = 'data:image/jpeg;base64,' + data.Img;
                img.alt = data.NomeScientifico;
                selectionOption.appendChild(img);

                var selectionContent = document.createElement('div');
                selectionContent.className = 'selection-content';

                var label = document.createElement('label');
                label.textContent = data.NomeScientifico;
                selectionContent.appendChild(label);

                var p = document.createElement('p');
                p.textContent = data.Tipo;
                selectionContent.appendChild(p);

                var button = document.createElement('button');
                button.className = 'custom-btn btn-4';
                button.innerHTML = '<span>Scegli</span>';
                selectionContent.appendChild(button);

                selectionOption.appendChild(selectionContent);

                return selectionOption;
            }

            // Funzione per creare una nuova griglia di selezione
            function createSelectionGrid(containerId) {     //Ricreo il Grid perché se no non worka
                var container = document.getElementById(containerId);
                var selectionGrid = document.createElement('div');
                selectionGrid.className = 'selection-grid'; 
                container.appendChild(selectionGrid);
                return selectionGrid;
            }
    </script>
</head>

<body>

  


    <div class="page-title-section">
      <div class="container">
        <h2 class="page-title">Selezione Animale e Pianta</h2>
      </div>
    </div>
  
    
  
    <div class="selection-section-top"></div>
  
    <div class="selection-section" >
        <!-- Selection grid layout for animals and plants -->
        <h3>Fauna</h3>
        <div class="selection-grid" id="fauna-grid">
            <!-- Animal option 1 -->
       

    
            <!-- Altre opzioni... -->

    
            <!-- Altre opzioni... -->
        </div>
        
    <div class="selection-section" >
        <h3>Flora</h3>
        <div class="selection-grid" id="flora-grid">
            <!-- Animal option 1 -->
       

     
        </div>
    </div>
    
    <br><br><br>
  
    <div class="footer">
      <div class="container">
        <div class="footer-wrapper">
          <div class="footer-logo-column">
            <a href="/" aria-current="page" class="w-inline-block w--current"><img src="images/[removal.ai]_d1ffefac-a7c4-4aea-b9cd-0cb9642791d6-restore.png" alt="" width="149"></a>
          </div>
          <div>
            <a href="/" target="_blank" class="social-footer-link w-inline-block"><img src="images/Twitter_Social_Icon_Rounded_Square_White.svg" width="30" alt="Twitter Logo"></a>
            <a href="/" class="social-footer-link w-inline-block"><img src="images/Facebook Logo.svg" width="30" alt="Facebook Logo"></a>
            <a href="/" target="_blank" class="social-footer-link w-inline-block"><img src="images/Insta.svg" width="30" alt="Instagram Logo"></a>
          </div>
        </div>
        <div class="footer-bottom-wrapper">
          <div class="small footer-small"><br>‍</div>
        </div>
      </div>
    </div>
  
  </body>
</html>
