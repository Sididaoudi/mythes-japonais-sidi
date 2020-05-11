<?php
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin liste creatures</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/logo.png">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php include("nav-admin.php"); ?>


    <!-- Script scroll -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
 
    <script>
      jQuery(function(){
          $(function () {
              $(window).scroll(function () {
                  if ($(this).scrollTop() > 400 ) { 
                          $('#scrollUp').css('right','10px');
                        } else { 
                            $('#scrollUp').removeAttr( 'style' );
                        }
                        });
                        });
                        });
     </script>
    <!-- Menu titre -->
    <header class="masthead clear">
      <div class="centered">
        <div class="site-branding">
          <h1 class="site-title">Les mythes</h1>
        </div> 
      </div>
    </header>

  <div class="centered">
    <section class="cards">
      <?php
      // Permet de sélectionner depuis la table mythes les élements que l'on veut afficher 
      $result = $pdo->query('SELECT * FROM mythes ORDER BY id DESC');
       while($listeMythe = $result->fetch(PDO::FETCH_ASSOC)){ ?>
         <article class="card">
          <img src="<?php echo $listeMythe['img']; ?>">
          </figure>
          <div class="card-content">
            <h2><?php echo $listeMythe["titre"]; ?></h2> 
            <a href="edit.php?id=<?php echo $listeMythe['id']; ?>">Modifier l'article </a><br>
            <a href="delete.php?id=<?php echo $listeMythe['id']; ?>">Supprimer l'article </a><br>
          </div>
         </article>
      <?php } 
     ?>
    <!-- Bouton pour revenir en haut de page -->
    <div id="scrollUp">
      <a href="#top"><img src="img/to_top.png"/></a>
    </div>
</main>
</body>
</html>