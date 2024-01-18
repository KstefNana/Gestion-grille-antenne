<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Chaine</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="CRTV4.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Chaine Tv</div>
				<div class="panel-body">
					<form method="post" action="InsertChaine.php" class="form" enctype="multipart/form-data">											
						
						<div class="form-group">
							<label for="NOMCHAINE" class="control-label">NOM DE LA CHAINE TV</label>
							<input type="text" name="NOMCHAINE" id="NOMCHAINE" class="form-control"/>
						</div>
											
						<button type="submit" class="btn btn-primary">LA NOUVELLE CHAINE TV</button>
						<input type="button" class="btn btn-warning" onclick="history.back();" value="ANNULER ENREGISTREMENT">
							
					</form>
				</div>
			</div>
										
		</div>
	</body>
</html>