function createPage(){
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
        // Popola il contenuto del modal con i dati       
        if (biodiversitaData && biodiversitaData.length > 0) {
            var modalContent = ''; // Inizializza una stringa vuota per contenere il contenuto del modal

            biodiversitaData.forEach(function (item) {
                var modalItem = createModalItem(item);
                modalContent += modalItem.outerHTML;
            });

            adoptModalContent.innerHTML = modalContent;
        } else {
            // Se biodiversitaData è vuoto, mostra un messaggio nel modal
            adoptModalContent.innerHTML = '<p>Non ci sono animali di questa specie da adottare.</p>';
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

    // Verifica il tipo prima di aggiungere il sesso
    if (data.Tipo == 'Animale') {
        var p1 = document.createElement('p');
        p1.textContent = 'Sesso: ' + data.Sesso;
        content.appendChild(p1);
    }

    var p2 = document.createElement('p');
    p2.textContent = 'Età: ' + data.Eta;
    content.appendChild(p2);

    var p3 = document.createElement('p');
    p3.textContent = 'Costo Adozione: ' + data.Importo +'';
    content.appendChild(p3);
    // Creazione del form
    var form = document.createElement('form');
    form.action = 'logincheck.php';
    form.method = 'post';

    // Creazione dell'input nascosto e aggiunta al form
    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = key;
            hiddenInput.value = data[key];
            form.appendChild(hiddenInput);
        }
    }

    var submitBtn = document.createElement('input');
    submitBtn.type = 'submit';
    submitBtn.value = 'Adotta';
    submitBtn.className = 'custom-btn btn-4';

    form.appendChild(submitBtn);

    content.appendChild(form);
    modalItem.appendChild(content);

    return modalItem;
}