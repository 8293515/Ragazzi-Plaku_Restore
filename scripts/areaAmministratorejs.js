function deleteSpecie(specieId) {
    // Conferma l'eliminazione
    var confirmDelete = confirm("Sei sicuro di voler eliminare questa specie?");
    if (confirmDelete) {
        // Inizializza una richiesta XMLHttpRequest per eliminare la specie
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteSpecie.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Aggiorna la tabella delle specie dopo l'eliminazione
                updateTableSpecie();
            }
        };
        xhr.send("specieId=" + specieId);
    }
}

function deleteBiodiversita(biodiversitaId) {
    // Conferma l'eliminazione
    var confirmDelete = confirm("Sei sicuro di voler eliminare questo elemento?");
    if (confirmDelete) {
        // Inizializza una richiesta XMLHttpRequest per eliminare l'elemento di biodiversità
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteBiodiversita.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Aggiorna la tabella della biodiversità dopo l'eliminazione
                updateTableBiodiversita();
            }
        };
        xhr.send("biodiversitaId=" + biodiversitaId);
    }
}

function updateTableSpecie() {
    // Inizializza una richiesta XMLHttpRequest per aggiornare la tabella delle specie
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updateTableSpecie.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Aggiorna il contenuto della tabella delle specie con la risposta ottenuta
            document.getElementById("table-specie").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function updateTableBiodiversita() {
    // Inizializza una richiesta XMLHttpRequest per aggiornare la tabella della biodiversità
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updateTableBiodiversita.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Aggiorna il contenuto della tabella della biodiversità con la risposta ottenuta
            document.getElementById("table-biodiversita").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}