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

            // Crea la griglia della fauna
            var faunaGrid = createSelectionGrid('fauna-grid');

            // Crea la griglia della flora
            var floraGrid = createSelectionGrid('flora-grid');

            // Imposta il numero desiderato di celle per riga
            var maxCells = 3; // Massimo numero di celle per griglia

            // Itera attraverso i dati e crea gli elementi
            var currentCellCount = 0;
            var currentRowCount = 0;

            specieData.forEach(function (data, index) {
                var selectionOption = createSelectionOption(data);

                if (data.Tipo === 'Pianta') {
                    // Aggiungi gli elementi alla griglia della flora se il tipo è "Pianta"
                    floraGrid.appendChild(selectionOption);
                } else {
                    // Aggiungi gli elementi alla griglia della fauna
                    faunaGrid.appendChild(selectionOption);
                }

                currentCellCount++;

                if (currentCellCount === maxCells || index === specieData.length - 1) {
                    // Se abbiamo raggiunto il massimo di celle o siamo all'ultimo elemento, passa alla colonna sottostante
                    currentCellCount = 0;
                    currentRowCount++;
                }
            });

            // Imposta l'altezza delle griglie in base al numero di righe
            faunaGrid.style.gridTemplateRows = 'repeat(' + currentRowCount + ', 1fr)';
            floraGrid.style.gridTemplateRows = 'repeat(' + currentRowCount + ', 1fr)';
            
            // Imposta il numero desiderato di colonne
            var gridColumns = 'repeat(' + Math.min(maxCells, specieData.length) + ', 1fr)';
            faunaGrid.style.gridTemplateColumns = gridColumns;
            floraGrid.style.gridTemplateColumns = gridColumns;
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
    img.style.width = '100%'; // Imposta la larghezza dell'immagine al 100%
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
function createSelectionGrid(containerId) {
    console.log("Attempting to create grid for container with id:", containerId);
    var container = document.getElementById(containerId);

    // Verifica se l'elemento con l'id specificato esiste
    if (!container) {
        console.error("Container element not found:", containerId);
        return null;
    }

    var selectionGrid = document.createElement('div');
    selectionGrid.className = 'selection-grid';
    selectionGrid.id = containerId + '-grid'; // Aggiunta dell'id
    container.appendChild(selectionGrid);

    console.log("Created grid with id:", selectionGrid.id);

    return selectionGrid;
}
function createSelectionOption(data) {
    var selectionOption = document.createElement('div');
    selectionOption.className = 'selection-option';

    var img = document.createElement('img');
    img.src = 'data:image/jpeg;base64,' + data.Img;
    img.alt = data.NomeScientifico;
    img.style.width = '100%'; // Imposta la larghezza dell'immagine al 100%
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
    button.innerHTML = '<span onclick="openModalSpecie(\'' + data.NomeScientifico + '\')">Scegli</span>';
    selectionContent.appendChild(button);

    selectionOption.appendChild(selectionContent);

    return selectionOption;
}

// Funzione per aprire il modal e caricare i dati
function openModalSpecie(nomeScientifico) {
    var modal = document.getElementById('adoptModal');
    modal.style.display = 'block';

    // Esegui una chiamata AJAX per ottenere i dati dalla tabella biodiversita
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "caricadatibiodiversita.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var biodiversitaData = JSON.parse(xhr.responseText);

            var adoptModalContent = document.getElementById('adoptModalContent');

            // Trova i dati corrispondenti al nome scientifico
           
            
            // Popola il contenuto del modal con i dati       
            if (biodiversitaData && biodiversitaData.length > 0) {
    var modalContent = ''; // Inizializza una stringa vuota per contenere il contenuto del modal

    biodiversitaData.forEach(function (item) {
      var modalItem = createModalItem(item);
        modalContent += modalItem.outerHTML;
    });

    adoptModalContent.innerHTML = modalContent;
}
        }
    };

    // Invia la richiesta con il nome scientifico come parametro
    xhr.send("NomeScientifico=" + encodeURIComponent(nomeScientifico));
}

// Funzione per chiudere il modal
function closeModalSpecie() {
    var modal = document.getElementById('adoptModal');
    modal.style.display = 'none';
}

// Funzione per creare un elemento modal-item
function createModalItem(data) {
    var modalItem = document.createElement('div');
    modalItem.className = 'modal-item';

    var imgContainer = document.createElement('div');
    imgContainer.className = 'modal-item-img-container';

    var img = document.createElement('img');
    img.src = 'data:image/jpeg;base64,' + data.ImgInd;
    img.alt = data.NomeComune;
    imgContainer.appendChild(img);

    modalItem.appendChild(imgContainer);

    var content = document.createElement('div');
    content.className = 'modal-item-content';

    var label = document.createElement('label');
    label.textContent = data.NomeComune;
    content.appendChild(label);

    var p1 = document.createElement('p');
    p1.textContent = 'Sesso: ' + data.Sesso;
    content.appendChild(p1);

    var p2 = document.createElement('p');
    p2.textContent = 'Età: ' + data.Eta;
    content.appendChild(p2);

    var form = document.createElement('form');
    form.onsubmit = function (event) {
        event.preventDefault(); // Evita il comportamento predefinito del form
        // Aggiungi qui la logica per l'adozione
        // Puoi ottenere i dati da 'data' e fare la richiesta AJAX necessaria
        // ...

        // Chiudi il modal dopo l'adozione (esempio: closeModal());
    };

    var submitBtn = document.createElement('input');
    submitBtn.type = 'submit';
    submitBtn.value = 'Adotta';
    submitBtn.className = 'modal-item-button'; // Aggiunta della classe per lo stile del pulsante
    form.appendChild(submitBtn);

    content.appendChild(form);
    modalItem.appendChild(content);

    return modalItem;
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
        </div>
    </div>
        
    <div class="selection-section" >
        <h3>Flora</h3>
        <div class="selection-grid" id="flora-grid">
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
