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
    
    // gestion bouton annuler
    if(isset($_POST['annuler'])){
        ?>
        <script language="javascript">
            if(confirm("Etes-vous sûr de vouloir abandonner cette facture ?")){
                window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
            }else{
                history.back();
            }
        </script>
        <?php
        exit();
                
    // gestion boutons valider
    }elseif(isset($_POST['valider'])){
        if(isset($_POST["codematiere2"])){
            $codematiere2 = $_POST["codematiere2"];
            $_SESSION["codeMat2"] = $codematiere2;
            $dateTimeD = $_SESSION["dateTimeD"];
            $dateTimeF = $_SESSION["dateTimeF"];
            
            // requete bdd matières
            $req = $pdo->query('SELECT * FROM matieres WHERE CodeMatiere="' .$codematiere2.'";');        
            $bdd = $req->fetch();

            $matiere2 = $bdd["Matiere"];
            $req->closeCursor();
            
            // récupération raison sociale client
            $req = $pdo->query('SELECT * FROM clients WHERE RaisonSociale="' .$_SESSION["client"].'";');        
            $bdd = $req->fetch();            
            $codeC = $bdd["CodeClient"];
            $req->closeCursor();
            
        }else{
            ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
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
        <title>Facturation périodique - Pesage</title>
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
                        <caption>** Résultat de la recherche pour ** <br><span class="blue">** <?php echo $_SESSION["client"] ?> **</span><br><span class="violet"> ** <?php echo $matiere2; ?> **</span></caption>
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
                                $req = $pdo->prepare("SELECT * FROM `historiquepesees` WHERE `DateEntree` BETWEEN '" .$dateTimeD. "' AND '" .$dateTimeF. "' AND CodeClient = '" .$codeC. "' AND CodeMatiere = '" .$codematiere2. "';");
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
                                    <td><?php echo $idPesee; ?></td> 
                                    <td><?php echo $dateE; ?></td>
                                    <td><?php echo $immat; ?></td>
                                    <td><?php echo $poids; ?></td> <?php $_SESSION["poidsT2"] += $poids; ?> <!-- calcul du poids total par matière-->
                                    <td><?php echo $prix; ?></td> <?php $_SESSION["prixT2"] += $prix; ?> <!-- calcul du prix total par matière  -->
                                </tr> 
                                <?php } ?>
                        </tbody>                        
                    </table>
                    <br>
                    <br>  
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
                        <a href="factureMensuelle3Matieres.php?idS=<?php echo $codeU_Session ;?>">Compléter la facture</a>
                    </div>
                    <div id="bouton" class="well col-lg-offset-1 col-lg-2" style="text-align: center">
                        <a href="javascript:
                        window.open('facturePeriodique.php?idS=<?php echo $codeU_Session ;?>','facture','menubar=no, status=no, scrollbars=no, menubar=no, width=800, height=600');
                        window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';">Facturer</a>                    
                    </div>
                </div>    
            </div>
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>