function deleteSpecie(specieId) {
    var confirmDelete = confirm("Sei sicuro di voler eliminare questa specie?");
    if (confirmDelete) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteSpecie.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                updateTableSpecie(); // Aggiornato il nome della funzione
            }
        };
        xhr.send("specieId=" + specieId);
    }
}

function deleteBiodiversita(biodiversitaId) {
    var confirmDelete = confirm("Sei sicuro di voler eliminare questo elemento?");
    if (confirmDelete) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteBiodiversita.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                updateTableBiodiversita(); // Aggiornato il nome della funzione
            }
        };
        xhr.send("biodiversitaId=" + biodiversitaId);
    }
}

function updateTableSpecie() { // Aggiornato il nome della funzione
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updateTableSpecie.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("table-specie").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function updateTableBiodiversita() { // Aggiornato il nome della funzione
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updateTableBiodiversita.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("table-biodiversita").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}