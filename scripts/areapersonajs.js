function modificaCampo(campo) {
    var modificaInCorso = document.getElementById("input_" + campo) !== null;

    if (modificaInCorso) {
        return;
    }

    var valoreCorrente = document.getElementById(campo).innerText;

    // Crea un campo di input per la modifica
    var inputModifica = document.createElement("input");
    inputModifica.type = "text";
    inputModifica.value = valoreCorrente;
    inputModifica.id = "input_" + campo;
    inputModifica.className = "campo-input";

    // Sostituisci il testo con il campo di input
    document.getElementById(campo).innerHTML = "";
    document.getElementById(campo).appendChild(inputModifica);

    // Aggiungi un pulsante di conferma
    var pulsanteConferma = document.createElement("button");
    pulsanteConferma.innerHTML = "✔ Conferma";
    pulsanteConferma.className = "conferma-btn";
    pulsanteConferma.onclick = function () { confermaModifica(campo); };
    document.getElementById(campo).appendChild(pulsanteConferma);
}

function confermaModifica(campo) {
    //Recupera il valore del campo di input
    var nuovoValore = document.getElementById("input_" + campo).value;

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

    xhr.send("campo=" + campo + "&valore=" + encodeURIComponent(nuovoValore));
}
