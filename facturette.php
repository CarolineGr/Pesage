<?php session_start();
require('fpdf181\fpdf.php');
include_once 'gestionBase.php';
$pdo = gestionnaireDeConnexion();

if(isset($_GET["idS"]) && isset($_GET["idP"])){
    $idPesee = $_GET["idP"];
    $codeU_Session = $_GET["idS"];
}else{
    echo 'Erreur';
}

// requete bdd historiquepesees
$req = $pdo->query('SELECT * FROM historiquepesees WHERE id_pesees="' .$idPesee.'";');        
$bdd = $req->fetch();

$codeClient = $bdd["CodeClient"];
$dateE = $bdd["DateEntree"];
$dateS = $bdd["DateSortie"];
$poidsE = $bdd["PoidsEntree"];
$poidsS = $bdd["PoidsSortie"];
$immat = $bdd["Immatriculation"];
$codeMat = $bdd["CodeMatiere"];
$prix = $bdd["Prix"];
$req->closeCursor();

// requete bdd site
$req = $pdo->query('SELECT * FROM sessions WHERE adresseIP="' .$_SESSION["adresseIP"]. '";');        
$bddSessions = $req->fetch();

$idSite = $bddSessions["id_site"];
$req->closeCursor();

$req1 = $pdo->query('SELECT * FROM site WHERE id_site="' .$idSite.'";');        
$bddSite = $req1->fetch();

$raiSocS = $bddSite["RaisonSociale"];
$adr1 = $bddSite["Adresse1"];
$adr2 = $bddSite["Adresse2"];
$adr3 = $bddSite["Adresse3"];
$cpS = $bddSite["CodePostal"];
$villeS = $bddSite["Ville"];
$telS = $bddSite["Telephone"];
$idSociete = $bddSite["id_societe"];
$req->closeCursor();

// requete bdd societe
$req = $pdo->query('SELECT * FROM societe WHERE id_societe="' .$idSociete. '";');        
$bddSociete = $req->fetch();

$raiSocSociete = $bddSociete["RaisonSociale"];
$req->closeCursor();


// requete bdd client
$req = $pdo->query('SELECT * FROM clients WHERE CodeClient="' .$codeClient.'";');        
$bdd = $req->fetch();

$raiSocC = $bdd["RaisonSociale"];
$cpC = $bdd["CodePostal"];
$villeC = $bdd["Ville"];
$telC = $bdd["Telephone"];
$req->closeCursor();

// requete bdd immatriculations
$req = $pdo->query('SELECT * FROM immatriculations WHERE Immatriculation="' .$immat.'";');        
$bdd = $req->fetch();

$idTransp = $bdd["id_transporteur"];
$req->closeCursor();

// requete bdd transporteurs
$req = $pdo->query('SELECT * FROM transporteurs WHERE id_Transporteur="' .$idTransp.'";');        
$bdd = $req->fetch();

$raiSocT = $bdd["RaisonSociale"];
$req->closeCursor();

// requete bdd matières
$req = $pdo->query('SELECT * FROM matieres WHERE CodeMatiere="' .$codeMat.'";');        
$bdd = $req->fetch();

$matiere = $bdd["Matiere"];
$req->closeCursor();


// agencement de la facture en pdf
$date = date("d/m/Y");

$pdf = new FPDF('P', 'mm','A5');
$pdf->AddPage();
$pdf->SetTitle("Facture", true);

// en-tête société
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10, "** ".$raiSocSociete. " **",0,1,"C");
$pdf->Ln(10);

//date d'impression du ticket
$pdf->SetFont('Arial','',9);
$pdf->Cell(100);
$pdf->Cell(40,10, "Le " .$date, 0,0,"L");
$pdf->Ln(15);

// informations du Site
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,5, $raiSocS,"",1,"L");
$pdf->SetFont('Arial','',11);
$pdf->Cell(40,5, $adr1, "",1,"");
if($adr2!= ""){$pdf->Cell(40,5, $adr2, "",1,"");}
if($adr3!= ""){$pdf->Cell(40,5, $adr3, "",1,"");}
$pdf->Cell(15,5, $cpS, "",0,"");
$pdf->Cell(25,5, $villeS, "",1,"");
$pdf->Cell(40,5, $telS, "",1,"");
$pdf->Ln(15);

// information de la pesée
$pdf->SetFont('Arial','',9);
$pesee = utf8_decode("N° de la pesée    : " .$idPesee);
$pdf->Cell(20,10,$pesee,0,1,"");

    // transporteur
$transporteur = utf8_decode("Transporteur       : " .$raiSocT);
$pdf->Cell(20,10,$transporteur,0,1,"");
    
    // véhicule
$immatriculation = utf8_decode("Véhicule              : " .$immat);
$pdf->Cell(20,10,$immatriculation,0,1,"");
    
    // raison sociale et ville du client
$client = utf8_decode("Client                   : " .$raiSocC);
$pdf->Cell(20,10,$client,0,0,"");
$pdf->Cell(60);
$villeC = utf8_decode("Ville         : " .$villeC);
$pdf->Cell(20,10,$villeC,0,1,"");
    
    // matière
$matiere = utf8_decode("Matière                : " .$matiere);
$pdf->Cell(20,10,$matiere,0,1,"");
    
    //date et poids d'entrée
$dateE = utf8_decode("Entrée le              : " .modulerDateHeureBDD($dateE));
$pdf->Cell(20,10,$dateE,0,0,"");
$pdf->Cell(60);
$poidsEntree = utf8_decode("Poids d'entrée      : " .$poidsE. " Kg");
$pdf->Cell(20,10,$poidsEntree,0,1,"");

    //date et poids de sortie
$dateS = modulerDateHeureBDD($dateS);
$pdf->Cell(20,10,"Sortie le               : " .$dateS,0,0,"");
$pdf->Cell(60);
$pdf->Cell(20,10,"Poids de sortie     : " .$poidsS. " Kg",0,1,"");

    //poids net
$poidsN = ($poidsE-$poidsS);
$pdf->Cell(20,15,"Poids Net             : " .$poidsN. " Kg",0,1,"");

    //prix
$pdf->Cell(20,15,"Prix                      : " .$prix. " Euros",0,1,"");

$pdf->Output();