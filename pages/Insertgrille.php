<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$IDG=$_POST['IDGRILLE'];
	$IDC=$_POST['IDCHAINE'];
	$NOMG=$_POST['NOMGRILLE'];
	$DATEL=$_POST['DATELANCEMENTGRILLE'];
	$DATEF=$_POST['DATEFINGRILLE'];
	
	
	
	$requete="insert into GRILLE(IDGRILLE,IDCHAINE,NOMGRILLE,DATELANCEMENTGRILLE,DATEFINGRILLE) values(?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($IDG,$IDC,$NOMG,$DATEL,$DATEF);			
	$resultat->execute($param);	
		
	header("location:grille.php");
	
?>