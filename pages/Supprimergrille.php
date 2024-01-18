<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['IDGRILLE'];

	$requete="DELETE FROM GRILLE where IDGRILLE=?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:grille.php");
	
?>