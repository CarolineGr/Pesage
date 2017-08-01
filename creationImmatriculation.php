<?php
    include_once 'gestionBase.php';
    
    // récupération du code utilisateur de la session en cours
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    
    $bddTransp = listeTransporteurs();  
?>
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
                    <form class="form-horizontal" method="post" action="creationImmatriculation.traitement.php?idS=<?php echo $codeU_Session;?>">
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
                                        <!-- Extraction et affichage des noms de la bdd -->
                                        <?php
                                            // récupération des valeurs de la colonne 'RaisonSociale"
                                            $nomDesTransp = array_column($bddTransp, 'RaisonSociale');
                                            // Tri alphabétique de la liste
                                            $nomsArrayObject = new ArrayObject($nomDesTransp);
                                            $nomsArrayObject->asort();
                                            // END - tri
                                                foreach ($nomsArrayObject as $transp){?>
                                                <option  value="<?php echo $transp;?>"><?php echo $transp;?></option>                                    
                                        <?php }
                                        ?>
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