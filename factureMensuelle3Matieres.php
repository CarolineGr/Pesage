<?php session_start();
include_once 'gestionBase.php';
$pdo = gestionnaireDeConnexion();

if(isset($_GET["idS"])){
    $codeU_Session = $_GET["idS"];
}else{
    echo "Erreur";
}
?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="UTF-8">
        <title>Facture périodique - Pesage</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">  
    </head>
    <body>
        <div class="container">
            <br>
            <br>
            
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10 ">
                    <form class="form-horizontal" role="form" method="POST" action="factureMensuelle3Matieres.traitement.php?idS=<?php echo $codeU_Session;?>">
                        <div class=" col-lg-offset-1 col-lg-10">
                            <fieldset>
                            <legend>Facture périodique</legend>
                            <br>
                            
                            <div class="row">
                                <div class="col-lg-offset-1 col-lg-10">
                                    <h3>Période du <span class="blue"><?php echo $_SESSION["dateD"]; ?> à <?php echo $_SESSION["heureD"]; ?></span> au <span class="blue"><?php echo $_SESSION["dateF"] ;?> à <?php echo $_SESSION["heureF"]; ?></span></h3>
                                    <h3>Client : <span class="violet"><?php echo $_SESSION["client"];?></span></h3>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-offset-3 col-lg-10">
                                    <!-- Code matière -->
                                    <div class="form-group">
                                      <label style="text-align: left" class="control-label col-lg-5 col-lg-offset-1" for="textinput">Ajouter une matière à facturer</label>
                                      <div class="col-lg-2 col-lg-pull-1">
                                          <select type="text" style="text-transform: uppercase" class="form-control" name="codematiere3" required="">
                                                <?php
                                                $bddMatiere = listeMatiere();
                                                // récupération des valeurs de la colonne CodeMatiere de matieres
                                                $matieres = array_column($bddMatiere, 'CodeMatiere');
                                                // Tri alphabétique de la liste
                                                $nomsArrayObject = new ArrayObject($matieres);
                                                $nomsArrayObject->asort();
                                                // Boucle d'affichage
                                                    foreach ($nomsArrayObject as $matiere){?>
                                                    <option value="<?php echo $matiere; ?>">
                                                    <?php if(($_SESSION["codeMat1"] != $matiere) && ($_SESSION["codeMat2"] != $matiere)){echo $matiere;} ?>
                                                    </option>                                    
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <br>
                            
                            <!--facturer/annuler-->   
                            <div class="row">
                                <div class="col-lg-3 col-lg-offset-3"> 
                                    <button type="submit" name="annuler" class="btn btn-default">Annuler</button>                            
                                </div>
                                <div class="col-lg-3 ">                                       
                                    <button type="submit" name="valider" class="btn btn-primary">Valider</button>                            
                                </div>                                
                            </div>                           
                        </div>
                    </form>
                </div>
            </div>  <!-- row -->  
            <br>
        </div><!-- cont -->
            
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

