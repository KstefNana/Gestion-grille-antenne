<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$idgrille=$_POST['IDGRILLE'];
	$idchaine=$_POST['IDCHAINE'];
	$nomgrille=$_POST['NOMGRILLE'];
	$datelancementgrille=$_POST['DATELANCEMENTGRILLE'];
	$datefingrille=$_POST['DATEFINGRILLE'];	
	

	$requete="UPDATE GRILLE SET NOMGRILLE='$nomgrille', DATELANCEMENTGRILLE='$datelancementgrille', DATEFINGRILLE='$datefingrille' where idgrille='$idgrille'";
	$resultat = $con->query($requete);
	
	
	header("location:grille.php");

?>