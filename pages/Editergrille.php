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
	
	$id=$_GET['IDGRILLE'];
	require_once('connexion.php');
	
	$requete="select * from grille where idgrille='$id'";
	$resultat = $con->query($requete);
	$grille=$resultat->fetch();

?>


<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Editer une grille</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Editer une grille</div>
				<div class="panel-body">
					<form method="post" action="updategrille.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="idgrille" class="control-label" >
								Idgrille=<?php echo $grille['IDGRILLE']; ?>
							</label>
							<input type="hidden" name="IDGRILLE" 
									id="idgrille" class="form-control" 
									value="<?php echo $grille['IDGRILLE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="idchaine" class="control-label" >
								Idchaine=<?php echo $grille['IDCHAINE']; ?>
							</label>
							<input type="hidden" name="IDCHAINE" 
									id="idchaine" class="form-control" 
									value="<?php echo $grille['IDCHAINE']; ?>"/>
						</div>
						
						
						<div class="form-group">
							<label for="NOMGRILLE" class="control-label">NOM GRILLE</label>
							<input type="text" name="NOMGRILLE" id="NOMGRILLE" class="form-control"
									value="<?php echo $grille['NOMGRILLE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="DATELANCEMENTGRILLE" class="control-label">DATELANCEMENTGRILLE</label>
							<input type="text" name="DATELANCEMENTGRILLE" id="DATELANCEMENTGRILLE" 
							class="form-control"
							value="<?php echo $grille['DATELANCEMENTGRILLE'] ?>"/>
						</div>
						
						<div class="form-group">
							<label for="DATEFINGRILLE" class="control-label">DATEFINGRILLE</label>
							<input type="text" name="DATEFINGRILLE" id="DATEFINGRILLE" 
							class="form-control"
							value="<?php echo $grille['DATEFINGRILLE'] ?>"/>
						</div>
						
						
							
						<button type="submit" class="btn btn-primary">Enregistrer</button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



