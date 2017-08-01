<?php session_start();
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";    
    $pdo = gestionnaireDeConnexion();
    
    // récupération du code utilisateur de la session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'erreur';
    }
    
    //reset des sessions poids/prix
    $_SESSION["poidsT1"] = 0;
    $_SESSION["poidsT2"] = 0;
    $_SESSION["poidsT3"] = 0;
    $_SESSION["prixT1"] = 0;
    $_SESSION["prixT2"] = 0;
    $_SESSION["prixT3"] = 0;
    $_SESSION["codeMat1"] = "";
    $_SESSION["codeMat2"] = "";
    $_SESSION["codeMat3"] = "";
    
    // gestion bouton annuler
    if(isset($_POST['annuler'])){
        if(($_POST["dateD"] != "") && ($_POST["dateF"] != "") && ($_POST["heureD"] != "") && ($_POST["heureF"] != "") && ($_POST["client"] != "") && ($_POST["codeMat"] != "")){
            ?>
            <script language="javascript">
                if(confirm("Voulez-vous quitter sans valider la facture ?")){
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                }else{
                    history.back();
                }
            </script>
            <?php
            exit();
                     
        }else{
        ?><script>document.location="accueil.php?idS=<?php echo $codeU_Session ; ?>";</script><?php
        }
        exit();
        
    // gestion boutons valider
    }elseif(isset($_POST['valider'])){
        if(isset($_POST["dateD"]) && isset($_POST["dateF"]) && isset($_POST["heureD"]) && isset($_POST["heureF"]) && isset($_POST["client"]) && isset($_POST["codeMat"])){
            if(verifDate($_POST["dateD"])){
                $dateD = $_POST["dateD"];
            }
            $heureD = $_POST["heureD"];
            $dateD = modulerDateBDD($dateD);
            $_SESSION["dateTimeD"] = $dateD. " " .$heureD;
            $_SESSION["heureD"] = $heureD;
            $_SESSION["dateD"] = $dateD;
            
            if(verifDate($_POST["dateF"])){
                $dateF = $_POST["dateF"];
            }
            $heureF = $_POST["heureF"];
            $dateF = modulerDateBDD($dateF);
            $_SESSION["dateTimeF"] = $dateF. " " .$heureF;
            $_SESSION["heureF"] = $heureF;
            $_SESSION["dateF"] = $dateF;
            
            $_SESSION["client"] = $_POST["client"];
            $_SESSION["codeMat1"] = $_POST["codeMat"];
            
            // récupération du code client
            $req = $pdo->query('SELECT * FROM clients WHERE RaisonSociale="' .$_SESSION["client"].'";');        
            $bdd = $req->fetch();            
            $codeC = $bdd["CodeClient"];
            $req->closeCursor();
            
            // requete bdd matières
            $req = $pdo->query('SELECT * FROM matieres WHERE CodeMatiere="' .$_SESSION['codeMat1'].'";');        
            $bdd = $req->fetch();

            $matiere = $bdd["Matiere"];
            $req->closeCursor();
            
        }else{
            ?>
            <script language="javascript">
                alert("Une erreur est survenue... ");
                window.location.href='factureMensuelle.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php
            exit();
        }
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='factureMensuelle.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
        exit();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recherche dans la base de données - Pesage</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <br> 
            <div class="row">
                <div class="col-lg-offset-3">
                    <table id="search" border="1">                        
                        <caption>** Résultat de la recherche pour ** <br><span class="blue">** <?php echo $_SESSION["client"] ?> **</span><br><span class="violet"> ** <?php echo $matiere; ?> **</span></caption>
                            <thead>
                                <tr>
                                    <th>ID pesée</th>
                                    <th>Date</th>
                                    <th>Immatriculation</th>
                                    <th>Poids déchargé</th> 
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // requete de recherche des données de facturer
                                $req = $pdo->prepare("SELECT * FROM `historiquepesees` WHERE `DateEntree` BETWEEN '" .$_SESSION["dateTimeD"]. "' AND '" .$_SESSION["dateTimeF"]. "' AND CodeClient = '" .$codeC. "' AND CodeMatiere = '" .$_SESSION["codeMat1"]. "';");
                                $req->execute();

                                while($bdd = $req->fetch()){
                                    $idPesee = $bdd["id_pesees"];
                                    $dateE = $bdd["DateEntree"];
                                    $immat = $bdd["Immatriculation"];                  
                                    $poidsE = $bdd["PoidsEntree"];
                                    $poidsS = $bdd["PoidsSortie"];
                                    $poids = $poidsE - $poidsS;
                                    $prix = $bdd["Prix"];                                
                                ?>

                                <tr>
                                    <td><?php echo $idPesee; ?></td> <?php //$tabPesee[] = $idPesee; ?>
                                    <td><?php echo $dateE; ?></td>
                                    <td><?php echo $immat; ?></td>
                                    <td><?php echo $poids; ?></td> <?php $_SESSION["poidsT1"] += $poids; ?> <!-- calcul du poids total par matière-->
                                    <td><?php echo $prix; ?></td> <?php $_SESSION["prixT1"] += $prix; ?> <!-- calcul du prix total par matière  -->
                                </tr> 
                                <?php } ?>
                        </tbody>                        
                    </table>
                    <br>
                    <br>                 
                    
                </div>
            </div>
            <div class="row">
                <div id="bouton" class="well col-lg-offset-2 col-lg-2" style="text-align: center">
                    <a href="javascript:
                       if(confirm('Voulez-vous quitter sans valider la facture ?')){
                            window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                        }else{
                            history.back();
                        }">Annuler</a>
                </div>
                <div id="bouton" class="well col-lg-offset-1 col-lg-2" style="text-align: center">
                    <a href="factureMensuelle2Matieres.php?idS=<?php echo $codeU_Session;?>">Compléter la facture</a>
                </div>
                <div id="bouton" class="well col-lg-offset-1 col-lg-2" style="text-align: center">
                    <a href="javascript:
                    window.open('facturePeriodique.php?idS=<?php echo $codeU_Session ;?>','facture','menubar=no, status=no, scrollbars=no, menubar=no, width=800, height=600');
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';">Facturer</a>                    
                </div>
            </div>
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>