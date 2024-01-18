<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteg="select * from GRILLE";
	$resultatg = $con->query($requeteg);
	
	$requetel="select * from LANGUEDIFFUSIONP";
	$resultatl = $con->query($requetel);
	
	$requetet="select * from TYPEPROGRAMME";
	$resultatt = $con->query($requetet);
	
	$requetee="select * from EQUIPEPRODUCTION";
	$resultate = $con->query($requetee);
	
	$requetege="select * from GENREPROGRAMME";
	$resultatge = $con->query($requetege);
	
	$requetej="select * from JOURNALISTE";
	$resultatj = $con->query($requetej);
	
	
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouveau Progamme Tv</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouveau Progamme Tv</div>
				<div class="panel-body">
					<form method="post" action="InsertProgramme.php" class="form" enctype="multipart/form-data">
						<div class="form-group">
							<label for="IDGRILLE" class="control-label">GRILLE Tv ASSOCIEE</label>
							<select name="IDGRILLE" id="IDGRILLE" class="form-control">
								<?php while($filiereg=$resultatg->fetch()){ ?>
									<option value="<?php echo $filiereg['IDGRILLE']?>">
										<?php echo $filiereg['NOMGRILLE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODELANGUEDIFFUSIONP" class="control-label">LANGUE DE DIFFUSION DU PROGRAMME</label>
							<select name="CODELANGUEDIFFUSIONP" id="CODELANGUEDIFFUSIONP" class="form-control">
								<?php while($filierel=$resultatl->fetch()){ ?>
									<option value="<?php echo $filierel['CODELANGUEDIFFUSIONP']?>">
										<?php echo $filierel['LIBELLELANGUEDIFFUSIONP']?>
									</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="CODETYPEPROGRAMME" class="control-label">LE TYPE DE PROGRAMME</label>
							<select name="CODETYPEPROGRAMME" id="CODETYPEPROGRAMME" class="form-control">
								<?php while($filieret=$resultatt->fetch()){ ?>
									<option value="<?php echo $filieret['CODETYPEPROGRAMME']?>">
										<?php echo $filieret['LIBELLETYPEPROGRAMME']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDEQUIPEPRODUCTION" class="control-label">EQUIPE DE PRODUCTION DU PROGRAMME</label>
							<select name="IDEQUIPEPRODUCTION" id="IDEQUIPEPRODUCTION" class="form-control">
								<?php while($filieree=$resultate->fetch()){ ?>
									<option value="<?php echo $filieree['IDEQUIPEPRODUCTION']?>">
										<?php echo $filieree['NOMEQUIPEPRODUCTION']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEGENREPROGRAMME" class="control-label">LE GENRE CORRESPONDANT AU PROGRAMME</label>
							<select name="CODEGENREPROGRAMME" id="CODEGENREPROGRAMME" class="form-control">
								<?php while($filierege=$resultatge->fetch()){ ?>
									<option value="<?php echo $filierege['CODEGENREPROGRAMME']?>">
										<?php echo $filierege['LIBELLEGENREPROGRAMME']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="MATRICULEJOURNALISTE" class="control-label">LE JOURNALISTE PRESENTATEUR DU PROGRAMME</label>
							<select name="MATRICULEJOURNALISTE" id="MATRICULEJOURNALISTE" class="form-control">
								<?php while($filierej=$resultatj->fetch()){ ?>
									<option value="<?php echo $filierej['MATRICULEJOURNALISTE']?>">
										<?php echo $filierej['NOMJOURNALISTE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="NOMPROGRAMME" class="control-label">LE NOM DU PROGRAMME</label>
							<input type="text" name="NOMPROGRAMME" id="NOMPROGRAMME" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DUREEPROGRAMME" class="control-label">DUREE EN MINUTES DU PROGRAMME</label>
							<input type="number" name="DUREEPROGRAMME" id="DUREEPROGRAMME" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="IMAGEPROGRAMME" class="control-label">IMAGE ILLUSTRATIVE DU PROGRAMME :</label>
							<input type="file" name="IMAGEPROGRAMME" id="IMAGEPROGRAMME"/>
						</div>						
						<button type="submit" class="btn btn-primary">ENREGISTRER NOUVEAU PROGRAMME</button>
						<input type="button" class="btn btn-warning" onclick="history.back();" value="ANNULER L'AJOUT">
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



