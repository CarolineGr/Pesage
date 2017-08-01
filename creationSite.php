<?php
    include_once 'gestionBase.php';
    
    // récupération du code utilisateur de la session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'erreur';
    }  
?>
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
                    <form class="form-horizontal" role="form" method="post" action="creationSite.traitement.php?idS=<?php echo $codeU_Session;?>">
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
                                <input class="form-control" style="text-transform: uppercase" type="text" name="raiSoc" id="raiSoc" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèù0-9a-zA-Z\s]{3,30}$" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="adresse1">Adresse 1</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="adresse1" id="adresse1" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèù0-9a-zA-Z\s]{3,30}$" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="adresse2">Adresse 2</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="adresse2" id="adresse2" placeholder="facultatif" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèù0-9a-zA-Z\s]{3,30}$" autocomplete="off" >
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="adresse3">Adresse 3</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="adresse3" id="adresse3" placeholder="facultatif" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèù0-9a-zA-Z\s]{3,30}$" autocomplete="off" >
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
                                <input class="form-control" style="text-transform: uppercase" type="text" name="ville" id="ville" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèùa-zA-Z\s]{1,30}$" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="pays">Pays</label>
                            <div class="col-lg-7">
                                <input class="form-control" style="text-transform: uppercase" type="text" name="pays" id="pays" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâäüûèùa-zA-Z\s]{1,30}$" autocomplete="off">
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
                                <input class="form-control" style="text-transform: uppercase" type="text" name="contact" id="contact" placeholder="NOM Prénom" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôäàêâüûèùa-zA-Z\s]{3,30}$" autocomplete="off">
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
