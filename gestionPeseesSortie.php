<?php
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();   
    
    // récupération du code utilisateur
    if(isset($_GET["idS"]) && isset($_GET["idP"])){
        $idPesee = $_GET["idP"];
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'erreur';
    }
    
    $sql = $pdo->prepare("SELECT * FROM pesees WHERE id_pesees='" .$idPesee. "';");
    $sql->execute();
    $bdd =$sql->fetch();
    
    $idUtiEn = $bdd["idUtilisateurEntree"];
    $codeC = $bdd["CodeClient"];
    $dateE = $bdd["DateEntree"];
    $poidsE = $bdd["PoidsEntree"];
    $immat = $bdd["Immatriculation"];
    $codeMat = $bdd["CodeMatiere"];
    $sql->closeCursor();
    
    $req = $pdo->query('SELECT * FROM utilisateurs WHERE codeUtilisateur="' .$codeU_Session.'";');        
    $bdd = $req->fetch();            
    $idUtiSo = $bdd["id_utilisateurs"];
    $req->closeCursor();
    
?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="UTF-8">
        <title>Gestion des pesées - Pesage</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/stylecss.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">  
    </head>
    <body>
        <div class="container">
            <br>
            <br>
            
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10 ">
                    <form method="POST" action="gestionPeseesSortie.traitement.php?idS=<?php echo $codeU_Session;?>&dateE=<?php echo $dateE;?>">
                        <div class=" col-lg-offset-1 col-lg-10">
                            <fieldset>
                            <legend>Pesées à la sortie</legend>
                            <br>
                            
                            <div class="row">
                            <!--1ère colonne-->
                            <div class="col-lg-6"
                                
                                <!-- ID de la pesée-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">ID pesée</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="idP" value="<?php echo $idPesee;?>" readonly="">
                                  </div>
                                </div>                                
                                
                                <!-- Utilisateur Entrée-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">ID utilisateur à l'entrée</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="idUE" value="<?php echo $idUtiEn;?>" readonly="">
                                  </div>
                                </div>
                                
                                <!-- Immatriculation -->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Immatriculation</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="immat" value="<?php echo $immat;?>" readonly="">
                                  </div>
                                </div>
                                
                                <!-- Poids d'entrée-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Poids d'entrée</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="poidsE" value="<?php echo $poidsE;?>" readonly="">
                                  </div>
                                </div>                                 
                            </div> 
                                
                            <!-- 2ème colonne-->
                            <div class="col-lg-6">
                                <!-- Code client -->
                                <div class="form-group">
                                    <label style="text-align: left" class="control-label col-lg-6" for="textinput">Code Client</label>
                                    <div class="col-lg-6">
                                      <input type="text" class="form-control" name="codeC" value="<?php echo $codeC ;?>" readonly="">
                                    </div>
                                </div>
                                
                                <!-- Utilisateur Sortie-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">ID utilisateur sortie</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="idUS" value="<?php echo $idUtiSo;?>" readonly="">
                                  </div>
                                </div>
                                
                                <!-- Code matière -->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Code matière</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="codeMat" value="<?php echo $codeMat;?>" readonly="">
                                  </div>
                                </div>
                                
                                <!-- Poids de sortie-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Poids de sortie</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="poidsS"  autocomplete="off" pattern="^[.0-9]{1,15}$">
                                  </div>
                                </div>                                
                            </div>

                            </fieldset>

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
                    </form>
                </div>
            </div>  <!-- row -->        
        </div><!-- cont -->
            
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
