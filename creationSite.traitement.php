<!DOCTYPE html>
<html>
   <head>
        <meta charset="UTF-8">
        <title>Site - Pesage</title>
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
                    <form class="form-horizontal" role="form" method="post" action="#">
                        <fieldset>
                        <legend>Création d'un site</legend>
                        <br>
        
                        <div class=" form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="codeS">Code site</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="codeS" id="codeS" pattern="^[0-9a-zA-Z\s]{2,10}$" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="raiSoc">Raison sociale</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="raiSoc" id="raiSoc" pattern="^[-,'°çéèù0-9a-zA-Z\s]{3,30}$" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="adresse1">Adresse 1</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="adresse1" id="adresse1" pattern="^[-,'°çéèù0-9a-zA-Z\s]{3,30}$" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="adresse2">Adresse 2</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="adresse2" id="adresse2" placeholder="facultatif" pattern="^[-,'°çéèù0-9a-zA-Z\s]{3,30}$" autocomplete="off" >
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="adresse3">Adresse 3</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="adresse3" id="adresse3" placeholder="facultatif" pattern="^[-,'°çéèù0-9a-zA-Z\s]{3,30}$" autocomplete="off" >
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="cp">Code postal</label>
                            <div class="col-lg-7">    
                                <input class="form-control" type="text" name="cp" id="cp" pattern="^[0-9]{2,10}$" autocomplete="off" >
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="ville">Ville</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="ville" id="ville" pattern="^[-'çéèùa-zA-Z\s]{1,30}$" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="pays">Pays</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="pays" id="pays" pattern="^[-'çéèùa-zA-Z\s]{1,30}$" autocomplete="off">
                            </div>
                        </div>                    
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="tel">Téléphone</label>
                            <div class="col-lg-7">
                                <input class="form-control" type="tel" name="tel" id="tel" pattern="^[0-9]{10,15}$" placeholder="Entrez uniquement les chiffres" autocomplete="off">
                            </div>
                        </div>                    
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="email">Email</label>
                            <div class="col-lg-7">
                                <input class="form-control" type="email" name="email" id="email" maxlength="30" autocomplete="off">
                            </div>
                        </div>                    
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="contact">Contact</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="contact" id="contact" placeholder="NOM Prénom" pattern="^[-'çéèùa-zA-Z\s]{3,30}$" autocomplete="off">
                            </div>
                        </div>
                </div>

                <div class="pull-center">
                    <div class="form-group col-lg-5 col-lg-offset-4">
                        <div class="col-lg-5">
                              <button type="submit" name="valider" class="btn btn-primary">Valider</button>
                        </div>
                        <div class="col-lg-5"> 
                              <button type="submit" name="annuler" class="btn btn-default">Annuler</button>                            
                        </div>
                    </div>
                </div>
                        
                    </fieldset>
                </form> 
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";

// code utilisateur de la session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    // gestion bouton annuler
    if(isset($_POST["annuler"])){
        if(($_POST["codeS"] != "") || ($_POST["raiSoc"] != "") || ($_POST["adresse1"] != "") || ($_POST["adresse2"] != "") || ($_POST["adresse3"] != "") || ($_POST["cp"] != "") || ($_POST["ville"] != "") || ($_POST["pays"] != "") || ($_POST["tel"] != "") || ($_POST["email"] != "")  || ($_POST["contact"] != "")){
            ?>
            <script language="javascript">
                if(confirm("Voulez-vous quitter sans enregistrer les modifications ?")){
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                }else{
                    history.back();
                }
            </script>
            <?php
        
        }else{
            ?><script>document.location="accueil.php?idS=<?php echo $codeU_Session; ?>";</script><?php
        }
    
    // gestion bouton valider
    }elseif(isset($_POST["valider"])){
        // vérification que le code site n'exite pas déjà dans la bdd 
        $pdo = gestionnaireDeConnexion();
        $reqVerif = $pdo->prepare("SELECT CodeSite FROM site WHERE codeSite='" .$_POST["codeS"]. "';");
        $reqVerif->execute();
        $verif = $reqVerif->rowCount();
        if($verif === 1){
            ?><script language="javascript">
                alert("Code site déjà utilisé...");
                history.back();
            </script>
            <?php 
        }
        // END - vérif
                
        if(!empty($_POST["codeS"]) && !empty($_POST["raiSoc"]) && !empty($_POST["adresse1"])&& isset($_POST["adresse2"])&& isset($_POST["adresse3"])&& !empty($_POST["cp"])&& !empty($_POST["ville"])&& !empty($_POST["pays"])&& !empty($_POST["tel"])&& isset($_POST["email"])&& !empty($_POST["contact"])){
            // récupération des données du formulaire, modification de la casse et mise en place des variables
            $codeSite = sansAccents($_POST["codeS"]);
            $codeSite = mb_strtoupper($codeSite);
            $raisonSociale = sansAccents($_POST["raiSoc"]);
            $raisonSociale = mb_strtoupper($raisonSociale);
            $adresse1 = sansAccents($_POST["adresse1"]);
            $adresse1 = mb_strtolower($adresse1);
            $adresse2 = sansAccents($_POST["adresse2"]);
            $adresse2 = mb_strtolower($adresse2);
            $adresse3 = sansAccents($_POST["adresse3"]);
            $adresse3 = mb_strtolower($adresse3);
            $cp = $_POST["cp"];
            $ville = sansAccents($_POST["ville"]);
            $ville = mb_strtoupper($ville);
            $pays = sansAccents($_POST["pays"]);
            $pays = mb_strtoupper($pays);
            $tel = $_POST["tel"];
            $email = sansAccents($_POST["email"]);
            $contact = sansAccents($_POST["contact"]);
            $contact = mb_strtoupper($contact);
                   
            try{            
                $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `pesage`.`site` (`CodeSite`, `RaisonSociale`, `Adresse1`, `Adresse2`, `Adresse3`, `CodePostal`, `Ville`, `Pays`, `Telephone`, `Mail`, `Contact`, `id_societe`) VALUES ('" . $codeSite . "', '" . $raisonSociale . "', '" . $adresse1 . "', '" . $adresse2 . "', '" . $adresse3 . "', '" . $cp . "', '" . $ville . "', '" . $pays . "', '" . $tel . "', '" . $email . "', '" . $contact . "', '1');";
                $conn->exec($sql); 
            }
            catch(PDOException $ge){
                echo $sql . "<br>" . $ge->getMessage();
            }
            // fin de connection à la bdd
            $conn = null; 

            // fenêtre avertissement succès puis redirection
            ?><script language="javascript">
                alert("Nouveau site enregistré avec succès !");
                window.location.href='accueil.php?idS=<?php echo $codeU_Session;?>';
            </script><?php 
            // END - script popup
            
        }else{
           ?>
           <script language="javascript">
               alert("Remplir les champs obligatoires");
               history.back();
           </script>
           <?php
        }    
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue... ");
            window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
    }
        

