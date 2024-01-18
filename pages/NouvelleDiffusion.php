<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteA="select * from ANTENNE";
	$resultatA = $con->query($requeteA);
	
	$requeteP="select * from PROGRAMME";
	$resultatP = $con->query($requeteP);
	
	$requeteJ="select * from JOUR";
	$resultatJ = $con->query($requeteJ);	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Diffusion Tv</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Diffusion Tv</div>
				<div class="panel-body">
					<form method="post" action="InsertDiffusion.php" class="form" enctype="multipart/form-data">
						<div class="form-group">
							<label for="IDANTENNE" class="control-label">ANTENNE DE LA CHAINE CONCERNEE</label>
							<select name="IDANTENNE" id="IDANTENNE" class="form-control">
								<?php while($filiereA=$resultatA->fetch()){ ?>
									<option value="<?php echo $filiereA['IDANTENNE']?>">
										<?php echo $filiereA['NOMANTENNE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDPROGRAMME" class="control-label">NOM DU PROGRAMME A DIFFUSER</label>
							<select name="IDPROGRAMME" id="IDPROGRAMME" class="form-control">
								<?php while($filiereP=$resultatP->fetch()){ ?>
									<option value="<?php echo $filiereP['IDPROGRAMME']?>">
										<?php echo $filiereP['NOMPROGRAMME']?>
									</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="CODEJOUR" class="control-label">JOUR(S) DE DIFFUSION DU PROGRAMME</label>
							<select name="CODEJOUR" id="CODEJOUR" class="form-control">
								<?php while($filieretJ=$resultatJ->fetch()){ ?>
									<option value="<?php echo $filieretJ['CODEJOUR']?>">
										<?php echo $filieretJ['LIBELLEJOUR']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						
						<div class="form-group">
							<label for="DATEDIFFUSION" class="control-label">DATE DE DIFFUSION DU PROGRAMME</label>
							<input type="date" name="DATEDIFFUSION" id="DATEDIFFUSION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREEBUTDIFFUSION" class="control-label">HEURE DEBUT DIFFUSION</label>
							<input type="time" name="HEUREEBUTDIFFUSION" id="HEUREEBUTDIFFUSION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREFINDIFFUSION" class="control-label">HEURE FIN DIFFUSION</label>
							<input type="time" name="HEUREFINDIFFUSION" id="HEUREFINDIFFUSION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="LIENDIFFUSION" class="control-label">LIEN YOUTUBE DE LA VIDEO</label>
							<input type="text" name="LIENDIFFUSION" id="LIENDIFFUSION" class="form-control"/>
						</div>
						
												
						<button type="submit" class="btn btn-primary">ENREGISTRER LA NOUVELLE DIFFUSION</button>
						<input type="button" class="btn btn-warning" onclick="history.back();" value="ANNULER L'ENREGISTREMENT">
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



