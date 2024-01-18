<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$idprogramme=$_GET['IDPROGRAMME'];

	$requete="DELETE FROM PROGRAMME where IDPROGRAMME=?";			
	$param=array($idprogramme);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListeProgramme.php");
	
?>