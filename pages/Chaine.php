<?php
	require_once('session.php');
?>

<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=5;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	
		$resultat1 = $con->query("SELECT * FROM CHAINE
									WHERE  NOMCHAINE like '%$mc%' 
									ORDER BY IDCHAINE
									LIMIT $size
									OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrCHAINE 
									from CHAINE 
									where NOMCHAINE like '%$mc%'");
	
	
	$nbr=$resultat2->fetch();
	
	$nbrF=$nbr['nbrCHAINE'];
	
	$reste=$nbrF % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrF sur $size
	if($reste==0)
		$nbrPage=$nbrF/$size;
	else
		$nbrPage=floor($nbrF/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Les Chaines de La Tv</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">
		<?php include('entete.php');?>
			
		<div class="container">
			<div class="panel panel-success espace60">
				<div class="panel-heading">Rechercher des Chaines de La Tv</div>
				<div class="panel-body">
					<form method="get" action="filieres.php" class="form-inline">
						<div class="form-group">													
							
							<input type="text" name="motCle" 
									placeholder="Taper Un Mot Clé (Chaine)"
									id="motCle" class="form-control" 
									value="<?php echo $mc; ?>"/>							

							<button type="submit" class="btn btn-success">
								<i class="glyphicon glyphicon-search"></i>
								Lancer La Recherche . . .
							</button>
							
							&nbsp&nbsp&nbsp
							<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
								
								<a class="btn btn-success" href="NouvelleChaine.php">Nouvelle Chaine Tv</a>
							<?php } ?>	
						</div>
							
					</form>
				</div>
			</div>
			<div class="panel panel-primary ">
				<div class="panel-heading">Liste des Chaine (<?php echo $nbrF ?>&nbspChaine (s)) </div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID CHAINE</th>
								<th>NOM DE LA CHAINE</th>
														
								 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
									<th>ACTIONS</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php while($FILIERE=$resultat1->fetch()){?>
								<tr>
									<td><?php echo $FILIERE['IDCHAINE'] ?></td>
									<td><?php echo $FILIERE['NOMCHAINE'] ?></td>
									
									
									<td>
										<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
											<!--  Action Editer une FILIERE -->
											<a href="EditerChaine.php?IDCHAINE=<?php echo $FILIERE['IDCHAINE'] ?>">
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
											&nbsp &nbsp
											<!--  Action Editer une FILIERE -->
											<a href="ListeGrille.php?IDCHAINE=<?php echo $FILIERE['IDCHAINE'] ?>">
												<span class="glyphicon glyphicon-tasks"></span>
											</a>
											
											&nbsp &nbsp
											<!--  Action Supprimer une FILIERE -->
											<a Onclick="return confirm('Etes Vous Sur de Vouloir Supprimer La Chaine ?')" 
												href="SupprimerChaine.php?IDCHAINE=<?php echo $FILIERE['IDCHAINE'] ?>">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
																						
										<?php } ?>
										
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<div>
						<ul class="nav nav-pills">
							
							<?php for($i=1;$i<=$nbrPage;$i++){ ?>
								<li class="<?php if($i==$page) echo 'active' ?>">
									<a href="Chaines.php?page=<?php echo $i ?>
										&motCle=<?php echo $mc ?>
										
										Page <?php echo $i ?>
									</a>
								</li>
							<?php } ?>	
						</ul>
					</div>
					
				</div>				
			</div>	
			
		</div>
	</body>
</html>