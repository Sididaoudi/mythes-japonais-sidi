<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['Deconnexion'])) {
    if (isset($_SESSION['connecté'])) {
        unset($_SESSION['connecté']);
        session_destroy();
    }
    header('Location:login.php');
    exit();
}

 // Connexion à la base de données
 $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

$result = $pdo->query("SELECT count(id) AS total FROM mythes");
$nb_creatures = $result->fetch(PDO::FETCH_ASSOC);
$nb_total_creatures = $nb_creatures['total'];

$erreurEmail = "";

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
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Admin Dashboard</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/logo.png">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Création d'un nouvel article -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="form-ajout.php" data-toggle="" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Créer un nouvel article</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Edit article -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="edit.php" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Editer</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        </div>
      </li>

       <!-- Liste creatures -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="liste-admin-creatures.php" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Voir créatures</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        </div>
      </li>

      <!-- Erreur 404 -->
      <li class="nav-item">
        <a class="nav-link" href="404.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Page Erreur</span></a>
      </li>

      <!-- Nav Deconnexion -->
      
      <form method="POST" action="">
          <input class="deco" type="submit" name="Deconnexion" value="Deconnexion">
      </form>
      </ul>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Recherche -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Chercher..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
    


          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Contenu de la page -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

             <!-- Nombre de créatures en base -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nombre de créatures en base</div>
                      <?php
                        echo "Il y a actuellement " .$nb_total_creatures ." créatures";
                      ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Nombre de page vues -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nombre de page vues</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

       

  <!-- Script -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
