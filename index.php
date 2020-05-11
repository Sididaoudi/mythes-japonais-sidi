<?php
  // Connexion à la base de données
  $pdo = new PDO('mysql:host=localhost;dbname=mythesjaponais;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/logo.png">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<?php include("nav.php"); ?>

	<div id="landing"></div>

	<div class="container" >

		<div class="welcome">
			<p><span style="color: #666666;"><span class="s2">Le terme <strong>Yokai,</strong> </span><span class="s3">妖怪</span><span class="s2">, désigne l’ensemble des <strong>créatures étranges</strong> et <strong>surnaturelles</strong> du <strong>folklore japonais.</strong> Le mot en lui-même est une combinaison de Kanji japonais signifiant<span class="Apple-converted-space">  </span></span><span class="s3"><b>妖</b></span><span class="s2"><b><i> (yō) - attirant, envoûtant, calamité et </i></b></span><span class="s3"><b>怪</b></span><span class="s2"><b><i> (kai) - mystère, merveille.</i></b></span></span></p>
			<p class="p4">

			<span class="s2" style="color: #666666;">Des dizaines de mots sont utilisés dans la langue française pour traduire ce terme. Ainsi, il n’est pas rare de lui donner les traductions suivantes : <i>monstre, démon, esprit, ogre, fantôme…</i></span></p>

			<p class="p4"><span class="s2" style="color: #666666;">La grande difficulté pour donner une bonne définition à ce mot est qu’il englobe toutes les traductions cités auparavant et bien plus encore.</span></p></span>
		</div>
	</div>

	<div class="container" >
		<?php
		$result = $pdo->query('SELECT * FROM mythes ORDER BY id DESC LIMIT 3');

		while($listeMythe = $result->fetch(PDO::FETCH_ASSOC)){ ?>
	      <div class="text-center">
	        <h2><?php echo $listeMythe["titre"]; ?></h2> 
	        <img alt="Kitsune" class="image" src="<?php echo $listeMythe["img"]; ?>">
	        <p><?php echo $listeMythe["contenu"]; ?></p>
	      </div>
    	<?php } 
		?>
	</div>

  <!-- Bouton pour revenir en haut de page -->
   <div id="scrollUp">
      <a href="#top"><img src="img/to_top.png"/></a>
    </div>
<?php include("footer.inc.php"); ?>
</body>
</html>