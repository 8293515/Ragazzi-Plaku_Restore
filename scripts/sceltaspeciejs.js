function createPage() {
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

function createSelectionGrid(containerId) {
    // Crea e restituisce una nuova griglia di selezione all'interno del container specificato
    var container = document.getElementById(containerId);

    if (!container) {
        console.error("Elemento non trovato:", containerId);
        return null;
    }

    var selectionGrid = document.createElement('div');
    selectionGrid.className = 'selection-grid';
    selectionGrid.id = containerId + '-grid';
    container.appendChild(selectionGrid);

    return selectionGrid;
}

function createSelectionOption(data) {
    // Crea e restituisce un elemento di opzione di selezione con i dati forniti
    var selectionOption = document.createElement('div');
    selectionOption.className = 'selection-option';

    // Aggiungi un'immagine
    var img = document.createElement('img');
    img.src = 'data:image/jpeg;base64,' + data.Img;
    img.alt = data.NomeScientifico;
    img.style.width = '100%';
    selectionOption.appendChild(img);

    // Aggiungi il contenuto testuale
    var selectionContent = document.createElement('div');
    selectionContent.className = 'selection-content';

    var label = document.createElement('label');
    label.textContent = data.NomeScientifico;
    selectionContent.appendChild(label);

    var p = document.createElement('p');
    p.textContent = data.Tipo;
    selectionContent.appendChild(p);

    // Aggiungi un pulsante con la funzione di apertura del modal
    var button = document.createElement('button');
    button.className = 'custom-btn btn-4';
    button.innerHTML = '<span onclick="openModalSpecie(\'' + data.NomeScientifico + '\')">Scegli</span>';
    selectionContent.appendChild(button);

    selectionOption.appendChild(selectionContent);

    return selectionOption;
}

function openModalSpecie(nomeScientifico) {
    // Apre il modal e carica i dati correlati dalla tabella biodiversita
    var modal = document.getElementById('adoptModal');
    modal.style.display = 'block';

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "caricadatibiodiversita.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var biodiversitaData = JSON.parse(xhr.responseText);

            var adoptModalContent = document.getElementById('adoptModalContent');
            //Controlla che biodiversitaData non sia vuoto ,se lo è allora non ci sono individui di quella X specie da adottare
            if (biodiversitaData && biodiversitaData.length > 0) {
                var modalContent = '';

                biodiversitaData.forEach(function (item) {
                    var modalItem = createModalItem(item);
                    modalContent += modalItem.outerHTML;
                });

                adoptModalContent.innerHTML = modalContent;
            } else {
                adoptModalContent.innerHTML = '<p>Non ci sono individui di questa specie da adottare.</p>';
            }
        }
    };

    xhr.send("NomeScientifico=" + encodeURIComponent(nomeScientifico));
}

function closeModalSpecie() {
    // Chiude il modal
    var modal = document.getElementById('adoptModal');
    modal.style.display = 'none';
}

function createModalItem(data) {
    // Crea e restituisce un elemento modal-item con i dati forniti
    var modalItem = document.createElement('div');
    modalItem.className = 'modal-item';

    // Aggiungi un'immagine
    var imgContainer = document.createElement('div');
    imgContainer.className = 'modal-item-img-container';

    var img = document.createElement('img');
    img.src = 'data:image/jpeg;base64,' + data.ImgInd;
    img.alt = data.NomeComune;
    imgContainer.appendChild(img);

    modalItem.appendChild(imgContainer);

    // Aggiungi il contenuto testuale
    var content = document.createElement('div');
    content.className = 'modal-item-content';

    var label = document.createElement('label');
    label.textContent = data.NomeComune;
    content.appendChild(label);

    if (data.Tipo == 'Animale') {
        var p1 = document.createElement('p');
        p1.textContent = 'Sesso: ' + data.Sesso;
        content.appendChild(p1);
    }

    var p2 = document.createElement('p');
    p2.textContent = 'Età: ' + data.Eta + ' anni';
    content.appendChild(p2);

    var p3 = document.createElement('p');
    p3.textContent = 'Costo Adozione: ' + data.Importo + '';
    content.appendChild(p3);

    // Creazione del form e input nascosti
    var form = document.createElement('form');
    form.action = 'logincheck.php';
    form.method = 'post';

    for (var key in data) {
        if (data.hasOwnProperty(key)) {          // Mi assicuro che solo le proprietà dell'oggetto 'data' vengano considerate nel ciclo
            var hiddenInput = document.createElement('input'); // In realtà data.hasOwnProperty non dovrebbe essere più necessario
            hiddenInput.type = 'hidden';                       // Nella versione corrente del codice ma l'ho lasciato nel caso
            hiddenInput.name = key;                            // Serva in future implementazioni
            hiddenInput.value = data[key];
            form.appendChild(hiddenInput);
        }
    }

    // Aggiungi un pulsante di submit
    var submitBtn = document.createElement('input');
    submitBtn.type = 'submit';
    submitBtn.value = 'Adotta';
    submitBtn.className = 'custom-btn btn-4';

    form.appendChild(submitBtn);

    content.appendChild(form);
    modalItem.appendChild(content);

    return modalItem;
}