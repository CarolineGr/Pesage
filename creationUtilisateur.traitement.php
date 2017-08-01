<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Création d'un utilisateur - Pesage</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <br>            
            
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">            
                    <form class="form-horizontal" method="post" action="#">
                        <fieldset>
                            <legend>Créer un nouvel utilisateur</legend>
                            <br>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="codeU">Code utilisateur</label>
                                <div class="col-lg-7">
                                    <input class="form-control" style="text-transform: uppercase" type="text" name="codeU" id="codeU" autocomplete="off" pattern="^[0-9a-zA-Z\s]{2,10}$">
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">                        
                                <label style="text-align: left" class="col-lg-5 control-label" for="nom">Nom</label>
                                <div class="col-lg-7">
                                    <input class="form-control" style="text-transform: uppercase" type="text" name="nom" id="nom" autocomplete="off" pattern="^[-'a-zA-Z\s]{2,30}$">                
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="prenom">Prénom</label>
                                <div class="col-lg-7">
                                    <input class="form-control" style="text-transform: uppercase" type="text" name="prenom" id="prenom" autocomplete="off" pattern="^[-'0-9a-zA-Z\s]{3,30}$">                
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="dateNaissance">Date de naissance</label>
                                <div class="col-lg-7">
                                    <input class="form-control" type="text" name="dateNaissance" placeholder="Format : JJ-MM-AAAA" pattern="\d{1,2}-\d{1,2}-\d{4}" class="datepicker" id="dateNaissance" autocomplete="off">                
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="password">Clef d'activation</label>
                                <div class="col-lg-7">
                                    <input class="form-control" type="text" name="password" id="password" value="" readonly="">
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-12"><br></div>
                            </div>
                            
                            <div class="row">
                                <div class="pull-center">
                                    <span class="input-group-addon">
                                        <div class="radio">
                                            <p>Droit d'administrateur</p>
                                            <label class="choix"><input type="radio" name="admin" value="NON" checked=""> Non</label>
                                            <label class="choix"><input type="radio" name="admin" value="OUI"> Oui</label>                              
                                        </div> 
                                    </span>
                                </div>
                            </div>                            
                
                            <div class="row">                              
                                <div class="pull-center">
                                    <div class="form-group col-lg-push-4 col-lg-6">
                                        <div class="col-lg-5">
                                              <button type="submit" name="valider" class="btn btn-primary">Valider</button>
                                        </div>
                                        <div class="col-lg-5"> 
                                              <button type="submit" name="annuler" class="btn btn-default">Annuler</button>                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div> <!-- col-->
            </div> <!-- row-->         
        </div> <!-- container-->
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";
    
    // code utilisateur de la session + code de l'utilisateur à créer
    if(isset($_GET["idS"]) && isset($_POST["codeU"])){
        $codeU_Session = $_GET["idS"];
        $codeU = $_POST["codeU"];
    }else{
        echo "erreur";
    }
    
    // gestion bouton annuler
    if (isset($_POST['annuler'])){
        if(($_POST["codeU"] != "") || ($_POST["nom"] != "") || ($_POST["prenom"] != "") || ($_POST["dateNaissance"] != "") || ($_POST["admin"] != "NON")){
            ?>
            <script language="javascript">
                if(confirm("Voulez-vous quitter sans enregistrer les modifications ?")){
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                }else{
                    history.back();
                }
            </script>
            <?php
            exit();
                     
        }else{
            ?><script>document.location="accueil.php?idS=<?php echo $codeU_Session; ?>";</script><?php
            exit();
        }
    // gestion bouton valider    
    }elseif (isset($_POST['valider'])){         
        // vérification que le code utilisateur n'exite pas déjà dans la bdd 
        $pdo = gestionnaireDeConnexion();
        $reqVerif = $pdo->prepare("select codeUtilisateur from utilisateurs where codeUtilisateur='$codeU'");
        $reqVerif->execute();
        $verif = $reqVerif->rowCount();
        if($verif === 1){
            ?><script language="javascript">
                alert("Code utilisateur déjà utilisé...");
                history.back();
            </script>
            <?php
            exit();
        // END - vérif
                
        // connexion et enregistrement des données dans la bdd
        }else{
            if(!empty($_POST["codeU"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["dateNaissance"])){
                // vérification de la validité de la date
                if(!verifDate($_POST["dateNaissance"])){
                    ?><script language="javascript">
                        alert("Date de naissance invalide !");
                        history.back();
                    </script><?php 
                    exit();
                                    
                }else{
                    $codeU = sansAccents($_POST["codeU"]);
                    $codeU = mb_strtoupper($codeU); // pour forcer l'écriture majuscule afin d'uniformiser la bdd
                    $nom = sansAccents($_POST["nom"]);
                    $nom = mb_strtoupper($nom); // pour forcer l'écriture majuscule afin d'uniformiser la bdd
                    $prenom = sansAccents($_POST["prenom"]); 
                    $prenom = ucwords(strtolower($prenom)); // pour forcer la 1ère lettre majuscule afin d'uniformiser la bdd
                    $clef_activation = $_POST["password"];
                    $dateNaissance = modulerDateBDD($_POST["dateNaissance"]);
                    $admin = $_POST["admin"];                    

                    try{
                        $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO `pesage`.`utilisateurs` (`codeUtilisateur`, `Nom`, `Prenom`, `DateDeNaissance`, `Administrateur`, `MotDePasse`, `Connexion`, `Clef_Activation`) VALUES ('" . $codeU . "', '" . $nom . "', '" . $prenom . "', '" . $dateNaissance . "', '" . $admin . "', '', '0', '" .$clef_activation. "');";
                        $conn->exec($sql);
                    }
                    catch(PDOException $e){
                        echo $sql . "<br>" . $e->getMessage();
                    } 
                    // fin de connection à la bdd
                    $conn = null;

                    // fenêtre avertissement succès puis redirection
                    ?><script language="javascript">
                        alert("Nouvel utilisateur enregistré avec succès !");
                        window.location.href='accueil.php?idS=<?php echo $codeU_Session;?>';
                    </script><?php 
                    // END - script popup 
                }
            }else{
                ?>
                <script language="javascript">
                    alert("Veuillez remplir tous les champs !");
                    history.back();
                </script>
                <?php
            } 
        }
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
    }

    

    