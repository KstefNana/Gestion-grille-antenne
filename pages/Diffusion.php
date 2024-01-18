<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['IDPROGRAMME']))
		$idf=$_GET['IDPROGRAMME'];
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
		$resultat = $con->query("SELECT D.IDDIFFUSION,A.NOMANTENNE,P.NOMPROGRAMME,J.LIBELLEJOUR,D.DATEDIFFUSION,D.HEUREEBUTDIFFUSION,D.HEUREFINDIFFUSION,D.LIENDIFFUSION
								FROM  DIFFUSION D,ANTENNE A,JOUR J,PROGRAMME P
								WHERE A.IDANTENNE=D.IDANTENNE
								AND   P.IDPROGRAMME= D.IDPROGRAMME
								AND   J.CODEJOUR= D.CODEJOUR
								AND (D.IDDIFFUSION like '%$mc%' OR J.CODEJOUR like '%$mc%')
								ORDER BY D.IDDIFFUSION
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDIFFUSION 
								from DIFFUSION 
								where IDDIFFUSION like '%$mc%' OR CODEJOUR like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT D.IDDIFFUSION,A.NOMANTENNE,P.NOMPROGRAMME,J.LIBELLEJOUR,D.DATEDIFFUSION,D.HEUREEBUTDIFFUSION,D.HEUREFINDIFFUSION
								FROM  DIFFUSION D,ANTENNE A,JOUR J,PROGRAMME P
								WHERE A.IDANTENNE=D.IDANTENNE
								AND   P.IDPROGRAMME= D.IDPROGRAMME
								AND   J.CODEJOUR= D.CODEJOUR
								AND (D.IDDIFFUSION like '%$mc%' OR P.NOMPROGRAMME like '%$mc%')
								AND P.IDPROGRAMME=$idf
								ORDER BY D.IDDIFFUSION
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDIFFUSION 
								from DIFFUSION 
								where (IDDIFFUSION like '%$mc%' OR CODEJOUR like '%$mc%')
								AND IDPROGRAMME=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrDIFFUSION'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from PROGRAMME";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des DIFFUSIONS</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des DIFFUSIONS Tv</div>
					<div class="panel-body">
						<form method="get" action="Diffusion.php" class="form-inline">
						<div class="form-group">						
								<select name="IDPROGRAMME" id="IDPROGRAMME" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Tous Genres de Progammes</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['IDPROGRAMME']?>" 
											<?php echo $idf==$filiere['IDPROGRAMME']?"selected":"" ?>>
											<?php echo $filiere['NOMPROGRAMME']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Taper Un Mot Clé"
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
									<a class="btn btn-success" href="NouvelleDiffusion.php">Nouvelle DIFFUSION Tv</a>
									<a class="btn btn-success" href="NouveauJour.php">Les Jours de Diffusion</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des DIFFUSIONS (<?php echo $nbrPro ?> &nbspDIFFUSION (S)) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>JOURS</th>
									<th>DATE</th>
									<th>HEURE</th>
									<th>PROGRAMME</th>
									<th>ANTENNE</th>
									
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
									
									<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>VIDEO</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['LIBELLEJOUR'] ?></td>
										<td><?php echo $STAGIAIRE['DATEDIFFUSION'] ?></td>
										<td><?php echo $STAGIAIRE['HEUREEBUTDIFFUSION'] ?></td>
										<td><?php echo $STAGIAIRE['NOMPROGRAMME'] ?></td>	
										<td><?php echo $STAGIAIRE['NOMANTENNE'] ?></td>	
										
										
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerDiffusion.php?IDDIFFUSION=<?php echo $STAGIAIRE['IDDIFFUSION'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>											
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes Vous Sur de Vouloir Supprimer Cette DIFFUSION ?')" 
													href="SupprimerDiffusion.php?IDDIFFUSION=<?php echo $STAGIAIRE['IDDIFFUSION'] ?>">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
																							
											<?php } ?>
											
											<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="https://youtu.be/WcQi7OY5iGM" target="_blank">
													<span class="glyphicon glyphicon-film"></span>
												</a>
																							
											<?php } ?>
											
											</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de DIFFUSION Par Page </label>
											<input type="hidden" name="IDPROGRAMME" 
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
											<a href="Diffusion.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&IDPROGRAMME=<?php echo $idf ?>
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