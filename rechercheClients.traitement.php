<?php
    include_once 'gestionBase.php';        
    $pdo = gestionnaireDeConnexion();

// code utilisateur de la session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'Erreur';
    }
// gestion boutons annuler/valider
    if(isset($_POST["annuler"])){
        header("Location: http:\\Pesage\accueil.php?idS=$codeU_Session");
        exit;
        
    }elseif(isset($_POST["valider"])){
        // vérification qu'au moins un des champs est rempli
        if((!empty($_POST["codeC"]) && isset($_POST["contact"]) && isset($_POST["raiSoc"]) && isset($_POST["cp"]) && isset($_POST["ville"])) ||
        (isset($_POST["codeC"]) && !empty($_POST["contact"]) && isset($_POST["raiSoc"]) && isset($_POST["cp"]) && isset($_POST["ville"])) ||
        (isset($_POST["codeC"]) && isset($_POST["contact"]) && !empty($_POST["raiSoc"]) && isset($_POST["cp"]) && isset($_POST["ville"])) ||
        (isset($_POST["codeC"]) && isset($_POST["contact"]) && isset($_POST["raiSoc"]) && !empty($_POST["cp"]) && isset($_POST["ville"])) ||
        (isset($_POST["codeC"]) && isset($_POST["contact"]) && isset($_POST["raiSoc"]) && isset($_POST["cp"]) && !empty($_POST["ville"])))
        {    
            $code = $_POST["codeC"];
            $contact = $_POST["contact"];
            $raisonSociale = $_POST["raiSoc"];
            $cp = $_POST["cp"];
            $ville = $_POST["ville"];
            
            // requete de recherche à la bdd
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $req = $pdo->query("SELECT * FROM clients WHERE CodeClient LIKE '" .$code. "%' && RaisonSociale LIKE '" .$raisonSociale. "%' && Contact LIKE '" .$contact. "%' && CodePostal LIKE '" .$cp. "%' && Ville LIKE '" .$ville. "%'");
                $req->execute();
                
                $nvTab = array();
                while ($row = $req->fetch()){
                    $nvTab[] = array(
                            'CodeClient' => $row["CodeClient"],
                            'RaisonSociale' => $row["RaisonSociale"],
                            'Adresse1' => $row["Adresse1"],
                            'Adresse2' => $row["Adresse2"],
                            'Adresse3' => $row["Adresse3"],
                            'CodePostal' => $row["CodePostal"],
                            'Ville' => $row["Ville"],
                            'Pays' => $row["Pays"],
                            'Telephone' => $row["Telephone"],
                            'Mail' => $row["Mail"],
                            'Contact' => $row["Contact"]
                            );   
                }            
            } catch (Exception $e) {
                echo $req . "<br>" . $e->getMessage();
            }            
            $conn = null;
             
        }else{
            ?>
            <script language="javascript">
                alert("Merci de remplir au moins un champ");
                history.back();
            </script>
            <?php 
        }       
        
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
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
                <!-- Résultat de la recherche -->            
                <div class="col-lg-8 col-lg-offset-2">            
                    <table id="recherche" border="1">
                        <caption>** Résultat de la recherche **</caption>
                        <br>
                        <thead>
                        <tr>
                            <th>Code Client</th>
                            <th>Raison Sociale</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                            <th>Contact</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($nvTab as $val){ ?>  
                        <tr>
                            <td><a href="gestionClients.php?codeClient=<?php echo $val['CodeClient'];?>&idS=<?php echo $codeU_Session; ?>"><?php echo $val['CodeClient']; ?></a></td>
                            <td><?php echo $val["RaisonSociale"]; ?></td>
                            <td><?php echo $val["CodePostal"]; ?></td>
                            <td><?php echo $val["Ville"]; ?></td>
                            <td><?php echo $val["Contact"]; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br>
                    <!--n'apparait que s'il y a un résultat à la recherche-->
                    <?php if($nvTab != array()){ ?>
                    <div id="bouton" class="well col-lg-offset-5 col-lg-2">
                            <a href="accueil.php?idS=<?php echo $codeU_Session; ?>">Annuler</a>                         
                        </div> 
                    <?php } ?>
                </div>
            </div>
            <div class="row"> 
                <!--n'apparait que s'il n'y a aucun résultat à la recherche-->
                <?php if($nvTab == array()){ ?>
                    <div style="text-align: center; font-style: oblique; font-size: 16px;" class="col-lg-8 col-lg-offset-2">            
                        <br>
                        <?php                        
                            echo "Aucune correspondance trouvée dans la base de données..." ;                        
                        ?> 
                        <br>
                        <br>
                        <br>    
                        <div class="col-lg-12">
                            <div id="bouton" class="well col-lg-offset-2 col-lg-3">  
                                <a  href="rechercheClients.php?idS=<?php echo $codeU_Session; ?>">Nouvelle recherche</a>
                            </div>
                            <div id="bouton" class="well col-lg-offset-2 col-lg-3">
                                <a  href="accueil.php?idS=<?php echo $codeU_Session; ?>">Annuler</a>                         
                            </div> 
                        </div>                       
                    </div>
                <?php } ?>
            </div> 
            <br>
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>