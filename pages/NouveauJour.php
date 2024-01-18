<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Jour Diffusion</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Un Jour</div>
				<div class="panel-body">
					<form method="post" action="InsertJour.php" class="form" enctype="multipart/form-data">											
						
						<div class="form-group">
							<label for="CODEJOUR" class="control-label">CODE DU JOUR POUR DIFFUSION</label>
							<input type="text" name="CODEJOUR" id="CODEJOUR" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="LIBELLEJOUR" class="control-label">LIBELLE DU JOUR POUR DIFFUSION</label>
							<input type="text" name="LIBELLEJOUR" id="LIBELLEJOUR" class="form-control"/>
						</div>
											
						<button type="submit" class="btn btn-primary">ENREGISTRER</button>
						<input type="button" class="btn btn-warning" onclick="history.back();" value="ANNULER ENREGISTREMENT">
							
					</form>
				</div>
			</div>
										
		</div>
	</body>
</html>