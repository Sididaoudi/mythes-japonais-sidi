<?php
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

  $result = $pdo->prepare('SELECT * FROM mythes WHERE id = :id');
  $result->execute(array(
          'id' => $_GET['id']
           ));
  $creature = $result->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="css/style.css">
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php include("nav.php"); ?>

<main class="main-area">
  <div class="centered">
    <article class="card">
      <section class="cards">
      <?php

        $result = $pdo->query("SELECT * FROM mythes");
         echo $creature["titre"];
      ?>
      <br>
      <img src="<?php
         echo $creature["img"];
      ?>">
      <br>
      <?php
         echo $creature["contenu"];
      ?>
      </section>
    </article>
  </div>
</main>
<?php include("footer.inc.php"); ?>
</body>
</html>