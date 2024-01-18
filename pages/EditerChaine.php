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
	
	$chaineid=$_GET['IDCHAINE'];
	require_once('connexion.php');
	$requete="select * from chaine where IDCHAINE='$chaineid'";
	$resultat = $con->query($requete);
	$chaine = $resultat->fetch();
?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Editer une chaine</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Editer une chaine</div>
				<div class="panel-body">
					<form method="post" action="UpdateChaine.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="IDCHAINE" class="control-label" >
								Id=<?php echo $chaine['IDCHAINE']; ?>
							</label>
							<input type="hidden" name="IDCHAINE" 
									id="IDCHAINE" class="form-control" 
									value="<?php echo $chaine['IDCHAINE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="NOMCHAINE" class="control-label">NOM CHAINE</label>
							<input type="text" name="NOMCHAINE" id="NOMCHAINE" class="form-control"
									value="<?php echo $chaine['NOMCHAINE']; ?>"/>
						</div>
						
							
						<button type="submit" class="btn btn-primary">Enregistrer</button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



