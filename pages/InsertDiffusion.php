<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$ant=$_POST['IDANTENNE'];
	$prog=$_POST['IDPROGRAMME'];
	$jourd=$_POST['CODEJOUR'];
	$dated=$_POST['DATEDIFFUSION'];
	$debutd=$_POST['HEUREEBUTDIFFUSION'];
	$find=$_POST['HEUREFINDIFFUSION'];
	$lieny=$_POST['LIENDIFFUSION'];
	
	
	$requete="insert into DIFFUSION(IDANTENNE,IDPROGRAMME,CODEJOUR,DATEDIFFUSION,HEUREEBUTDIFFUSION,HEUREFINDIFFUSION,LIENDIFFUSION) values(?,?,?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($ant,$prog,$jourd,$dated,$debutd,$find,$lieny);			
	$resultat->execute($param);	
		
	header("location:Diffusion.php");
	
?>