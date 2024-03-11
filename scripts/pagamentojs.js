document.addEventListener('DOMContentLoaded', function () {
    // Aggiungo l'event listener per gli input dei cvv,ccn e scadenza (li "assegno" la funzione)
    document.getElementById('cvv').addEventListener('input', formatCVV);
    document.getElementById('ccn').addEventListener('input', formatCreditCardNumber);
    document.getElementById('scadenza').addEventListener('input', formatExpirationDate);
});

function formatCreditCardNumber() {
    // Impedisce la scrittura di caratteri non numerici e aggiungi spazi ogni 4 cifre
    var ccnInput = document.getElementById('ccn');
    ccnInput.value = ccnInput.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
}


function formatExpirationDate() {
    // Formatta la data di scadenza aggiungendo uno slash ogni 2 cifre
    var expirationDateInput = document.getElementById('scadenza');
    if (expirationDateInput.value.length < 4) {
        expirationDateInput.value = expirationDateInput.value.replace(/[^\d]/g, '').replace(/(.{2})/g, '$1/').trim();
    }

}

function formatCVV() {
     // Accetta solo caratteri numerici per il campo CVV
    var cvvInput = document.getElementById('cvv');
    cvvInput.value = cvvInput.value.replace(/\D/g, '').trim(); // Accetta solo caratteri numerici
}