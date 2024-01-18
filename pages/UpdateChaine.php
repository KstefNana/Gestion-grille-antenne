<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_POST['IDCHAINE'];
	$nom=$_POST['NOMCHAINE'];
	
	$requete="UPDATE CHAINE SET NOMCHAINE='$nom' where idchaine=$id";
	$resultat = $con->query($requete);
	
		
		//$requete="UPDATE CHAINE SET NOMCHAINE=? where id=?";
				
		//$param=array($nom,$id);
			
	//$resultat = $con->prepare($requete);	
	//$resultat->execute($param);	
	
	header("location:chaine.php");

?>