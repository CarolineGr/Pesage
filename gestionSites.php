<?php  
    session_start();
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();
    
    if(isset($_GET["codeSite"]) && isset($_GET["idS"])){
        $codeSite = $_GET["codeSite"];
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    
    // Connexion pour récupérer les info client dans la bdd
    $req = $pdo->query('SELECT * FROM site WHERE CodeSite="' .$codeSite. '"');        
    $bdd = $req->fetch();
    
    $_SESSION["_ScodeS"] = $bdd["CodeSite"];
    $_SESSION["_SraiSoc"] = $bdd["RaisonSociale"];
    $_SESSION["_Sad1"] = $bdd["Adresse1"];
    $_SESSION["_Sad2"] = $bdd["Adresse2"];
    $_SESSION["_Sad3"] = $bdd["Adresse3"];
    $_SESSION["_Scp"] = $bdd["CodePostal"];
    $_SESSION["_Sville"] = $bdd["Ville"];
    $_SESSION["_Spays"] = $bdd["Pays"];
    $_SESSION["_Stel"] = $bdd["Telephone"];
    $_SESSION["_Smail"] = $bdd["Mail"];
    $_SESSION["_Scontact"] = $bdd["Contact"]; 
    
    $req->closeCursor();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion Site - Pesage</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <br>
            
            <!-- page de gestion clients -->            
            <div class="row">                  
                <div class="col-lg-10 col-lg-offset-1">
                    <form class="form-horizontal" role="form" method="post" action="gestionSites.traitement.php?idS=<?php echo $codeU_Session; ?>">
                    <fieldset>

                      <!-- Nom du formulaire -->
                      <legend>Gérer le site</legend>
                      <br>

                      <!-- Code client -->
                      <div class="form-group col-lg-6">
                          <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Code site</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="codeS" value="<?php echo $_SESSION["_ScodeS"];?>" readonly="">
                        </div>
                      </div>

                      <!-- Raison sociale-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Raison sociale</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="raiSoc" value="<?php echo $_SESSION["_SraiSoc"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{3,30}$">
                        </div>
                      </div> 
                      
                      <!-- Adresse 1-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Adresse 1</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="ad1" value="<?php echo $_SESSION["_Sad1"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{3,30}$">
                        </div>
                      </div>
                      
                      <!-- Adresse 2-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Adresse 2</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="ad2" value="<?php echo $_SESSION["_Sad2"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{0,30}$">
                        </div>
                      </div>
                      
                      <!-- Adresse 3-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Adresse 3</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="ad3" value="<?php echo $_SESSION["_Sad3"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{0,30}$">
                        </div>
                      </div>
                      
                      <!-- Code Postal-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Code postal</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="cp" value="<?php echo $_SESSION["_Scp"];?>" pattern="^[0-9]{2,10}$">
                        </div>
                      </div>
                      
                      <!-- Ville-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Ville</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="ville" value="<?php echo $_SESSION["_Sville"];?>" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèùa-zA-Z\s]{1,30}$">
                        </div>
                      </div>
                      
                      <!-- Pays -->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Pays</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="pays" value="<?php echo $_SESSION["_Spays"];?>" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèùa-zA-Z\s]{1,30}$">
                        </div>
                      </div>
                      
                      <!-- tel-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Téléphone</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="tel" value="<?php echo $_SESSION["_Stel"];?>" pattern="^[0-9]{10,15}$">
                        </div>
                      </div>
                      
                      <!-- Email-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Email</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="mail" value="<?php echo $_SESSION["_Smail"];?>" maxlength="30">
                        </div>
                      </div>
                      
                      <!-- Contact-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Contact</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" style="text-transform: uppercase" name="contact" value="<?php echo $_SESSION["_Scontact"];?>" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèùa-zA-Z\s]{3,30}$">
                        </div>
                      </div>
                </div>
                
                <!-- Validation-->
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
            </div><!-- /.row --> 
        </div> <!-- container -->
            
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>