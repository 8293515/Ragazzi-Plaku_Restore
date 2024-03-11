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
    pulsanteConferma.onclick = function () { confermaModifica(campo); };
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