<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$matricule=$_GET['MATRICULEJOURNALISTE'];

	$requete="DELETE FROM JOURNALISTE where MATRICULEJOURNALISTE=?";			
	$param=array($matricule);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:Ressources.php");
	
?>