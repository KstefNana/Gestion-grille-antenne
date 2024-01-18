<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$grille=$_POST['IDGRILLE'];
	$langue=$_POST['CODELANGUEDIFFUSIONP'];
	$type=$_POST['CODETYPEPROGRAMME'];
	$equipe=$_POST['IDEQUIPEPRODUCTION'];
	$genre=$_POST['CODEGENREPROGRAMME'];
	$journaliste=$_POST['MATRICULEJOURNALISTE'];
	$program=$_POST['NOMPROGRAMME'];
	$duree=$_POST['DUREEPROGRAMME'];
		
	$nomPhoto= $_FILES['IMAGEPROGRAMME']['name'];	
	$imageTmp=$_FILES['IMAGEPROGRAMME']['tmp_name'];
	move_uploaded_file($imageTmp,'../images/'.$nomPhoto);
	
	$requete="insert into PROGRAMME(IDGRILLE,CODELANGUEDIFFUSIONP,CODETYPEPROGRAMME,IDEQUIPEPRODUCTION,CODEGENREPROGRAMME,MATRICULEJOURNALISTE,NOMPROGRAMME,IMAGEPROGRAMME,DUREEPROGRAMME) values(?,?,?,?,?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($grille,$langue,$type,$equipe,$genre,$journaliste,$program,$nomPhoto,$duree);			
	$resultat->execute($param);	
		
	header("location:ListeProgramme.php");
	
?>