<?php
    session_start();
    include_once 'gestionBase.php';   
    $pdo = gestionnaireDeConnexion();
    
    if(isset($_GET["idS"]) && isset($_GET["nom"])){
        $codeU_Session = $_GET["idS"];
        $nomT = $_GET['nom'];
    }else{
        echo 'Erreur';
    }
    
    //Requete bdd pour pré-remplir les champs
               
    $req = $pdo->query('SELECT * FROM utilisateurs WHERE Nom="' .$nomT.'";');        
    $bdd = $req->fetch();
    
    $_SESSION["_UcodeU"] = $bdd["codeUtilisateur"];
    $_SESSION["_Unom"] = $bdd["Nom"];
    $_SESSION["_Uprenom"] = $bdd["Prenom"];
    $DateDeN = $bdd["DateDeNaissance"];
    $_SESSION["_UdateDeNaissance"] = modulerDate($DateDeN);
    $_SESSION["_Uadmin"] = $bdd["Administrateur"];
    $clefA = $bdd["Clef_Activation"];
    
    $req->closeCursor();
    
  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion utilisateur - Pesage</title>        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <br>
            
            <!-- page de gestion utilisateurs -->
            
            <div class="row">                  
                <div class="col-lg-offset-4 col-lg-4">
                    <form class="form-horizontal" role="form" method="post" action="gestionUtilisateurs.traitement.php?idS=<?php echo $codeU_Session;?>">
                      <fieldset>

                      <!-- Nom du formulaire -->
                      <legend>Gérer l'utilisateur</legend>
                      <br>

                      <!-- Code utilisateur-->
                      <div class="form-group">
                          <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Code utilisateur</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="codeU" value="<?php echo $_SESSION["_UcodeU"];?>" readonly="">
                        </div>
                      </div>

                      <!-- Nom-->
                      <div class="form-group">
                        <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Nom</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="nomU" value="<?php echo $_SESSION["_Unom"];?>" autocomplete="off" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèùa-zA-Z\s]{2,30}$">
                        </div>
                      </div> 
                      
                      <!-- Prénom-->
                      <div class="form-group">
                        <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Prénom</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="prenomU" value="<?php echo $_SESSION["_Uprenom"];?>" autocomplete="off" pattern="^[-'çÈÉÊËÔÖÙÛÜÀÂÄÌÍÎÏéïîöôàäêâüûèù0-9a-zA-Z\s]{3,30}$">
                        </div>
                      </div>
                      
                      <!-- Date de naissance-->
                      <div class="form-group">
                        <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Date de naissance</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="dateNaissanceU" value="<?php echo $_SESSION["_UdateDeNaissance"];?>" autocomplete="off" pattern="\d{1,2}-\d{1,2}-\d{4}">
                        </div>
                      </div>
                      
                      <!-- Code d'activation-->
                      <div class="form-group">
                          <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Clef d'activation</label>
                        <div class="col-lg-7">
                            <input type="text" id="hidkey" class="form-control" name="clefA" value="<?php echo $clefA;?>" readonly="">
                        </div>
                      </div>
                      
                      <!-- Sélection des droits de l'utilisateur-->
                        <div class="form-group">
                            <label class="col-lg-5 control-label" for="textinput"></label> <br>                           
                                <input type="checkbox" value="oui" name="reinitialiser"> Réinitiliser le mot de passe de cet utilisateur <br>
                                <input type="hidden" value="NON" name="droitAdmin"> <!-- pour retourner une valeur si case non cochée de droitAdmin-->
                                <input type="checkbox" value="OUI" name="droitAdmin" <?php if($_SESSION["_Uadmin"] == "OUI"){echo "checked='checked'";}?>> Droit administrateur <br>
                        </div>

                      <!-- Validation-->
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
            </div><!-- /.row -->
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
