<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header"> 
			<a href="accueil.php" class="navbar-brand">gestionCRTV</a>
		</div>
		
		<ul class="nav navbar-nav">
			
			<li><a href="Ressources.php">Ressources</a></li>
			<li><a href="Chaine.php">Chaines</a></li>
			<li><a href="grille.php">Grilles</a></li>
			<li><a href="ListeProgramme.php">Programmes</a></li>
			<li><a href="Diffusion.php">Diffusions</a></li>
			<li><a href="Recherches.php">Recherches</a></li>
			<li><a href="Statistiques.php">Statistiques</a></li>
			<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
				<li><a href="Utilisateurs.php">Utilisateurs</a></li>
			<?php } ?>
			
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="editerUtilisateur.php?id=<?php echo $_SESSION['utilisateur']['ID'];?>">
						<span class="glyphicon glyphicon-user"></span> 
						<?php echo $_SESSION['utilisateur']['LOGIN'];?>
					</a>
				</li>
				<li>
					<a href="SeDeconnecter.php">
						<span class="glyphicon glyphicon-log-out"></span>
						Se Deconnecter
					</a>
				</li>
			</ul>
	</div>
</nav>