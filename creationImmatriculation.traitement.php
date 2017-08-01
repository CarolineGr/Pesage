<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Création d'une immatriculation - Pesage</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <br>            
            
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">            
                    <form class="form-horizontal" method="post" action="#">
                        <fieldset>
                            <legend>Création d'une immatriculation</legend>
                            <br>
                            
                            <!-- Numéro d'immatriculation -->
                            <div class="form-group">
                                <label style="text-align: left" class="col-lg-5 control-label" for="immat">Immatriculation</label>
                                <div class="col-lg-7">
                                    <input class="form-control" type="text" style="text-transform: uppercase" name="immat" id="immat" autocomplete="off" pattern="[a-AA-Z0-9\-]{6,10}">
                                </div>
                            </div>
                            
                            <!-- Transporteur -->
                            <div class="form-group">
                                <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Transporteur</label>
                                <div class="col-lg-7">
                                    <select name="transp" type="text" style="text-transform: uppercase" class="form-control">
                                        <option  value=""></option>                                    
                                    </select>    
                                </div>
                            </div> 
                                              
                                                     
                           <!-- Validation formulaire-->
                            <div class="row">
                                <div class="col-lg-push-2 col-lg-10">
                                    <div class="form-group">
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
                </div>
            </div>          
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";
    
    $pdo = gestionnaireDeConnexion();
    
    // récupération du code utilisateur de la session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'erreur';
    }
    
    // gestion bouton annuler
    if(isset($_POST['annuler'])){
        if(($_POST["immat"] != "") || ($_POST["transp"] != "")){
            ?>
            <script language="javascript">
                if(confirm("Voulez-vous quitter sans enregistrer les entrées ?")){
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                }else{
                    history.back();
                }
            </script>
            <?php
            exit();
                     
        }else{
        ?><script>document.location="accueil.php?idS=<?php echo $codeU_Session ; ?>";</script><?php
        exit();
        }
    // gestion boutons valider
    }elseif(isset($_POST['valider'])){ 
        //récupération des données du formulaire
        if(isset($_POST["immat"])){
            $immat = mb_strtoupper($_POST["immat"]);
            $immat = sansAccents($immat);
            $nomTransp = $_POST["transp"];
            
            // verification si une immatriculation est saisie
            if(($immat == "") || ($nomTransp == "")){
                ?>
                <script language="javascript">
                    alert("Veuillez compléter les champs !");
                    history.back();                    
                </script>
                <?php
                exit();
            } 
            
            //vérification si l'immatriculation n'est pas déjà dans la base
            $bddImmat = listeImmatriculation();
            $immats = array_column($bddImmat, 'Immatriculation');
            foreach($immats as $immatriculation){
                if($immatriculation == $immat){
                    ?>
                    <script language="javascript">
                        alert("Immatriculation déjà existante...");
                        history.back();                    
                    </script>
                    <?php
                    exit();
                }
            }
            

            // Récupération de l'id transporteur dans la bdd
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql1 = $pdo->query("SELECT id_Transporteur FROM pesage.transporteurs WHERE RaisonSociale='" .$nomTransp. "';");
                $sql1->execute();
                $bdd = $sql1->fetch();

                $idTransp = $bdd["id_Transporteur"];

            } catch (Exception $e1) {
                echo $sql1 . "<br>" . $e->getMessage();
            }
            $conn = null;

            // Enregistrement des données dans la base
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql2 = $pdo->prepare("INSERT INTO `pesage`.`immatriculations` (`id_immatriculation`, `Immatriculation`, `id_transporteur`) VALUES (NULL, '" .$immat. "', '" .$idTransp. "')");
                $sql2->execute();
            } catch (Exception $e2) {
                echo $sql2 . "<br>" . $e2->getMessage();
            }
            $conn = null;

            ?>
            <script language="javascript">
                alert("Nouvelle immatriculation enregistrée !");
                window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php 
            
        }else{
            ?>
            <script language="javascript">
                alert("Une erreur est survenue... ");
                window.location.href='creationImmatriculation.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php
        }
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='creationImmatriculation.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
    }

    
    
