<!DOCTYPE html>
    
  <link rel="stylesheet" href="registerstyle.css">

<head>
    
  <meta charset="utf-8" />
  <title>Pagina Registrazione</title>

</head>

<body class="body">

  <div class="w-layout-blockcontainer container-2 w-container">
  <h1 class="heading">Registrazione</h1>
    <div class="w-form">
      <form id="email-form" name="email-form" data-name="Email Form" method="post" class="form" action="register.php" enctype="multipart/form-data" onsubmit="return validateForm()">
          <label for="name"class="field-label-7">Immagine Profilo</label>  
          <input type="file" id="myfile" name="myfile" accept="image/png, image/jpeg" required id="image-input" onchange="resizeAndPreviewImage()">
          <label for="name"class="field-label-7">Nome</label>   
          <input class="w-input" maxlength="256" name="name" data-name="Name" placeholder="" type="text" id="name" />
          <label for="email-2" class="field-label-6">Cognome</label><input class="w-input" maxlength="256" name="cognome" data-name="Email 2" placeholder="" type="text" id="cognome" required="" />
          <label for="email-2" class="field-label-4">Email</label>
          <div id="email-check-result"></div>
          <input class="w-input" maxlength="256" name="email-2" data-name="Email 2" placeholder="" type="email" id="email-2" required="" />
          <label for="email-3" class="field-label-2">Password</label>
          <input class="w-input" maxlength="256" name="password" data-name="password" placeholder="" type="text" id="password" required="" />
          <label for="email-2" class="field-label">Conferma Password</label>
          <input class="text-field w-input" maxlength="256" name="psw-2" data-name="Email 2" placeholder="" type="text" id="psw-2" required="" />
          <input type="submit" data-wait="Please wait..." class="home-link" value="Registrati" />
          <a href="index.php" class="home-link">Torna alla Home</a>
        </form>
    </div>
   
    
  </div>
  
</body>
<script src="scripts/registrajs.js"></script>

</html>