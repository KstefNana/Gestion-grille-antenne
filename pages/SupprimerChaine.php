<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['IDCHAINE'];

	$requete="DELETE FROM CHAINE where IDCHAINE=?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:chaine.php");
	
?>