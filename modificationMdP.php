<?php  
    include_once 'gestionBase.php';   
    
    $pdo = gestionnaireDeConnexion();
    
    // code utilisateur de la session 
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "erreur";
    }
    
    // requète pour pré-remplir les premiers champs
    $req = $pdo->query('select * from utilisateurs where codeUtilisateur="'.$codeU_Session .'"');
    
    $bdd = $req->fetch();
    $codeUtilisateur = $bdd["codeUtilisateur"];
    $nom = $bdd["Nom"];
    $prenom = $bdd["Prenom"];
    $DateNaissance = $bdd["DateDeNaissance"];
    $DateDeNaissance = modulerDate($DateNaissance);
    $admin = $bdd["Administrateur"]; 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification mot de passe - Pesage</title>        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">          
            <br>
            <br>
            
            <!-- formulaire pré-rempli pour modifier le mdp -->
            
            <div class="row">                  
                <div class="col-lg-offset-4 col-lg-4">
                    <form class="form-horizontal" role="form" method="post" action="modificationMdP.traitement.php">
                        <fieldset>

                            <!-- Nom du formulaire -->
                            <legend>Modifier le mot de passe</legend>

                            <!-- Code utilisateur-->
                            <div class="form-group">
                                <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Code utilisateur</label>
                              <div class="col-lg-7">
                                  <input type="text" class="form-control" name="codeU" value="<?php echo $codeUtilisateur; ?>"  readonly="">
                              </div>
                            </div>

                            <!-- Nom-->
                            <div class="form-group">
                              <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Nom</label>
                              <div class="col-lg-7">
                                  <input type="text" class="form-control" value="<?php echo $nom; ?>" readonly="">
                              </div>
                            </div> 
                      
                            <!-- Prénom-->
                            <div class="form-group">
                              <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Prénom</label>
                              <div class="col-lg-7">
                                  <input type="text" class="form-control" value="<?php echo $prenom; ?>" readonly="">
                              </div>
                            </div>

                            <!-- Date de naissance -->
                            <div class="form-group">
                              <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Date de naissance</label>
                              <div class="col-lg-7">
                                  <input type="text" class="form-control" value="<?php echo $DateDeNaissance; ?>" readonly="">
                              </div>
                            </div>

                            <!-- Mot de passe-->
                            <div class="form-group">
                              <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Mot de passe</label>
                              <div class="col-lg-7">
                                  <input type="password" class="form-control" id="textinput" name="password" pattern="^[-,'°çéèùà0-9a-zA-Z\s]{3,45}$" required=""><p class="validationMdP">
                                      <span class="invalid">Minimum 3 caractères - caractères spéciaux autorisés : -,'°çéèàù</span>
                                      <span class="valid">Votre mot de passe remplit nos conditions, merci.</span></p>
                              </div>
                            </div>

                            <!-- Confirmation du mot de passe-->
                            <div class="form-group">
                              <label style="text-align: left" class="col-lg-5 control-label" for="textinput">Confirmation du mot de passe</label>
                              <div class="col-lg-7">
                                  <input type="password" class="form-control" name="password-control" pattern="^[-,'°çéèùà0-9a-zA-Z\s]{3,45}$" required="">
                              </div>
                            </div>
                      

                            <!-- Validation-->
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
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
                    
        </div>   
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
