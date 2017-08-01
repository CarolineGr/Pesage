<?php
    include_once 'gestionBase.php';
    
    // code utilisateur de la session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'Erreur';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recherche dans la base de données Sites - Pesage</title>
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
                    <form class="form-horizontal" method="post" action="rechercheSites.traitement.php?idS=<?php echo $codeU_Session; ?>">
                        <fieldset>
                            <legend>Recherche d'un site</legend>
                            <br>
                            
                            <div class="form-group">
                                <label for="codeS">Code site</label>
                                <input class="form-control" style="text-transform: uppercase" type="text" name="codeS" id="codeS" autocomplete="off" pattern="^[0-9a-zA-Z\s]{0,10}$">
                            </div>
                                                                                    
                            <div class="form-group">
                                <label for="raiSoc">Raison sociale</label>
                                <input class="form-control" style="text-transform: uppercase" type="text" name="raiSoc" id="raiSoc" autocomplete="off" pattern="^[-a-zA-Z,0-9\s]{0,30}$">                
                            </div>
                            
                            <div class="form-group">
                                <label for="cp">Code postal</label>
                                <input class="form-control" type="text" name="cp" id="cp" pattern="^[0-9]{0,10}$" autocomplete="off" >
                            </div>
                            
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input class="form-control" style="text-transform: uppercase" type="text" name="ville" id="ville" pattern="^[-a-zA-Z\s]{0,30}$" autocomplete="off" >
                            </div>                            
                            
                            <div class="form-group">                        
                                <label for="contact">Contact</label>
                                <input class="form-control" style="text-transform: uppercase" type="text" name="contact" id="contact" autocomplete="off" pattern="^[-'a-zA-Z\s]{0,45}$">                
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-lg-push-2 col-lg-11">
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
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>