<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['IDCHAINE']))
		$idf=$_GET['IDCHAINE'];
	else
		$idf=0;
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if($idf==0){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT G.IDGRILLE,C.NOMCHAINE,G.NOMGRILLE,G.DATELANCEMENTGRILLE,G.DATEFINGRILLE
								FROM GRILLE G,CHAINE C
								WHERE G.IDCHAINE=C.IDCHAINE
								AND (C.NOMCHAINE like '%$mc%' OR G.NOMGRILLE like '%$mc%')
								ORDER BY G.IDGRILLE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrGRILLE 
								from GRILLE 
								where NOMGRILLE like '%$mc%' OR IDCHAINE like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT G.IDGRILLE,C.NOMCHAINE,G.NOMGRILLE,G.DATELANCEMENTGRILLE,G.DATEFINGRILLE
								FROM GRILLE G,CHAINE C
								WHERE G.IDCHAINE=C.IDCHAINE
								AND (C.NOMCHAINE like '%$mc%' OR G.NOMGRILLE '%$mc%')
								And IDCHAINE=$idf
								ORDER BY G.IDGRILLE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrGRILLE 
								from GRILLE 
								where (NOMGRILLE like '%$mc%' OR IDCHAINE like '%$mc%')
								And IDCHAINE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrGRILLE'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from grille where idgrille=1";
	$resultatf = $con->query($requetef);
	$grille=$resultatf->fetch();
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des GRILLES</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des GRILLES</div>
					<div class="panel-body">
						<form method="get" action="grille.php" class="form-inline">
						<div class="form-group">						
								<select name="IDCHAINE" id="IDCHAINE" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Toutes Les Chaines</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['IDCHAINE']?>" 
											<?php echo $idf==$filiere['IDCHAINE']?"selected":"" ?>>
											<?php echo $filiere['NOMCHAINE']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Taper Les Mots Clés"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Lancer La Recherche . . . 
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<a class="btn btn-success" href="Nouvellegrille.php">Nouvelle Grille Tv</a>
									<a class="btn btn-success" href="NouveauProgramme.php">Nouveau Programme Tv</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Grilles de Télévision (<?php echo $nbrPro ?> &nbspGrille (s) Tv) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>N° GRILLE</th>
									<th>LA CHAINE ASSOCIEE</th>
									<th>LIBELLE DE LA GRILLE</th>
									<th>DATE DE LANCEMENT</th>
									<th>DATE FIN GRILLE</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								
									<tr>
										<td><?php echo $grille['IDGRILLE'] ?></td>
										<td><?php echo $grille['IDCHAINE'] ?></td>
										<td><?php echo $grille['NOMGRILLE'] ?></td>
										<td><?php echo $grille['DATELANCEMENTGRILLE'] ?></td>	
										<td><?php echo $grille['DATEFINGRILLE'] ?></td>	
										
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="Editergrille.php?IDGRILLE=<?php echo $grille['IDGRILLE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>&nbsp &nbsp
											<!--  Action Editer une FILIERE -->
											<a href="ListeProgramme.php?IDGRILLE=<?php echo $grille['IDGRILLE'] ?>">
												<span class="glyphicon glyphicon-tasks"></span>
											</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer une grille -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer la grille?')" 
													href="Supprimergrille.php?IDGRILLE=<?php echo $grille['IDGRILLE'] ?>">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
																							
									
											
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de GRILLE par Page </label>
											<input type="hidden" name="IDCHAINE" 
												value="<?php echo $idf ?>">
											<input type="hidden" name="motCle" 
												value="<?php echo $mc ?>">
											<input type="hidden" name="page" 
												value="<?php echo $page ?>">
											<select name="size" class="form-control"
													onchange="this.form.submit()">
												<option <?php if($size==5)  echo "selected" ?>>5</option>
												<option <?php if($size==10) echo "selected" ?>>10</option>
												<option <?php if($size==15) echo "selected" ?>>15</option>
												<option <?php if($size==20) echo "selected" ?>>20</option>
												<option <?php if($size==25) echo "selected" ?>>25</option>
											</select>
										</form>
									</li>
									<?php for($i=1;$i<=$nbrPage;$i++){ ?>
										<li class="<?php if($i==$page) echo 'active' ?>">
											<a href="grille.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&IDCHAINE=<?php echo $idf ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>