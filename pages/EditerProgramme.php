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

$idprogramme=$_GET['IDPROGRAMME'];
require_once('connexion.php');
$resultat = $con->query("SELECT P.IDPROGRAMME,GP.LIBELLEGENREPROGRAMME,TP.LIBELLETYPEPROGRAMME,P.NOMPROGRAMME,P.IMAGEPROGRAMME, P.DUREEPROGRAMME,J.NOMJOURNALISTE,LP.CODELANGUEDIFFUSIONP
								FROM GENREPROGRAMME GP,TYPEPROGRAMME TP,PROGRAMME P,JOURNALISTE J,LANGUEDIFFUSIONP LP  
								WHERE GP.CODEGENREPROGRAMME=P.CODEGENREPROGRAMME
								AND   LP.CODELANGUEDIFFUSIONP = P.CODELANGUEDIFFUSIONP
								AND   TP.CODETYPEPROGRAMME = P.CODETYPEPROGRAMME
								AND   J.MATRICULEJOURNALISTE = P.MATRICULEJOURNALISTE
								AND P.IDPROGRAMME='$idprogramme'
								");
	$programme=$resultat->fetch()

	
?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Editer un programme</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Editer un programme</div>
				<div class="panel-body">
					<form method="post" action="Updateprogramme.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="LIBELLEGENREPROGRAMME" class="control-label" >
								GENRE
							</label>
							<input type="text" name="LIBELLEGENREPROGRAMME" 
									id="LIBELLEGENREPROGRAMME" class="form-control" 
									value="<?php echo $programme['LIBELLEGENREPROGRAMME']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="LIBELLETYPEPROGRAMME" class="control-label" >
								TYPE
							</label>
							<input type="text" name="LIBELLETYPEPROGRAMME" 
									id="LIBELLETYPEPROGRAMME" class="form-control" 
									value="<?php echo $programme['LIBELLETYPEPROGRAMME']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="NOMPROGRAMME" class="control-label">NOM PROGRAMME</label>
							<input type="text" name="NOMPROGRAMME" id="NOMPROGRAMME" class="form-control"
									value="<?php echo $programme['NOMPROGRAMME']; ?>"/>
						</div>
						<div class="form-group">
							<label for="DUREEPROGRAMME" class="control-label">DUREE PROGRAMME</label>
							<input type="text" name="DUREEPROGRAMME" id="DUREEPROGRAMME" class="form-control"
									value="<?php echo $programme['DUREEPROGRAMME'];?>"/>
						</div>
						
						<div class="form-group">
							<label for="NOMJOURNALISTE" class="control-label">NOM JOURNALISTE</label>
							<input type="text" name="NOMJOURNALISTE" id="NOMJOURNALISTE" class="form-control"
									value="<?php echo $programme['NOMJOURNALISTE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="CODELANGUEDIFFUSIONP" class="control-label">CODE LANGUEDIFFUSION P</label>
							<input type="text" name="CODELANGUEDIFFUSIONP" id="CODELANGUEDIFFUSIONP" class="form-control"
									value="<?php echo $programme['CODELANGUEDIFFUSIONP']; ?>"/>
						</div>
						<div class="form-group">
							<input type="hidden" name="idprogramme" id="idprogramme" class="form-control"
									value="<?php echo $idprogramme; ?>"/>
						</div>
						
							
						<button type="submit" class="btn btn-primary">Enregistrer</button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



