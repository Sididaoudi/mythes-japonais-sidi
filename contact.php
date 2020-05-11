<?php 
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

  $erreurEmail = "";

  // Si le formulaire est envoyé
  if(!empty($_POST)) {
      $email = $_POST['mail'];
    
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $erreurEmail = '<p>Le format de l’email est invalide</p>';
      }else{

        // Requêtes SQL pour insérer une nouvelle ligne dans la base de données

        $result = $pdo->prepare('INSERT INTO messages (nom, mail, messages) VALUES (:nom, :mail, :messages)');
       // On remplace les éléments préparés par les données envoyées par le formulaire

        $result->execute(array(
          'nom' => $_POST['nom'],
          'mail' => $_POST['mail'],
          'messages' => $_POST['messages']
        ));
      }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include("nav.php"); ?>

    <div class="container">
    <form method="post" action="">

    <div class="card bg-light">
      <article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">Envoyer un message</h4>
  
      <div class="form-group input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-user"></i> </span>
        </div>
        <input class="form-control" placeholder="Nom" name="nom" type="text">
      </div>

      <div class="form-group input-group">

      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
      </div>

      <input type="text" placeholder="Adress mail" name="mail">
      <?php echo $erreurEmail; ?>

      <div class="form-group input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <br>
        <br>
        <input class="form-control" placeholder="message" name="messages" type="text">
      </div> <!-- form-group// -->
  

    <div class="form-group">
        <button type="submit" name="envoyer"> Envoyer</button>
    </div> 

    <a href="index.php">Retour à l'accueil</a>
  </form>
</div>
</body>
</html>

