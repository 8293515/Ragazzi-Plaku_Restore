document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cvv').addEventListener('input', formatCVV);
    document.getElementById('ccn').addEventListener('input', formatCreditCardNumber);
    document.getElementById('scadenza').addEventListener('input', formatExpirationDate);
});
function formatCreditCardNumber() {
    var ccnInput = document.getElementById('ccn');
    ccnInput.value = ccnInput.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
}

// Funzione per formattare la data di scadenza
function formatExpirationDate() {
    var expirationDateInput = document.getElementById('scadenza');
    if (expirationDateInput.value.length < 4) {
        expirationDateInput.value = expirationDateInput.value.replace(/[^\d]/g, '').replace(/(.{2})/g, '$1/').trim();
    }

}

function formatCVV() {
    var cvvInput = document.getElementById('cvv');
    cvvInput.value = cvvInput.value.replace(/\D/g, '').trim(); // Accetta solo caratteri numerici
}