<?php session_start();
require('fpdf181\fpdf.php');
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();

    if(isset($_GET["idS"])){        
        $codeU_Session = $_GET["idS"];        
    }else{
        echo "Erreur";
    }
    
    //calcul du poids facturé
    $poidsFacture = $_SESSION["poidsT1"];
    
    if(!empty($_SESSION["poidsT2"])){
        $poidsFacture += $_SESSION["poidsT2"];
    }
    
    if(!empty($_SESSION["poidsT3"])){
        $poidsFacture += $_SESSION["poidsT3"];
    }
    
    //calcul du prix facturé
    $prixFacture = $_SESSION["prixT1"];
    
    if(!empty($_SESSION["poidsT2"])){
        $prixFacture += $_SESSION["prixT2"];
    }
    
    if(!empty($_SESSION["prixT3"])){
        $prixFacture += $_SESSION["prixT3"];
    }

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
    $req = $pdo->query('SELECT * FROM clients WHERE RaisonSociale="' .$_SESSION['client'].'";');        
    $bdd = $req->fetch();

    $villeC = $bdd["Ville"];
    $req->closeCursor();

//    // requete bdd immatriculations
//    $req = $pdo->query('SELECT * FROM immatriculations WHERE Immatriculation="' .$immat.'";');        
//    $bdd = $req->fetch();
//
//    $idTransp = $bdd["id_transporteur"];
//    $req->closeCursor();

//    // requete bdd transporteurs
//    $req = $pdo->query('SELECT * FROM transporteurs WHERE id_Transporteur="' .$idTransp.'";');        
//    $bdd = $req->fetch();
//
//    $raiSocT = $bdd["RaisonSociale"];
//    $req->closeCursor();

    // requete bdd matières
        // requete matière 1
    $req = $pdo->query('SELECT * FROM matieres WHERE CodeMatiere="' .$_SESSION['codeMat1'] .'";');        
    $bdd = $req->fetch();
        
    $matiere1 = $bdd["Matiere"];
    $req->closeCursor();
        // requete matière 2
    $req = $pdo->query('SELECT * FROM matieres WHERE CodeMatiere="' .$_SESSION['codeMat2'] .'";');        
    $bdd = $req->fetch();

    $matiere2 = $bdd["Matiere"];
    $req->closeCursor();
        // requete matière 3
    $req = $pdo->query('SELECT * FROM matieres WHERE CodeMatiere="' .$_SESSION['codeMat3'] .'";');        
    $bdd = $req->fetch();

    $matiere3 = $bdd["Matiere"];
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
    $pdf->Ln(13);

        // période de la facture
    $pdf->SetFont('Arial','B',11);
    $dateD = modulerDateHeureBDD($_SESSION["dateTimeD"]);
    $dateF = modulerDateHeureBDD($_SESSION["dateTimeF"]);
    $periode = utf8_decode('** Période du ' .$dateD. ' au ' .$dateF. " **");
    $pdf->Cell(130,10,$periode,0,1,"C");
    $pdf->Ln(8);
    
        // raison sociale et ville du client
    $pdf->Cell(10);
    $pdf->SetFont('Arial','U',9);
    $client = utf8_decode("Client : " .$_SESSION["client"]);
    $pdf->Cell(20,10,$client,0,0,"");
    $pdf->Cell(40);
    $villeC = utf8_decode("Ville : " .$villeC);
    $pdf->Cell(20,10,$villeC,0,1,"");
    $pdf->Ln(10);
    
        // tableau matière, poids, prix
    //haut tableau
    $pdf->SetFont("Times","B");
    $pdf->SetFillColor(200,200,200);
    $pdf->Cell(13);
    $pdf->Cell(40,10,"","L,T",0,"",true);
    $pdf->SetFillColor(235,235,250);
    $pdf->Cell(30,10,"Poids en Kg","R,T,L,B",0,"C",true);
    $pdf->Cell(30,10,"Prix en Euros","R,T,B",1,"C",true);
    
    //1ère ligne
    $pdf->Cell(13);
    $matiere1 = utf8_decode($matiere1);
    $pdf->Cell(40,10,$matiere1,"L,R,T,B",0,"C",true);
    $pdf->SetFont('Times','',9);    
    $pdf->Cell(30,10,$_SESSION["poidsT1"],"R,B",0,"C");
    $pdf->Cell(30,10,$_SESSION["prixT1"],"R,B",1,"C");    
    
    //2ème ligne
    if(!empty($_SESSION["poidsT2"]) && !empty($_SESSION["prixT2"])){
        $pdf->Cell(13);
        $pdf->SetFont("Times","B");
        $matiere2 = utf8_decode($matiere2);    
        $pdf->Cell(40,10,$matiere2,"L,R,B",0,"C",true);
        $pdf->SetFont('Times','',9);
        $pdf->Cell(30,10,$_SESSION["poidsT2"],"R,B",0,"C"); 
        $pdf->Cell(30,10,$_SESSION["prixT2"],"R,B",1,"C");    
    }
    //3ème ligne
    if(!empty($_SESSION["poidsT3"]) && !empty($_SESSION["prixT3"])){
        $pdf->Cell(13);
        $pdf->SetFont("Times","B");
        $pdf->SetFillColor(235,235,250);
        $matiere3 = utf8_decode($matiere3);
        $pdf->Cell(40,10,$matiere3,"L,R,B",0,"C",true);
        $pdf->SetFont('Times','',9);
        $pdf->Cell(30,10,$_SESSION["poidsT3"],"R,B",0,"C");
        $pdf->Cell(30,10,$_SESSION["prixT3"],"R,B",1,"C");
    }
    
    //4ème ligne
    $pdf->Cell(13);
    $pdf->SetFont("Times","B");
    $pdf->SetFillColor(222,201,250);
    $pdf->Cell(40,10,"TOTAL","L,R,B",0,"C",true);
    $pdf->Cell(30,10,$poidsFacture,"R,B",0,"C",true);
    $pdf->Cell(30,10,$prixFacture,"R,B",1,"C",true);

 

    //prix net à payer
    $pdf->SetFont("Times","B",12);
    $pdf->Ln(8);
    $pdf->Cell(13);
    $total = utf8_decode("Montant à régler : " .$prixFacture. " Euros");
    $pdf->Cell(20,15,$total,0,1,"");

    $pdf->Output();