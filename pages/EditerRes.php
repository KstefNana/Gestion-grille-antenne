<?php
	require_once('session.php');
	if(isset($_SESSION['erreurEmailExiste'])){
		$erreurEmailExiste=$_SESSION['erreurEmailExiste'];
		$_SESSION['erreurEmailExiste']="";
	}else{
		$erreurEmailExiste="";
		
	}
?>

<?php
	
	$matricule=$_GET['MATRICULEJOURNALISTE'];
	require_once('connexion.php');
	$requete="select * from journaliste where MATRICULEJOURNALISTE='$matricule'";
	$resultat = $con->query($requete);
	$journaliste = $resultat->fetch();
?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Editer un JOURNALISTE</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="AFRIQUEM.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Editer un JOURNALISTE</div>
				<div class="panel-body">
					<form method="post" action="UpdateRes.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="id" class="control-label" >
								MATRICULE DU JOURNALISTE = <?php echo $journaliste['MATRICULEJOURNALISTE']; ?>
							</label>
							<input type="hidden" name="MATRICULEJOURNALISTE" 
									id="MATRICULEJOURNALISTE" class="form-control" 
									value="<?php echo $journaliste['MATRICULEJOURNALISTE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="NOMJOURNALISTE" class="control-label">NOM DU JOURNALISTE : </label>
							<input type="text" name="NOMJOURNALISTE" id="NOMJOURNALISTE" class="form-control"
									value="<?php echo $journaliste['NOMJOURNALISTE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="PRENOMJOURNALISTE" class="control-label">PRENOM DU JOURNALISTE</label>
							<input type="text" name="PRENOMJOURNALISTE" id="PRENOMJOURNALISTE" 
							class="form-control"
							value="<?php echo $journaliste['PRENOMJOURNALISTE'] ?>"/>
						</div>
						
						<div class="form-group">
							<label for="TELJOURNALISTE" class="control-label">TELEPHONE DU JOURNALISTE</label>
							<input type="text" name="TELJOURNALISTE" id="TELJOURNALISTE" 
							class="form-control"
							value="<?php echo $journaliste['TELJOURNALISTE'] ?>"/>
						</div>

						<div class="form-group">
							<label for="IMAGEPHOTOJOURNALISTE" class="control-label">IMAGE PHOTO DU JOURNALISTE :</label>
							<input type="file" name="IMAGEPHOTOJOURNALISTE" id="IMAGEPHOTOJOURNALISTE"/>
						</div>
							
						<button type="submit" class="btn btn-primary">VALIDER MODIFICATION</button>
						<input type="button" class="btn btn-warning" onclick="history.back();" value="ANNULER MODIFICATION">
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



