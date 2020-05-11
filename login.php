<?php 
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

  // Si le formulaire est envoyé

  $error = "";


  if ($_POST) {

    if (!empty($_POST['email'])) {

    $ErrorConnection = true;

    $result = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = :email');
    $result->execute(array(
        'email' => $_POST['email']
    ));
        while($users = $result->fetch(PDO::FETCH_ASSOC)){
            if (($_POST['email'] == $users["email"]) && (password_verify($_POST['password'], $users["password"]))) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['connecté'] = "connecté";
                $ErrorConnection = false;
                header('Location:admin.php');
                exit();
                }
        }
        if ($ErrorConnection == true) {
            $error = "Le mot de passe ou l'email est faux";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Page de connexion</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  </head>
<body>

 <form method="POST" action="">
  <div class="card bg-light">
  <article class="card-body mx-auto" style="max-width: 400px;">
    <h4 class="card-title mt-3 text-center">Se connecter</h4>
  
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
      </div>
        <input class="form-control" placeholder="adress mail" type="email" name="email">
    </div> <!-- form-group// -->

    <div class="form-group input-group">
   
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
      </div>
        <input class="form-control" placeholder="mot de passe" type="password" name="password">
    </div> <!-- form-group// -->   

    <div>
         <input type="submit" name="connecter" value="Se connecter" class="btn"><br>
    </div>

      <a href="register.php">Pas encore inscrit ?</a>
    
      <a href="index.php">Retour à l'accueil</a>
    </article>
      <div class="text-center"><?php echo $error;  ?></div>
  </div>
  </form>
</body>
</html>
