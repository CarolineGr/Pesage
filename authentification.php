<?php
    include_once 'gestionBase.php';    

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Identification - Pesage</title>
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
                    <form class="form-horizontal" method="post" action="authentification.traitement.php" >
                        <fieldset>
                            <legend>Entrez vos identifiants</legend>
                            <br>
                            
                            <div class="row">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <!-- saisie du code utilisateur -->
                                    <div class="form-group">
                                        <label for="codeU">Code utilisateur</label>
                                        <input class="form-control" style="text-transform: uppercase" type="text" name="codeU_Session" id="codeU" maxlength="10" pattern="^[0-9a-zA-Z\s]{2,10}$" autocomplete="off" required="">
                                    </div>

                                    <!-- saisie du mot de passe -->
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input class="form-control" type="password" name="password" id="password" maxlength="70" autocomplete="off" pattern="^[-,'°çéèù0-9a-zA-Z\s]{3,45}$">
                                    </div>                    

                                    <button type="submit" class="btn btn-primary">Valider</button>

                                    <div class="form-group">
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