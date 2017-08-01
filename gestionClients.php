<?php  
    session_start();
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();
    
    if(isset($_GET["codeClient"]) && isset($_GET["idS"])){
        $codeClient = $_GET["codeClient"];
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    
    // Connexion pour récupérer les info client dans la bdd
    $req = $pdo->query('SELECT * FROM clients WHERE CodeClient="' .$codeClient. '"');        
    $bdd = $req->fetch();
    
    $_SESSION["_CcodeC"] = $bdd["CodeClient"];
    $_SESSION["_CraiSoc"] = $bdd["RaisonSociale"];
    $_SESSION["_Cad1"] = $bdd["Adresse1"];
    $_SESSION["_Cad2"] = $bdd["Adresse2"];
    $_SESSION["_Cad3"] = $bdd["Adresse3"];
    $_SESSION["_Ccp"] = $bdd["CodePostal"];
    $_SESSION["_Cville"] = $bdd["Ville"];
    $_SESSION["_Cpays"] = $bdd["Pays"];
    $_SESSION["_Ctel"] = $bdd["Telephone"];
    $_SESSION["_Cmail"] = $bdd["Mail"];
    $_SESSION["_Ccontact"] = $bdd["Contact"]; 
    
    $req->closeCursor();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion Client - Pesage</title>
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
                    <form class="form-horizontal" role="form" method="post" action="gestionClients.traitement.php?idS=<?php echo $codeU_Session; ?>">
                    <fieldset>

                      <!-- Nom du formulaire -->
                      <legend>Gérer le Client</legend>
                      <br>

                      <!-- Code client -->
                      <div class="form-group col-lg-6">
                          <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Code client</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="codeC" value="<?php echo $_SESSION["_CcodeC"];?>" readonly="">
                        </div>
                      </div>

                      <!-- Raison sociale-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Raison sociale</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="raiSoc" value="<?php echo $_SESSION["_CraiSoc"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{3,30}$">
                        </div>
                      </div> 
                      
                      <!-- Adresse 1-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Adresse 1</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="ad1" value="<?php echo $_SESSION["_Cad1"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{3,30}$">
                        </div>
                      </div>
                      
                      <!-- Adresse 2-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Adresse 2</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="ad2" value="<?php echo $_SESSION["_Cad2"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{0,30}$">
                        </div>
                      </div>
                      
                      <!-- Adresse 3-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Adresse 3</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="ad3" value="<?php echo $_SESSION["_Cad3"];?>" pattern="^[-,'°çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèù0-9a-zA-Z\s]{0,30}$">
                        </div>
                      </div>
                      
                      <!-- Code Postal-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Code postal</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="cp" value="<?php echo $_SESSION["_Ccp"];?>" pattern="^[0-9]{2,10}$">
                        </div>
                      </div>
                      
                      <!-- Ville-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Ville</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="ville" value="<?php echo $_SESSION["_Cville"];?>" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèùa-zA-Z\s]{1,30}$">
                        </div>
                      </div>
                      
                      <!-- Pays -->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Pays</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="pays" value="<?php echo $_SESSION["_Cpays"];?>" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèùa-zA-Z\s]{2,30}$">
                        </div>
                      </div>
                      
                      <!-- tel-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Téléphone</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="tel" value="<?php echo $_SESSION["_Ctel"];?>" pattern="^[0-9]{10,15}$">
                        </div>
                      </div>
                      
                      <!-- Email-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Email</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="mail" value="<?php echo $_SESSION["_Cmail"];?>" maxlength="30">
                        </div>
                      </div>
                      
                      <!-- Contact-->
                      <div class="form-group col-lg-6">
                        <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Contact</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="contact" value="<?php echo $_SESSION["_Ccontact"];?>" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàêâüûèùa-zA-Z\s]{3,30}$">
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