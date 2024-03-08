<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
      <script>
       document.addEventListener("DOMContentLoaded", function () {
    // Esegui una chiamata AJAX per ottenere le informazioni sulla sessione dal server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "keeplogin.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var sessionInfo = JSON.parse(xhr.responseText);

            if (sessionInfo.isLoggedIn) {
                // L'utente è loggato, aggiorna il bottone di login
                updateLoginButton(sessionInfo.img, sessionInfo.imginfo);
            }
        }
    };

    xhr.send();
});
    </script>
</head>
<div class="menu-wrapper">
      <div class="w-dyn-list">
        <div role="list" class="w-dyn-items">
          <div role="listitem" class="w-dyn-item"></div>
        </div>
        <div class="alert-empty w-dyn-empty"></div>
      </div>
      <div data-collapse="medium" data-animation="over-right" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
        <div class="container">
          <div class="nav-wrapper">
            <a href="/" aria-current="page" class="brand w-nav-brand w--current"><img src="images/[removal.ai]_d1ffefac-a7c4-4aea-b9cd-0cb9642791d6-restore.png" alt="" width="131"></a>
            <div class="cart-nav-wrapper">
              <nav role="navigation" class="nav-menu w-nav-menu">
                <a href="index.php" aria-current="page" class="nav-link w-nav-link w--current">Home</a>
                <a href="/about" class="nav-link w-nav-link">Info</a>
                <a href="SceltaParco.php" class="nav-link w-nav-link">Adotta</a>
                <a href="/donations" class="nav-link w-nav-link">Iscrizioni</a>
                <button onclick="openModal()" class="nav-link w-nav-link login-button" id="loginbutton">Login</button>
              </nav>

              <div class="nav-button w-nav-button">
                <div class="w-icon-nav-menu"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!--MODAL LOGIN-->
<div id="id01" class="w3-modal" style="display: none;">
    <div class="w3-modal-content">
        <div class="w3-container">
            <button onclick="closeModal()" class="w3-button w3-display-topright">&times;</button>
            <h2>Login</h2>
            <form method='POST' onsubmit="return handleLogin();">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" class="btn login-btn" value="Login">
            </form>
            <p>Non hai un account? <a href="registrazione.php" onclick="openRegistrationModal()">Registrati</a>.</p>
        </div>
    </div>
</div>

<!--MODAL LOGOUT-->
<div id="profileModal" class="w3-modal" style="display: none;">
    <div class="w3-modal-content">
        <div class="w3-container">
          <form method="POST" action="logout.php">
            <button onclick="closeProfileModal()" class="w3-button w3-display-topright">&times;</button>
            <h2>Area Personale</h2>
            <button onclick="goToPersonalArea()" class="btn profile-btn">Area Personale</button>
            <input type="submit" class="btn login-btn" class="btn profile-btn" value="Logout">
          </form>
        </div>
    </div>
</div>

  <script>
   
  function openModal() {
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
    var modal = document.getElementById('id01');
    modal.classList.remove('show');
    setTimeout(function () {
        modal.style.display = 'none';
    }, 500); // Il valore 500 è la durata dell'animazione in millisecondi

    // Rimuovi la classe dal body per abilitare lo scrolling
    document.body.classList.remove('modal-open');
  }
  function handleLogin() {
    var email = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Esegui la chiamata AJAX
    var xhr = new XMLHttpRequest();
    var url = "login.php";
    var params = "username=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password);
    xhr.open("POST", url, true);

    // Imposta l'intestazione per indicare che la richiesta contiene dati JSON
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.success == true) {
                updateLoginButton(response.img,response.imginfo);
                closeModal();
            } else {
                alert("Errore di login: " + response.message);
            }
        }
    };

    // Invia la richiesta con i dati del modulo
    xhr.send(params);

    // Impedisce il normale invio del modulo
    return false;
}

function updateLoginButton(imgBase64,imgInfo) {
    var loginButton = document.querySelector('.login-button');
    if (loginButton) {
        // Rimuovi il contenuto esistente e abilita l'immagine di sfondo
        loginButton.innerHTML = "";
        loginButton.onclick= openProfileModal;
        loginButton.style.backgroundImage = "url('data:image/" + imgInfo + ";base64," + imgBase64 + "')";
        loginButton.classList.add('logged-in'); // Aggiungi la classe 'logged-in'
        loginButton.style.backgroundSize = "cover";
        loginButton.style.borderRadius = "50%";
        loginButton.style.width = "50px"; // Imposta la larghezza del cerchio
        loginButton.style.height = "50px"; // Imposta l'altezza del cerchio
        

    }
}
function openProfileModal() {
    var profileModal = document.getElementById('profileModal');
    profileModal.style.display = 'flex';

    // Calcola e imposta la posizione del modal al centro
    var windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    var modalHeight = profileModal.offsetHeight;
    var topPosition = (windowHeight - modalHeight) / 2;
    profileModal.style.top = topPosition + 'px';

    profileModal.classList.add('show');
    // Aggiungi una classe al body per disabilitare lo scrolling
    document.body.classList.add('modal-open');
}

function closeProfileModal() {
    var profileModal = document.getElementById('profileModal');
    profileModal.classList.remove('show');
    setTimeout(function () {
        profileModal.style.display = 'none';
    }, 500); // Durata dell'animazione in millisecondi

    // Rimuovi la classe dal body per abilitare lo scrolling
    document.body.classList.remove('modal-open');
}


</script>

</div>
