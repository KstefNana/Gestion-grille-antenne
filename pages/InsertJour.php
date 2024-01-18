<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	
	$CODEJ=$_POST['CODEJOUR'];
	$LIBJ=$_POST['LIBELLEJOUR'];

	
	$requete="insert into JOUR(CODEJOUR,LIBELLEJOUR) values(?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($CODEJ,$LIBJ);			
	$resultat->execute($param);	
		
	header("location:Diffusion.php");
	
?>