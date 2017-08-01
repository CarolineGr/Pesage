<?php
    session_start();
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";
    
    $pdo = gestionnaireDeConnexion();
    
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    
    // traitement de la déconnexion dans la bdd
    try{
        $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        $req = $pdo->prepare("UPDATE pesage.utilisateurs SET Connexion = 'Hors Ligne' WHERE CodeUtilisateur = '" .$codeU_Session. "';");
        $req->execute();
        
        ?><script language="javascript">
                alert("Session close");
                window.location.href='authentification.php';
            </script><?php 
    }
    catch (Exception $e) {
        echo $req . "<br>" . $e1->getMessage();
    }
    $conn = null;


    
    

