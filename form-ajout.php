<?php 
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

  // Si le formulaire est envoyé
  if(!empty($_POST)) {
    // Requêtes SQL pour insérer une nouvelle ligne dans la base de données
    $result = $pdo->prepare('INSERT INTO mythes (titre, img, contenu) VALUES (:titre, :img, :contenu)');
    // On remplace les éléments préparés par les données envoyées par le formulaire
    $result->execute(array(
          'titre' => $_POST['titre'],
          'img' => $_POST['img'],
          'contenu' => $_POST['contenu']
    ));
  } 
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Ajouter un article</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>

    <?php include("nav-admin.php"); ?>


     <h1>Ajouter un nouvel article</h1>
    <!-- Formulaire pour ajouter un article en base de données -->
    <div class="ajouter">
    <form method="POST" action="">
      <label for="title">Titre</label>
      <input type="text" id="title" name="titre">
      <label for="text">Ajouter l'image</label>
      <input type="file" name="img">
      <br>
      <br>
      <label for="contenu">Contenu</label>
      <textarea id="contenu" name="contenu"></textarea>
      <input type="submit" name="send-article">
      <br>
      <br>
      <a href="admin.php">
    </form>
  </div>
</body>
</html>