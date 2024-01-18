<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['NOMJOURNALISTE']))
		$idf=$_GET['NOMJOURNALISTE'];
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
	
	if($idf=="ALL"){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT MATRICULEJOURNALISTE,NOMJOURNALISTE,PRENOMJOURNALISTE,IMAGEPHOTOJOURNALISTE,TELJOURNALISTE
								FROM JOURNALISTE
								WHERE (MATRICULEJOURNALISTE like '%$mc%' OR NOMJOURNALISTE like '%$mc%')
								ORDER BY MATRICULEJOURNALISTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrJOURNALISTE 
								from JOURNALISTE 
								where MATRICULEJOURNALISTE like '%$mc%' OR NOMJOURNALISTE like '%$mc%'");
	
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrJOURNALISTE'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from filiere";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Les Ressources</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher JOURNALISTE</div>
					<div class="panel-body">
						<form method="get" action="Ressources.php" class="form-inline">
						<div class="form-group">						
								
								<input type="text" name="motCle" 
										placeholder="Taper Mot Clé"
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
									<a class="btn btn-success" href="NouvelRes.php">Enregister JOURNALISTE</a>
									<a class="btn btn-success" href="">Enregister REGISSEUR Tv</a>
									<a class="btn btn-success" href="NouveauJour.php">Les Jours de Diffusion</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Ressources Humaines (<?php echo $nbrPro ?> &nbsp JOURNALISTE) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>MATRICULE</th>
									<th>NOM DU JOURNALISTE</th>
									<th>PRENOM</th>
									<th>CONTACT TEL.</th>
									<th>PHOTOGRAPHIE</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['MATRICULEJOURNALISTE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMJOURNALISTE'] ?></td>
										<td><?php echo $STAGIAIRE['PRENOMJOURNALISTE'] ?></td>
										<td><?php echo $STAGIAIRE['TELJOURNALISTE'] ?></td>	
										<td>
											<img src="../images/<?php echo $STAGIAIRE['IMAGEPHOTOJOURNALISTE']?>" 
												class="img-thumbnail"  width="50" height="100" >
										</td>	
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerRes.php?MATRICULEJOURNALISTE=<?php echo $STAGIAIRE['MATRICULEJOURNALISTE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le STAGIAIRE?')" 
													href="SupprimerRes.php?MATRICULEJOURNALISTE=<?php echo $STAGIAIRE['MATRICULEJOURNALISTE'] ?>">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
												&nbsp &nbsp
												<a href="Liste.php?MATRICULEJOURNALISTE=<?php echo $STAGIAIRE['MATRICULEJOURNALISTE'] ?>">
													<span class="glyphicon glyphicon-eye-open"></span>
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
											<label>Nombre de JOURNALISTE par Page </label>
											<input type="hidden" name="NOMJOURNALISTE" 
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
											<a href="Ressources.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&NOMJOURNALISTE=<?php echo $idf ?>
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