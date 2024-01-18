<?php
	require_once('session.php');

?>

<?php
	require_once('connexion.php');
	
	$idprogramme=$_POST['idprogramme'];
	$libellegenreprogramme=$_POST['LIBELLEGENREPROGRAMME'];
	$libelletypeprogramme=$_POST['LIBELLETYPEPROGRAMME'];
	$nomprogramme=$_POST['NOMPROGRAMME'];
	$dureeprogramme=$_POST['DUREEPROGRAMME'];
	$nomjournaliste=$_POST['NOMJOURNALISTE'];
	$codelanguediffusionp=$_POST['CODELANGUEDIFFUSIONP'];
	
	require_once('connexion.php');
	$resultat = $con->query("SELECT P.IDPROGRAMME,GP.LIBELLEGENREPROGRAMME,GP.CODEGENREPROGRAMME,TP.LIBELLETYPEPROGRAMME,TP.CODETYPEPROGRAMME,P.NOMPROGRAMME,P.IMAGEPROGRAMME, P.DUREEPROGRAMME,J.NOMJOURNALISTE,J.MATRICULEJOURNALISTE,LP.CODELANGUEDIFFUSIONP
								FROM GENREPROGRAMME GP,TYPEPROGRAMME TP,PROGRAMME P,JOURNALISTE J,LANGUEDIFFUSIONP LP  
								WHERE GP.CODEGENREPROGRAMME=P.CODEGENREPROGRAMME
								AND   LP.CODELANGUEDIFFUSIONP = P.CODELANGUEDIFFUSIONP
								AND   TP.CODETYPEPROGRAMME = P.CODETYPEPROGRAMME
								AND   J.MATRICULEJOURNALISTE = P.MATRICULEJOURNALISTE
								AND P.IDPROGRAMME='$idprogramme'
								");
	$programme=$resultat->fetch();
	
	$codep = $programme['CODEGENREPROGRAMME'];
	$codetp = $programme['CODETYPEPROGRAMME'];
	$matriculejour = $programme['MATRICULEJOURNALISTE'];

	
	$requete="UPDATE PROGRAMME SET NOMPROGRAMME='$nomprogramme' where IDPROGRAMME='$idprogramme'";
	$requete2="UPDATE PROGRAMME SET DUREEPROGRAMME='$dureeprogramme' where IDPROGRAMME='$idprogramme'";
	$requete3="UPDATE JOURNALISTE SET NOMJOURNALISTE='$nomjournaliste' where MATRICULEJOURNALISTE='$matriculejour'";
	$requete4="UPDATE TYPEPROGRAMME SET LIBELLETYPEPROGRAMME='$libelletypeprogramme' where CODETYPEPROGRAMME='$codetp'";
	$requete5="UPDATE GENREPROGRAMME SET LIBELLEGENREPROGRAMME='$libellegenreprogramme' where CODEGENREPROGRAMME='$codep'";
	
	$resultat1 = $con->query($requete);
	$resultat2 = $con->query($requete2);
	$resultat3 = $con->query($requete3);
	$resultat4 = $con->query($requete4);
	$resultat5 = $con->query($requete5);
	
	
	header("location:ListeProgramme.php");

?>