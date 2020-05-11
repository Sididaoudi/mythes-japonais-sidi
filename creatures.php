<?php
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

   // Pagination
  $articlesParPage=4;
  $result = $pdo->query('SELECT COUNT(*) AS total FROM mythes');
  $donnees_total= $result->fetch(PDO::FETCH_ASSOC); //On range retour sous la forme d'un tableau.
  $total=$donnees_total['total'];
  // Compte le nombre de pages.
  $nombreDePages=ceil($total/$articlesParPage);

  if(isset($_GET['page'])) { // Si la variable $_GET['page'] existe...
     $pageActuelle=intval($_GET['page']);
     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     {
          $pageActuelle=$nombreDePages;
     }
  }
  else { // Sinon
     $pageActuelle=1; // La page actuelle est la n°1    
  }
  $premiereEntree=($pageActuelle-1)*$articlesParPage; // On calcul la première entrée à lire
 
// La requête sql pour récupérer les messages de la page actuelle.
$retour_messages=$pdo->query('SELECT * FROM mythes ORDER BY id DESC LIMIT '.$premiereEntree.', '.$articlesParPage.'');
 
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/logo.png">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php include("nav.php"); ?>

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
    <!-- Recherche -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
          <input type="text" class="form-control bg-light border-0 small" placeholder="" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
    </form>


  <div class="centered">
  <section class="cards">
  <?php
  while($donnees_messages= $retour_messages->fetch(PDO::FETCH_ASSOC)) { // On lit les entrées une à une grâce à une boucle
    ?>
    <article class="card">
          <img src="<?php echo $donnees_messages['img']; ?>">
          <div class="card-content">
            <h2><?php echo $donnees_messages["titre"]; ?></h2> 
            <a href="creature.php?id=<?php echo $donnees_messages['id']; ?>">Voir la fiche </a>
          </div>
    </article>
    <?php
  }
  echo '</section> </div> <p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
  for($i=1; $i<=$nombreDePages; $i++) { //On fait notre boucle
     //On va faire notre condition
     if($i==$pageActuelle) //S'il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }    
     else //Sinon...
     {
          echo ' <a href="creatures.php?page='.$i.'">'.$i.'</a> ';
     }
  }
  echo '</p>';

  ?>
    <!-- Bouton pour revenir en haut de page -->
    <div id="scrollUp">
      <a href="#top"><img src="img/to_top.png"/></a>
    </div>
</main>
</body>
</html>