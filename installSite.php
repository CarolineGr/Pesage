<?php
    include_once 'gestionBase.php';
    
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'Erreur';
    }
    
    $bddSite = listeSite();      
?>
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
                    <form class="form-horizontal" method="post" action="installSite.traitement.php?idS=<?php echo $codeU_Session;?>">
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
                                        <!-- Extraction et affichage des noms de la bdd -->
                                        <?php
                                            // récupération des valeurs de la colonne 'RaisonSociale"
                                            $nomDesSites = array_column($bddSite, 'RaisonSociale');
                                            // Tri alphabétique de la liste
                                            $nomsArrayObject = new ArrayObject($nomDesSites);
                                            $nomsArrayObject->asort();
                                            // END - tri
                                                foreach ($nomsArrayObject as $site){?>
                                                <option  value="<?php echo $site;?>"><?php echo $site;?></option>                                    
                                        <?php }
                                        ?>
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