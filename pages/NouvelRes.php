<?php
	require_once('session.php');
	
	require_once('connexion.php');
	$requetef="select * from filiere";
	$resultatf = $con->query($requetef);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouveau JOURNALISTE</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouveau JOURNALISTE</div>
				<div class="panel-body">
					<form method="post" action="InsertRes.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="MATRICULEJOURNALISTE" class="control-label">MATRICULE DU JOURNALISTE</label>
							<input type="text" name="MATRICULEJOURNALISTE" id="MATRICULEJOURNALISTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="NOMJOURNALISTE" class="control-label">NOM DU JOURNALISTE</label>
							<input type="text" name="NOMJOURNALISTE" id="NOMJOURNALISTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="PRENOMJOURNALISTE" class="control-label">PRENOM DU JOURNALISTE</label>
							<input type="text" name="PRENOMJOURNALISTE" id="PRENOMJOURNALISTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="TELJOURNALISTE" class="control-label">TELEPHONE DU JOURNALISTE</label>
							<input type="text" name="TELJOURNALISTE" id="TELJOURNALISTE" class="form-control"/>
						</div>
												
						<div class="form-group">
							<label for="IMAGEPHOTOJOURNALISTE" class="control-label">IMAGE PHOTO DU JOURNALISTE :</label>
							<input type="file" name="IMAGEPHOTOJOURNALISTE" id="IMAGEPHOTOJOURNALISTE"/>
						</div>						
						<button type="submit" class="btn btn-primary">AJOUTER - JOURNALISTE</button>
						<input type="button" class="btn btn-warning" onclick="history.back();" value="ANNULER AJOUT">
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



