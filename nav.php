<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
      <script src="scripts/navjs.js"></script>
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
            <a  aria-current="page" class="brand w-nav-brand w--current"><img src="images/[removal.ai]_d1ffefac-a7c4-4aea-b9cd-0cb9642791d6-restore.png" alt="" width="131"></a>
            <div class="cart-nav-wrapper">
              <nav role="navigation" class="nav-menu w-nav-menu">
                <a href="index.php" aria-current="page" class="nav-link w-nav-link w--current">Home</a>
                <a href="infoRestore.php" class="nav-link w-nav-link">Info</a>
                <a href="SceltaParco.php" class="nav-link w-nav-link">Adotta</a>
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
        <button onclick="closeProfileModal()" class="w3-button w3-display-topright">&times;</button>
        <h2>Area Personale</h2>
        <button  class="btn profile-btn" id="AP">Area Personale</button>
          <form method="POST" action="logout.php">
            <input type="submit" class="btn login-btn" class="btn profile-btn" value="Logout">
          </form>
        </div>
    </div>
</div>

</div>
