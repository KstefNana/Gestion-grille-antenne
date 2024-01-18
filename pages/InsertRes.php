<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$MAT=$_POST['MATRICULEJOURNALISTE'];
	$NOM=$_POST['NOMJOURNALISTE'];
	$PRENOM=$_POST['PRENOMJOURNALISTE'];
	$TEL=$_POST['TELJOURNALISTE'];
	
	$nomPhoto= $_FILES['IMAGEPHOTOJOURNALISTE']['name'];	
	$imageTmp=$_FILES['IMAGEPHOTOJOURNALISTE']['tmp_name'];
	move_uploaded_file($imageTmp,'../images/'.$nomPhoto);
	
	$requete="insert into JOURNALISTE(MATRICULEJOURNALISTE,NOMJOURNALISTE,PRENOMJOURNALISTE,IMAGEPHOTOJOURNALISTE,TELJOURNALISTE) values(?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($MAT,$NOM,$PRENOM,$nomPhoto,$TEL);			
	$resultat->execute($param);	
		
	header("location:Ressources.php");
	
?>