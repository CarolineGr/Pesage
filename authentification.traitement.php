<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Identification - Pesage</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    
    <body>
        <div class="container">
            <br>
            <br>            
            
            <div class="row">
                <div class="col-lg-offset-4 col-lg-4">              
                    <form class="form-horizontal" method="post" action="authentification.traitement.php" >
                        <fieldset>
                            <legend>Entrez vos identifiants</legend>
                            <br>
                            
                            <div class="row">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <!-- saisie du code utilisateur -->
                                    <div class="form-group">
                                        <label for="codeU">Code utilisateur</label>
                                        <input class="form-control" style="text-transform: uppercase" type="text" name="codeU_Session" id="codeU" maxlength="10" pattern="^[0-9a-zA-Z\s]{2,10}$" autocomplete="off" required="">
                                    </div>

                                    <!-- saisie du mot de passe -->
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input class="form-control" type="password" name="password" id="password" maxlength="70" autocomplete="off" pattern="^[-,'°çéèù0-9a-zA-Z\s]{3,45}$">
                                    </div>                    

                                    <button type="submit" class="btn btn-primary">Valider</button>

                                    <div class="form-group">
                                    </div>
                                </div>    
                            </div>        
                        </fieldset>
                    </form>
                </div>    
            </div>          
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
    session_start();
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";

    $pdo = gestionnaireDeConnexion();
        
    $codeU_Session = $_POST["codeU_Session"];
    $codeU_Session = mb_strtoupper($codeU_Session);
        
    // récupération de l'adresse ip de l'utilisateur
    $ipUtilisateur = get_ip();
    
    // connexion pour vérifier si l'IP est dans la bdd
    $req = $pdo->query("SELECT adresseIP FROM sessions");
    $req->execute();
    while ($bdd = $req->fetch()){
        if($bdd["adresseIP"] == $ipUtilisateur){
            $_SESSION["adresseIP"] = $bdd["adresseIP"]; // enregistrement dans une variable session pour accéder à l'information sur une autre page
            $ipSession = $_SESSION["adresseIP"];
            break;
        }
    }    
    // END - vérif IP
    
    // Récupération données du site de l'utilisateur à travers son IP
    $req1 = $pdo->query("SELECT * FROM sessions WHERE adresseIP ='" .$ipSession. "';");
    $bddSession = $req1->fetch();
    $idSite = $bddSession["id_site"];
    $_SESSION["dernConn"] = $bddSession["DerniereConnexion"];
    
    $req2 = $pdo->query("SELECT * FROM site WHERE id_site ='" .$idSite. "';");
    $bddSite = $req2->fetch();
    
    $_SESSION["codeSite"] = $bddSite["CodeSite"];
    $_SESSION["raisonSociale"] = $bddSite["RaisonSociale"];
    $_SESSION["adresse1"] = $bddSite["Adresse1"];
    $_SESSION["adresse2"] = $bddSite["Adresse2"];
    $_SESSION["adresse3"] = $bddSite["Adresse3"];
    $_SESSION["cp"] = $bddSite["CodePostal"];
    $_SESSION["ville"] = $bddSite["Ville"];
    $_SESSION["pays"] = $bddSite["Pays"];
    $_SESSION["tel"] = $bddSite["Telephone"];
    $_SESSION["mail"] = $bddSite["Mail"];
    $_SESSION["contact"] = $bddSite["Contact"];
    //END 
           
    if(isset($codeU_Session)){     
        // vérification que le code utilisateur existe dans la bdd        
        $reqVerif = $pdo->prepare("SELECT codeUtilisateur FROM utilisateurs WHERE codeUtilisateur='$codeU_Session'");
        $reqVerif->execute();
        $verif = $reqVerif->rowCount();
        if($verif == 0){
            ?><script language="javascript">
            alert("Code utilisateur inconnu...");
            history.back();
            </script>
            <?php
        }
        // END - vérif
        
        // redirection pour enregistrer un mdp si le champ mdp est vierge lors de la validation
        elseif($_POST["password"] == NULL){                       
            header("Location: http:\\Pesage\activationCompte.php?idS=$codeU_Session"); 
            exit;
            
        // requete bdd et vérification si le mdp entré par l'utilisateur est le même que dans la bdd et qu'il correspond au code utilisateur  
        }else{            
            $req = $pdo->query("SELECT * FROM utilisateurs");    
            while ($bdd = $req->fetch()){
                if(($bdd["MotDePasse"] == $_POST["password"]) && ($bdd["codeUtilisateur"] == $codeU_Session)){
                    // Verification que l'utilisateur n'a pas déjà une session ouverte
                    $sqlCompte = $pdo->query("SELECT * FROM pesage.utilisateurs WHERE CodeUtilisateur ='" .$codeU_Session."';");
                    $sqlCompte->execute();
                    $bddCompte = $sqlCompte->fetch();
                    $_SESSION['compte'] = $bddCompte["Connexion"];                    
                    
                    // popup pour prévenir qu'une session est déjà ouverte et demander une réinitialisation ou non
                    if($_SESSION['compte'] == 1){                        
                        ?><script type="text/javascript" language="javascript">
                            if(confirm('Vous êtes déjà connecté sur un autre poste... Souhaitez-vous réinitialiser la session ? ')){
                                window.location.href='deconnexion.traitement.php?idS=<?php echo $codeU_Session; ?>';
                            }else{
                                window.location.href='authentification.php';
                            }                            
                        </script>
                        <?php 
                    //END - problème
                    
                    // Enregistrement mode "en ligne" dans bdd
                    }else{ 
                        try{
                            $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $sql = $pdo->prepare("UPDATE pesage.utilisateurs SET Connexion = '1' WHERE CodeUtilisateur = '" .$codeU_Session. "';"); 
                            $sql->execute();                            
                        } catch (Exception $e1) {
                            echo $sql . "<br>" . $e1->getMessage();
                        }        
                        $conn = null;
                    }
                    // END - enregistrement mode "en ligne"
                    $_SESSION["compte"] = 1; 
                    // Redirection page d'accueil
                    ?><script>document.location="accueil.php?idS=<?php echo $codeU_Session; ?>";</script><?php                    
                }
            }
            // si aucune saisie n'a de correspondance avec la bdd
            ?>
            <script language="javascript">
                alert("Mauvaise saisie !");
                history.back();
            </script>
            <?php
        }
        // END - requete et verif
    }else{                              
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            history.back();
        </script>
        <?php
    }
    


