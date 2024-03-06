<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>

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
                <a href="/" aria-current="page" class="nav-link w-nav-link w--current">Home</a>
                <a href="/about" class="nav-link w-nav-link">Info</a>
                <a href="/shop" class="nav-link w-nav-link">Adotta</a>
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

<!--MODAL-->
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
                updateLoginButton(response.username);
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

function updateLoginButton(username) {
    var loginButton = document.querySelector('.login-button');
    if (loginButton) {
        loginButton.innerHTML = username;
        loginButton.disabled = true;

        // Puoi anche aggiungere un link per il logout se necessario
        var logoutLink = document.createElement('a');
        logoutLink.href = '#';
        logoutLink.innerHTML = 'Logout';
        logoutLink.className = 'nav-link w-nav-link';
        logoutLink.onclick = function () {
            logout();
            return false;
        };
        

        loginButton.parentNode.appendChild(logoutLink);
    }
}

function logout() {
    // Esegui la chiamata AJAX per effettuare il logout (se necessario)

    // Rimuovi le informazioni dell'utente dalla sessione
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "logout.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Ricarica la pagina dopo il logout
            location.reload();
        }
    };

    xhr.send();
}
</script>

</div>
