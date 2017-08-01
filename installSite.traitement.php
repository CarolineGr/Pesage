<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Installation d'un poste sur un site - Pesage</title>
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
                    <form class="form-horizontal" method="post" action="#">
                        <fieldset>
                            <legend>Installation d'un poste sur un site</legend>
                            <br>
                            
                            <!-- Adresse IP -->
                            <div class="form-group">
                                <label style="text-align: left" class="col-lg-5 control-label" for="adIP">Adresse IP du site</label>
                                <div class="col-lg-7">
                                    <input class="form-control" type="text" name="adIP" id="adIP" autocomplete="off" pattern="^[.0-9\s]{7,15}$">
                                </div>
                            </div>
                            
                            <!-- Site -->
                            <div class="form-group">
                                <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Nom du site</label>
                                <div class="col-lg-7">
                                    <select name="nomSite" type="text" class="form-control">
                                        <option  value=""></option>   
                                    </select>    
                                </div>
                            </div> 
                                              
                                                     
                           <!-- Validation formulaire-->
                            <div class="row">
                             <div class="col-lg-offset-1 col-lg-12">
                                <div class="col-lg-5">
                                      <button type="submit" name="valider" class="btn btn-primary">Valider</button>
                                </div>
                                <div class="col-lg-5"> 
                                      <button type="submit" name="annuler" class="btn btn-default">Annuler</button>                            
                                </div>
                             </div>
                            </div>
                           
                           <div class="row">
                            <div class="col-lg-12">
                                <br>
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
    
    // variable de session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'Erreur';
    }
    
    // gestion bouton annuler
    if(isset($_POST['annuler'])){
        if(isset($_POST["adIP"])){
            if($_POST["adIP"] == ""){ 
                header("Location: http:\\Pesage\accueil.php?idS=$codeU_Session");
                exit;
            }else{
                ?>
                <script language="javascript">
                    if(confirm("Voulez-vous quitter sans enregistrer les modifications ?")){
                        window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                    }else{
                        history.back();
                    }
                </script>
                <?php
                exit;
            }
        }else{
            echo "erreur";
        }
    
    // gestion du bouton valider
    }elseif(isset($_POST['valider'])){ 
        //récupération des données du formulaire
        if(isset($_POST["adIP"]) && isset($_POST["nomSite"])){
            $adresseIP = $_POST["adIP"];
            $nomSite = $_POST["nomSite"];
                
            // vérification champ rempli            
            if($adresseIP == ""){
                ?>
                <script language="javascript">
                    alert("Veuillez saisir une adresse IP !");
                    history.back();
                </script>
                <?php 
            // vérification IP
            }elseif(verifFormatIP($adresseIP) == "false"){
                ?>
                <script language="javascript">
                    alert("Adresse IP non valide !");
                    history.back();
                </script>
                <?php               
            }else{
                // Récupération de l'id site dans la bdd
                try{
                    $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql1 = $pdo->query("SELECT id_site FROM pesage.site WHERE RaisonSociale='" .$nomSite. "';");
                    $sql1->execute();
                    $bdd = $sql1->fetch();

                    $idSite = $bdd["id_site"];

                } catch (Exception $e1) {
                    echo $sql1 . "<br>" . $e1->getMessage();
                }
                $conn = null;

                // Enregistrement des données dans la base
                try{
                    $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql2 = $pdo->prepare("INSERT INTO `pesage`.`sessions` (`id_session`, `adresseIP`, `DerniereConnexion`, `id_site`) VALUES (NULL, '" .$adresseIP. "', '0000-00-00 00:00:00', '" .$idSite. "')");
                    $sql2->execute();
                } catch (Exception $e2) {
                    echo $sql2 . "<br>" . $e2->getMessage();
                }
                $conn = null;

                ?>
                <script language="javascript">
                    alert("Nouveau site enregistré avec succès !");
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                </script>
                <?php 
            }
        }else{
            ?>
            <script language="javascript">
                alert("Une erreur est survenue...");
                window.location.href='installSite.php?idS=<?php echo $codeU_Session; ?>';
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
    
    
