<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	
	$NOMC=$_POST['NOMCHAINE'];
	
	
	
	
	$requete="insert into CHAINE(NOMCHAINE) values(?)";	
	$resultat = $con->prepare($requete);			
	$param=array($NOMC);			
	$resultat->execute($param);	
		
	header("location:Chaine.php");
	
?>