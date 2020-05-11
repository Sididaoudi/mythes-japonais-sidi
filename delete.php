<?php
 // Connexion à la base de données
 $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

  if(!empty($_GET['id'])) {
    $result2 = $pdo->prepare('SELECT * FROM mythes WHERE id = :id');
    $result2->execute(array(
        'id' => $_GET['id']
    ));
    $creature = $result2->fetch(PDO::FETCH_ASSOC);

  if(isset($_GET["delete"])) {
  // Requêtes SQL qui supprime une ligne en base en lui passant l'id de l'article
  $result = $pdo->prepare('DELETE FROM mythes WHERE id = :id');
  // On execute la requête en précisant que l'ID est celui passé en URL
  $result->execute(array(
      'id' => $_GET["delete"]
  ));
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/logo.png">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php include("nav-admin.php"); ?>

    <h1>Supprimer</h1>
    <!-- Formulaire pour supprimer -->
    <div class="ajouter">
    <form method="POST" action="">
      <label for="title">Titre</label>
      <input type="text" id="title" name="titre" value="<?php if(!empty($_GET['id'])) {echo $creature['titre'];} ?>">
      <br>
      <label for="img">Image</label>
      <input type="text" id="img" name="img" value="<?php if(!empty($_GET['id'])) {echo $creature['img'];} ?>">
      <br>
      <label for="contenu">Contenu</label>
      <textarea id="contenu" name="contenu"><?php if(!empty($_GET['id'])) {echo $creature['contenu'];} ?></textarea>
      <br>
      <span class="icon icon--time"><a href="?delete=<?php echo $listecreature["id"]; ?>." title="Supprimer"><i class="fas fa-trash-alt" style="color:#ff0000;"></i></span>Supprimer</a>
      <br>
      <span class="icon icon--time"><a href="?delete=<?php echo $listeArticle["id"]; ?>." title="Supprimer"><i class="fas fa-trash-alt" style="color:#ff0000;"></i></a></span>Supprimer
      <a href="admin.php">Retour sur le dashboard</a>
    </form>
</body>
</html>


