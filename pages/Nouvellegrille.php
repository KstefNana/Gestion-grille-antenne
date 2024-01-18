<?php
	require_once('session.php');
	
	require_once('connexion.php');
	$requetef="select * from CHAINE";
	$resultatf = $con->query($requetef);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Grille</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Grille Tv</div>
				<div class="panel-body">
					<form method="post" action="Insertgrille.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="IDCHAINE" class="control-label">LA CHAINE ASSOCIEE : </label>
							<select name="IDCHAINE" id="IDCHAINE" class="form-control">
								<?php while($filiere=$resultatf->fetch()){ ?>
									<option value="<?php echo $filiere['IDCHAINE']?>">
										<?php echo $filiere['NOMCHAINE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="NOMGRILLE" class="control-label">NOM DE LA GRILLE TV</label>
							<input type="text" name="NOMGRILLE" id="NOMGRILLE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATELANCEMENTGRILLE" class="control-label">DATE LANCEMENT DE LA GRILLE</label>
							<input type="date" name="DATELANCEMENTGRILLE" id="DATELANCEMENTGRILLE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATEFINGRILLE" class="control-label">DATE FIN DE LA GRILLE</label>
							<input type="date" name="DATEFINGRILLE" id="DATEFINGRILLE" class="form-control"/>
						</div>
											
						<button type="submit" class="btn btn-primary">LA NOUVELLE GRILLE TV</button>
						<input type="button" class="btn btn-warning" onclick="history.back();" value="ANNULER INSERTION">
							
					</form>
				</div>
			</div>
										
		</div>
	</body>
</html>