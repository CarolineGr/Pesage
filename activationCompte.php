<?php
    include_once 'gestionBase.php';
    
    // récupération du code utilisateur de la session en cours 
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "erreur";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Activation du compte - Pesage</title>        
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
                    <form class="form-horizontal" role="form" method="post" action="activationCompte.traitement.php?idS=<?php echo $codeU_Session; ?>">
                        <fieldset>
                            <legend>Activation du compte</legend>
                            <br>
                            
                            <div class="form-group">
                                <label for="clefA">Veuillez saisir votre clef d'activation de compte :</label>
                                <input class="form-control" type="text" name="clefA" id="clefA" pattern="^[0-9a-zA-Z\s]{1,8}$" autocomplete="off">
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-offset-1 col-lg-11">
                                    <div class="col-lg-5">
                                          <button type="submit" name="valider" class="btn btn-primary">Valider</button>
                                    </div>
                                    <div class="col-lg-5"> 
                                          <button type="submit" name="annuler" class="btn btn-default">Annuler</button>                            
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>   
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>