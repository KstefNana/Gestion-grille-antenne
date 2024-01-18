<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODEGENREPROGRAMME']))
		$idf=$_GET['CODEGENREPROGRAMME'];
	else
		$idf="ALL";
		
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
		$resultat = $con->query("SELECT P.IDPROGRAMME,GP.LIBELLEGENREPROGRAMME,TP.LIBELLETYPEPROGRAMME,P.NOMPROGRAMME,P.IMAGEPROGRAMME, P.DUREEPROGRAMME,J.NOMJOURNALISTE,LP.CODELANGUEDIFFUSIONP
								FROM GENREPROGRAMME GP,TYPEPROGRAMME TP,PROGRAMME P,JOURNALISTE J,LANGUEDIFFUSIONP LP  
								WHERE GP.CODEGENREPROGRAMME=P.CODEGENREPROGRAMME
								AND   LP.CODELANGUEDIFFUSIONP = P.CODELANGUEDIFFUSIONP
								AND   TP.CODETYPEPROGRAMME = P.CODETYPEPROGRAMME
								AND   J.MATRICULEJOURNALISTE = P.MATRICULEJOURNALISTE
								AND (P.NOMPROGRAMME like '%$mc%' OR J.NOMJOURNALISTE like '%$mc%')
								ORDER BY P.IDPROGRAMME
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrPROGRAMME 
								from PROGRAMME 
								where NOMPROGRAMME like '%$mc%' OR MATRICULEJOURNALISTE like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT P.IDPROGRAMME,GP.LIBELLEGENREPROGRAMME,TP.LIBELLETYPEPROGRAMME,P.NOMPROGRAMME,P.IMAGEPROGRAMME, P.DUREEPROGRAMME,J.NOMJOURNALISTE,LP.CODELANGUEDIFFUSIONP
								FROM GENREPROGRAMME GP,TYPEPROGRAMME TP,PROGRAMME P,JOURNALISTE J,LANGUEDIFFUSIONP LP  
								WHERE GP.CODEGENREPROGRAMME=P.CODEGENREPROGRAMME
								AND   LP.CODELANGUEDIFFUSIONP = P.CODELANGUEDIFFUSIONP
								AND   TP.CODETYPEPROGRAMME = P.CODETYPEPROGRAMME
								AND   J.MATRICULEJOURNALISTE = P.MATRICULEJOURNALISTE
								AND GP.CODEGENREPROGRAMME=$idf
								ORDER BY P.IDPROGRAMME
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrPROGRAMME 
								from PROGRAMME 
								where (NOMPROGRAMME like '%$mc%' OR MATRICULEJOURNALISTE like '%$mc%')
								AND CODEGENREPROGRAMME=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrPROGRAMME'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from GENREPROGRAMME";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des PROGRAMMES</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des PROGRAMMES Tv</div>
					<div class="panel-body">
						<form method="get" action="ListeProgramme.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEGENREPROGRAMME" id="CODEGENREPROGRAMME" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Tous Genres de Progammes</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEGENREPROGRAMME']?>" 
											<?php echo $idf==$filiere['CODEGENREPROGRAMME']?"selected":"" ?>>
											<?php echo $filiere['LIBELLEGENREPROGRAMME']?>
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
									<a class="btn btn-success" href="NouveauProgramme.php">Nouveau PROGRAMME Tv</a>
									<a class="btn btn-success" href="NouvelleDiffusion.php">Nouvelle DIFFUSION Tv</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Progamme (<?php echo $nbrPro ?> &nbspProgamme (s)) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>GENRE</th>
									<th>TYPE</th>
									<th>LE PROGRAMME</th>
									<th>DUREE (EN MIN)</th>
									<th>JOURNALISTE</th>
									<th>LANGUE DIFF</th>
									<th>IMAGE</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['LIBELLEGENREPROGRAMME'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPEPROGRAMME'] ?></td>
										<td><?php echo $STAGIAIRE['NOMPROGRAMME'] ?></td>
										<td><?php echo $STAGIAIRE['DUREEPROGRAMME'] ?></td>	
										<td><?php echo $STAGIAIRE['NOMJOURNALISTE'] ?></td>	
										<td><?php echo $STAGIAIRE['CODELANGUEDIFFUSIONP'] ?></td>	
										<td>
											<img src="../images/<?php echo $STAGIAIRE['IMAGEPROGRAMME']?>" 
												class="img-thumbnail"  width="50" height="40" >
										</td>	
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un programme -->
												<a href="EditerProgramme.php?IDPROGRAMME=<?php echo $STAGIAIRE['IDPROGRAMME'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>&nbsp &nbsp
											<!--  Action Editer une FILIERE -->
											<a href="ListeDiffuson.php?IDPROGRAMME=<?php echo $STAGIAIRE['IDPROGRAMME'] ?>">
												<span class="glyphicon glyphicon-tasks"></span>
											</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un programme -->
												<a Onclick="return confirm('Etes Vous Sur de Vouloir Supprimer Ce Programme ?')" 
													href="SupprimerProgramme.php?IDPROGRAMME=<?php echo $STAGIAIRE['IDPROGRAMME'] ?>">
													<span class="glyphicon glyphicon-trash"></span>
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
											<label>Nombre de PROGRAMME Par Page </label>
											<input type="hidden" name="CODEGENREPROGRAMME" 
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
											<a href="ListeProgramme.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEGENREPROGRAMME=<?php echo $idf ?>
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