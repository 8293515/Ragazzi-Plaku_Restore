const uploadField = document.getElementById("myfile");

// Gestisci il caricamento di file, avverti se il file è troppo grande
uploadField.onchange = function () {
  if (this.files[0].size > 1048576) {
    alert("Il File è troppo pesante!");
    this.value = "";
  }
}

function validateForm() {
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('psw-2').value;

  // Confronta la password con la conferma della password
  if (password !== confirmPassword) {
    alert("Le password non corrispondono");
    return false; // Blocca l'invio del modulo
  }

  // Esegui il controllo sull'email, restituisci true solo se l'email è valida
  if (checkEmail()) {
    return true;
  } else {
    return false;
  }
}

function checkEmail() {
  var email = document.getElementById('email-2').value;

  // Esegui una chiamata AJAX per verificare l'unicità dell'email
  var xhr = new XMLHttpRequest();
  var url = "check_email.php";
  var params = "email=" + encodeURIComponent(email);
  xhr.open("POST", url, true);

  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);

      // Visualizza il risultato del controllo nell'elemento aggiunto
      var resultDiv = document.getElementById('email-check-result');
      resultDiv.innerHTML = response.message;

      // Se l'email è valida, invia il modulo
      if (response.success) {
        document.getElementById('email-form').submit();
        return true;
      }
    }
  };

  xhr.send(params);
}
function controlloCarattere(event) {
  var key = event.key;
  // Blocca l'input se il tasto premuto è un numero
  return isNaN(key);
}