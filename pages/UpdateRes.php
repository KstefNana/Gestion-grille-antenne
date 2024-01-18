<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$MAT=$_POST['MATRICULEJOURNALISTE'];
	$NOM=$_POST['NOMJOURNALISTE'];
	$PRENOM=$_POST['PRENOMJOURNALISTE'];
	$TEL=$_POST['TELJOURNALISTE'];

		//Récuperer le Nom de la photo envoyée
	$nomPhoto= $_FILES['IMAGEPHOTOJOURNALISTE']['name'];	
	
		//Récuperer le Nom du fichier image temporaire sur le serveur
	$imageTmp=$_FILES['IMAGEPHOTOJOURNALISTE']['tmp_name'];
	
		//Déplacer le fichier temporaire vers le dossier images de mon application
	move_uploaded_file($imageTmp,'../images/'.$nomPhoto);
			
	if(!empty($nomPhoto)){ // empty($nomPhoto):$nomPhoto est vide (Photo non envoyée)
						  // !empty($nomPhoto):$nomPhoto non vide (Photo envoyée)
		
		$requete="UPDATE JOURNALISTE SET NOMJOURNALISTE=?,PRENOMJOURNALISTE=?,IMAGEPHOTOJOURNALISTE=?,TELJOURNALISTE=? where MATRICULEJOURNALISTE=?";
		
		$param=array($NOM,$PRENOM,$nomPhoto,$TEL,$MAT);		
	}
	else{ // Photo non envoyée
		$requete="UPDATE JOURNALISTE SET NOMJOURNALISTE=?,PRENOMJOURNALISTE=?,TELJOURNALISTE=? where MATRICULEJOURNALISTE=?";
				
		$param=array($NOM,$PRENOM,$TEL,$MAT);
	}
			
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:Ressources.php");

?>