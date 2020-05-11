<?php 
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

  $erreurEmail = "";

  // Si le formulaire est envoyé
  if(!empty($_POST)) {
      $email = $_POST['email'];
    
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $erreurEmail = '<p>Le format de l’email est invalide</p>';
      }else{

        $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Requêtes SQL pour insérer une nouvelle ligne dans la base de données

        $result = $pdo->prepare('INSERT INTO utilisateurs (username, email, password) VALUES (:username, :email, :password)');
       // On remplace les éléments préparés par les données envoyées par le formulaire

        $result->execute(array(
          'username' => $_POST['username'],
          'email' => $_POST['email'],
          'password' => $hashedpassword
        ));
        header('location:login.php');

      }
    
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Page création de compte</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
<body>

 <form method="post" action="">

    <div class="card bg-light">
      <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">Créer mon compte</h4>
  
      <div class="form-group input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-user"></i> </span>
        </div>
        <input class="form-control" placeholder="Nom" name="username" type="text">
      </div>

      <div class="form-group input-group">

      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
      </div>

      <input type="text" placeholder="Adress mail" name="email">
      <?php echo $erreurEmail; ?>

      <div class="form-group input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <br>
        <br>
        <input class="form-control" minlength="5" placeholder=" mot de passe" name="password" type="password" >
      </div> <!-- form-group// -->

    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>
        <input class="form-control" placeholder="confirmer le mot de passe" type="password" name="confirmpassword">
    </div> <!-- form-group// --> 


    <div class="form-group">
        <button type="submit" name="inscription"> Inscription</button>
    </div> 

    <p class="text-center">Déjà inscrit ? <a href="login.php">Se connecter</a> </p>

    <a href="index.php">Retour à l'accueil</a>
  </form>
</body>
</html>