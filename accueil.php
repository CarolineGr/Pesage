<?php 
    session_start();    
    include_once 'gestionBase.php'; 
    $pdo = gestionnaireDeConnexion();
   
    // récupération du code utilisateur de la session en cours
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    
    // Enregistrement de la dernière connexion ds une variable
    if($_SESSION["dernConn"] != "0000-00-00 00:00:00"){
        $dernConn = modulerDateHeureBDD($_SESSION["dernConn"]);
    }
    
    // Enregistrement de la date/heure de connexion dans la bdd
    $date = date('Y-m-d');   
    $heure = date("H:i:s");
    $dateConn = $date. ' ' .$heure;
    
    try{
        $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
        $req = $pdo->prepare("UPDATE pesage.sessions SET DerniereConnexion ='" .$dateConn. "' WHERE adresseIP = '" .$_SESSION["adresseIP"]. "'");
        $req->execute();               
    }    
    catch(PDOException $e){
        echo $req . "<br>" . $e->getMessage();
    }      
    $conn = null;
    // END
    
    // récupération des données dans des variables
    $ipSession = $_SESSION["adresseIP"];
    $codeSite = $_SESSION["codeSite"];
    $raisonSociale = $_SESSION["raisonSociale"];
    $adresse1 = $_SESSION["adresse1"];
    $adresse2 = $_SESSION["adresse2"];
    $adresse3 = $_SESSION["adresse3"];
    $cp = $_SESSION["cp"];
    $ville = $_SESSION["ville"];
    $pays = $_SESSION["pays"];
    $tel = $_SESSION["tel"];
    $mail = $_SESSION["mail"];
    $contact = $_SESSION["contact"];
    
    // requète BDD
    $req = $pdo->query('SELECT * FROM utilisateurs WHERE codeUtilisateur="'.$codeU_Session .'"');
    $bdd = $req->fetch();

    $codeUtilisateur = $bdd["codeUtilisateur"];
    $nom = $bdd["Nom"];
    $prenom = $bdd["Prenom"];
    $admin = $bdd["Administrateur"];
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil - Pesage</title>        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <!-- menu de navigation -->
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <ul class="nav nav-tabs" >
                        
                        <!-- Menu site -->
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                Gestion sites <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu">
                                <?php 
                                //sous-menu 1 : mise en place d'un site
                                if($admin == "OUI"){
                                    ?><li><a href="installSite.php?idS=<?php echo $codeU_Session;?>">Installer un site</a></li><?php
                                }else{
                                    ?><li class="nonAdmin">Installer un site</li><?php
                                }
                                //sous-menu 2 : creation d'un nouveau site
                                if($admin == "OUI"){
                                    ?><li><a href="creationSite.php?idS=<?php echo $codeU_Session;?>">Créer un site</a></li><?php
                                }else{
                                    ?><li class="nonAdmin">Créer un site</li><?php
                                }
                                //sous-menu 3 : rechercher un site
                                if($admin == "OUI"){
                                    ?><li><a href="rechercheSites.php?idS=<?php echo $codeU_Session;?>">Rechercher un site</a></li><?php
                                }else{
                                    ?><li class="nonAdmin">Rechercher un site</li><?php
                                }
                                ?>
                            </ul>
                            
                        <!-- Menu client -->
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"role="button" aria-haspopup="true" aria-expanded="false">
                            Gestion clients <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu">
                            <?php 
                            //sous-menu 1 : création d'un nouveau client
                            if($admin == "OUI"){
                                ?><li><a href="creationClient.php?idS=<?php echo $codeU_Session;?>">Créer un client</a></li><?php
                            }else{
                                ?><li class="nonAdmin">Créer un client</li><?php
                            }
                            //sous-menu 2 : rechercher un client
                            if($admin == "OUI"){
                                ?><li><a href="rechercheClients.php?idS=<?php echo $codeU_Session;?>">Rechercher un client</a></li><?php
                            }else{
                                ?><li class="nonAdmin">Rechercher un client</li><?php
                            } 
                            ?>
                            <!-- sous-menu 3 : facturer un client -->
                            <li><a href="factureMensuelle.php?idS=<?php echo $codeU_Session;?>">Facturer un client</a></li>                            
                            </ul>
                            
                        <!-- Menu utilisateur -->
                        </li>
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                Gestion utilisateurs <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">  
                                <?php 
                                //sous-menu 1 : création d'un utilisateur
                                if($admin == "OUI"){
                                    ?><li><a href="creationUtilisateur.php?idS=<?php echo $codeU_Session ; ?>">Créer un compte utilisateur</a></li><?php
                                }else{
                                    ?><li class="nonAdmin">Créer un compte utilisateur</li><?php
                                }
                               //sous-menu 2 : rechercher un utilisateur
                                if($admin == "OUI"){
                                    ?><li><a href="rechercheUtilisateurs.php?idS=<?php echo $codeU_Session;?>">Gérer les utilisateurs</a></li><?php
                                }else{
                                    ?><li class="nonAdmin">Gérer les utilisateurs</li>                                 
                                    <?php
                                }
                                ?>                                
                            </ul>
                        </li>
                        
                        <!-- Menu transporteur -->
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"role="button" aria-haspopup="true" aria-expanded="false">
                            Gestion transporteurs <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu">
                            <?php 
                            //sous-menu 1 : création transporteur
                            if($admin == "OUI"){
                                ?><li><a href="creationTransporteur.php?idS=<?php echo $codeU_Session;?>">Créer un transporteur</a></li><?php
                            }else{
                                ?><li class="nonAdmin">Créer un transporteur</li><?php
                            }
                            //sous-menu 2 : création d'une nouvelle immatriculation
                            if($admin == "OUI"){
                                ?><li><a href="creationImmatriculation.php?idS=<?php echo $codeU_Session;?>">Créer une immatriculation</a></li><?php
                            }else{
                                ?><li class="nonAdmin">Créer une immatriculation</li><?php
                            }
                            //sous-menu 3 : rechercher un transporteur
                            if($admin == "OUI"){
                                ?><li><a href="rechercheTransporteurs.php?idS=<?php echo $codeU_Session;?>">Rechercher un transporteur</a></li><?php
                            }else{
                                ?><li class="nonAdmin">Rechercher un transporteur</li><?php
                            }
                            ?>
                            </ul>
                        </li>
                        <!-- Menu gestion des pesées -->                       
                        <li role="presentation"><a href="gestionPeseesEntrees.php?idS=<?php echo $codeU_Session;?>">Gestion des pesées</a></li>
                                                       
                        <!-- Menu déconnexion -->
                        <li role="presentation"><a href="deconnexion.traitement.php?idS=<?php echo $codeU_Session;?>">Déconnexion</a></li>
                    </ul> 
                </div>
                <div class="col-lg-2"></div>
            </div>
            
            <!-- message d'accueil -->
            <br>
            <div class="row">
                <div class="col-lg-5"></div>
                <div style="text-align: center" class="col-lg-2">
                    <?php echo "Bonjour " . $prenom;?>                    
                </div>                
            </div>
            
            <!-- affichage des informations concernant la connexion -->
            <br>
            <div class="row">
                <div class="col-lg-3"></div>
                <div style="text-align: center" class="col-lg-0 col-lg-offset-1 col-lg-4">
                    <?php echo "Votre dernière connexion : " . $dernConn  ;?>
                    <br>
                    <br>
                    <?php echo "Vous êtes connecté sur le site de " . $raisonSociale; ?>
                    <br>
                    <?php echo $adresse1 ?>
                    <br>
                    <?php echo $adresse2 ." " .$adresse3  ?>
                   
                    <?php echo $cp. " " .$ville;?>
                    <br>
                    <br>
                </div>                
            </div>
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
