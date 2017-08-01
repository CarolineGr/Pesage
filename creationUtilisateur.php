<?php
    include_once 'gestionBase.php';
    
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'erreur';
    }
    
    // generation clé d'activation
    $caracteres = array("a", "b", "c", "d", "e", "f", "A", "B", "C", "D", "E", "F", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
    $caracteres_aleatoires = array_rand($caracteres, 8);
    $clef_activation = "";                          
    foreach($caracteres_aleatoires as $i){
        $clef_activation .= $caracteres[$i];
    }  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Création d'un utilisateur - Pesage</title>
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
                    <form class="form-horizontal" method="post" action="creationUtilisateur.traitement.php?idS=<?php echo $codeU_Session;?>">
                        <fieldset>
                            <legend>Créer un nouvel utilisateur</legend>
                            <br>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="codeU">Code utilisateur</label>
                                <div class="col-lg-7">
                                    <input class="form-control" style="text-transform: uppercase" type="text" name="codeU" id="codeU" autocomplete="off" pattern="^[0-9a-zA-Z\s]{2,10}$">
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">                        
                                <label style="text-align: left" class="col-lg-5 control-label" for="nom">Nom</label>
                                <div class="col-lg-7">
                                    <input class="form-control" style="text-transform: uppercase" type="text" name="nom" id="nom" autocomplete="off" pattern="^[-çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèù'a-zA-Z\s]{2,30}$">                
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="prenom">Prénom</label>
                                <div class="col-lg-7">
                                    <input class="form-control" style="text-transform: uppercase" type="text" name="prenom" id="prenom" autocomplete="off" pattern="^[-çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèù'0-9a-zA-Z\s]{3,30}$">                
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="dateNaissance">Date de naissance</label>
                                <div class="col-lg-7">
                                    <input class="form-control" type="text" name="dateNaissance" placeholder="Format : JJ-MM-AAAA" pattern="\d{1,2}-\d{1,2}-\d{4}" class="datepicker" id="dateNaissance" autocomplete="off">                
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label style="text-align: left" class="col-lg-5 control-label" for="password">Clef d'activation</label>
                                <div class="col-lg-7">
                                    <input class="form-control" type="text" name="password" id="password" value="<?php echo $clef_activation; ?>" readonly="">
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-12"><br></div>
                            </div>
                            
                            <div class="row">
                                <div class="pull-center">
                                    <span class="input-group-addon">
                                        <div class="radio">
                                            <p>Droit d'administrateur</p>
                                            <label class="choix"><input type="radio" name="admin" value="NON" checked=""> Non</label>
                                            <label class="choix"><input type="radio" name="admin" value="OUI"> Oui</label>                              
                                        </div> 
                                    </span>
                                </div>
                            </div>                            
                
                            <div class="row">                              
                                <div class="pull-center">
                                    <div class="form-group col-lg-push-4 col-lg-6">
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
                </div> <!-- col-->
            </div> <!-- row-->         
        </div> <!-- container-->
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>