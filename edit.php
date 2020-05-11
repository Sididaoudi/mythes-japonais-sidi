<?php
 // Connexion à la base de données
 $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));


  if (!empty($_GET['id'])) {

  // Si le formulaire est envoyé
  if(!empty($_POST)) {

      $result = $pdo->query("SELECT * FROM mythes WHERE id = $_GET[id]");

      $creature = $result->fetch(PDO::FETCH_ASSOC);

        // Update
        $result = $pdo->prepare('UPDATE mythes SET titre=:titre, img=:img, contenu=:contenu WHERE id = :id');
            $result->execute(array(
                'id' => $_GET['id'],
                'titre' => $_POST['titre'],
                'img' => $_POST['img'],
                'contenu' => $_POST['contenu']
            ));
    }
    }
   if(!empty($_GET['id'])) {
    $result2 = $pdo->prepare('SELECT * FROM mythes WHERE id = :id');
    $result2->execute(array(
        'id' => $_GET['id']
    ));
    $creature = $result2->fetch(PDO::FETCH_ASSOC);

    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editer</title>
	<meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/logo.png">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php include("nav-admin.php"); ?>

    <h1>Editer</h1>
    <!-- Formulaire pour editer -->
    <div class="editer">
    <form method="POST" action="">
      <label for="title">Titre</label>
      <input type="text" id="title" name="titre" value="<?php if(!empty($_GET['id'])) {echo $creature['titre'];} ?>">
      <br>
      <label for="img">Image</label>
      <input type="text" id="img" name="img" value="<?php if(!empty($_GET['id'])) {echo $creature['img'];} ?>">
      <br>
      <label for="contenu">Contenu</label>
      <textarea id="contenu" name="contenu"><?php if(!empty($_GET['id'])) {echo $creature['contenu'];} ?></textarea>
      <input type="submit" name="send-article">
      <br>
      <br>
      <a href="admin.php">Retour sur le dashboard</a>
    </form>
</body>
</html>