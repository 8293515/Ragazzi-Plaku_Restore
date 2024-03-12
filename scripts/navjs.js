document.addEventListener("DOMContentLoaded", function () {
    // Esegui una chiamata AJAX per ottenere le informazioni sulla sessione dal server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "keeplogin.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var sessionInfo = JSON.parse(xhr.responseText);

            if (sessionInfo.isLoggedIn) {
                // L'utente è loggato, aggiorna il bottone di login
                updateLoginButton(sessionInfo.img, sessionInfo.imginfo, sessionInfo.isAdmin);
            }
        }
    };

    xhr.send();
});

function openModal() {
    // Mostra il modal
    var modal = document.getElementById('id01');
    modal.style.display = 'flex';

    // Calcola e imposta la posizione del modal al centro
    var windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    var modalHeight = modal.offsetHeight;
    var topPosition = (windowHeight - modalHeight) / 2;
    modal.style.top = topPosition + 'px';

    modal.classList.add('show');
    // Aggiungi una classe al body per disabilitare lo scrolling
    document.body.classList.add('modal-open');
}

function closeModal() {
    // Chiudi il modal
    var modal = document.getElementById('id01');
    modal.classList.remove('show');
    setTimeout(function () {
        modal.style.display = 'none';
    }, 500);

    document.body.classList.remove('modal-open');
}

function handleLogin() {
    // Gestisci il login
    var email = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    var xhr = new XMLHttpRequest();
    var url = "login.php";
    var params = "username=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password);
    xhr.open("POST", url, true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.success == true) {
                updateLoginButton(response.img, response.imginfo);
                closeModal();
            } else {
                alert("Errore di login: " + response.message);
            }
        }
    };

    xhr.send(params);
    return false;
}

function updateLoginButton(imgBase64, imgInfo, isAdmin) {
    // Aggiorna il bottone di login
    var areaPersonaleButton = document.getElementById('AP');
    var loginButton = document.querySelector('.login-button'); // Seleziona il primo elemento con la classe "LoginButton"

    if (loginButton) {
        // Rimuovi il contenuto esistente e abilita l'immagine di sfondo
        loginButton.innerHTML = "";
        loginButton.onclick = openProfileModal;
        loginButton.style.backgroundImage = "url('data:image/" + imgInfo + ";base64," + imgBase64 + "')";
        loginButton.classList.add('logged-in'); // Aggiungi la classe 'logged-in'
        loginButton.style.backgroundSize = "cover";
        loginButton.style.borderRadius = "50%";
        loginButton.style.width = "50px"; // Imposta la larghezza del cerchio
        loginButton.style.height = "50px"; // Imposta l'altezza del cerchio

        // Gestisci il reindirizzamento dell'area personale in base allo stato di admin
        if (isAdmin == 1) {
            areaPersonaleButton.onclick = function () {
                window.location.href = 'AreaAmministratore.php';
            };
        } else {
            areaPersonaleButton.onclick = function () {
                window.location.href = 'AreaPersonale.php';
            }
        }
    }
}

function openProfileModal() {
    // Mostra il modal del profilo
    var profileModal = document.getElementById('profileModal');
    profileModal.style.display = 'flex';

    //Calcolo la posizione del modal perché sia al centro
    var windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    var modalHeight = profileModal.offsetHeight;
    var topPosition = (windowHeight - modalHeight) / 2;
    profileModal.style.top = topPosition + 'px';

    profileModal.classList.add('show');
    document.body.classList.add('modal-open');
}

function closeProfileModal() {
    // Chiudi il modal del profilo
    var profileModal = document.getElementById('profileModal');
    profileModal.classList.remove('show');
    setTimeout(function () {
        profileModal.style.display = 'none';
    }, 500);
    document.body.classList.remove('modal-open');
}