<?php 
    session_start();
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();
    
    if(isset($_GET["codeTrans"]) && isset($_GET["idS"])){
        $codeTransporteur = $_GET["codeTrans"];
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    
    // Connexion pour récupérer les infos du transporteur dans la bdd
    $req = $pdo->query('SELECT * FROM transporteurs WHERE CodeTransporteur="'.$codeTransporteur .'"');        
    $bdd = $req->fetch();
    
    $_SESSION["idT"] = $bdd["id_Transporteur"];
    $_SESSION["_TcodeT"] = $bdd["CodeTransporteur"];
    $_SESSION["_TraiSoc"] = $bdd["RaisonSociale"];
    $_SESSION["_Tad1"] = $bdd["Adresse1"];
    $_SESSION["_Tad2"] = $bdd["Adresse2"];
    $_SESSION["_Tad3"] = $bdd["Adresse3"];
    $_SESSION["_Tcp"] = $bdd["CodePostal"];
    $_SESSION["_Tville"] = $bdd["Ville"];
    $_SESSION["_Tpays"] = $bdd["Pays"];
    $_SESSION["_Ttel"] = $bdd["Telephone"];
    $_SESSION["_Temail"] = $bdd["Mail"];
    $_SESSION["_Tcontact"] = $bdd["Contact"];
    
    $req->closeCursor();
      
   // connexion pour récupérer les immatriculations associées au transporteur présélectionné
    try{
        $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }            
    catch (Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    } 
   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion Transporteurs - Pesage</title>
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
                    <form class="form-horizontal" role="form" method="post" action="gestionTransporteurs.traitement.php?idS=<?php echo $codeU_Session; ?>">
                        <fieldset>

                        <!-- Nom du formulaire -->
                        <legend>Gérer le Transporteur</legend>
                        <br>
                    
                        <div class="row">
                            <!--1ère colonne-->
                            <div class="col-lg-4"
                                 
                                <!-- Code client -->
                                <div class="form-group">
                                    <label style="text-align: left" class="control-label col-lg-6" for="textinput">Code transporteur</label>
                                    <div class="col-lg-6">
                                      <input type="text" class="form-control" name="codeT" value="<?php echo $_SESSION["_TcodeT"];?>" readonly="">
                                    </div>
                                </div>

                                <!-- Raison sociale-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Raison sociale</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="raiSoc" value="<?php echo $_SESSION["_TraiSoc"];?>" pattern="^[-,°çéèù0-9a-zA-Z\s]{3,30}$">
                                  </div>
                                </div> 

                                <!-- Adresse 1-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Adresse 1</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="ad1" value="<?php echo $_SESSION["_Tad1"];?>" pattern="^[-,°çéèù0-9a-zA-Z\s]{3,30}$">
                                  </div>
                                </div>

                                <!-- Adresse 2-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Adresse 2</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="ad2" value="<?php echo $_SESSION["_Tad2"];?>" pattern="^[-,°çéèù0-9a-zA-Z\s]{0,30}$">
                                  </div>
                                </div>

                                <!-- Adresse 3-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Adresse 3</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="ad3" value="<?php echo $_SESSION["_Tad3"];?>" pattern="^[-,°çéèù0-9a-zA-Z\s]{0,30}$">
                                  </div>
                                </div>

                                <!-- Code Postal-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-6" for="textinput">Code postal</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="cp" value="<?php echo $_SESSION["_Tcp"];?>" pattern="^[0-9]{1,10}$">
                                  </div>
                                </div>
                                    </div>
                                
                            <!-- 2ème colonne-->
                            <div class="col-lg-4">
                                <!-- Ville-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-3" for="textinput">Ville</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="ville" value="<?php echo $_SESSION["_Tville"];?>" pattern="^[-çéèùa-zA-Z\s]{1,30}$">
                                  </div>
                                </div>

                                <!-- Pays -->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-3" for="textinput">Pays</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="pays" value="<?php echo $_SESSION["_Tpays"];?>" pattern="^[-çéèùa-zA-Z\s]{2,30}$">
                                  </div>
                                </div>

                                <!-- Tel-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-3" for="textinput">Téléphone</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="tel" value="<?php echo $_SESSION["_Ttel"];?>" pattern="^[0-9]{10,15}$">
                                  </div>
                                </div>

                                <!-- Email-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-3" for="textinput">Email</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="mail" value="<?php echo $_SESSION["_Temail"];?>" maxlength="30">
                                  </div>
                                </div>

                                <!-- Contact-->
                                <div class="form-group">
                                  <label style="text-align: left" class="control-label col-lg-3" for="textinput">Contact</label>
                                  <div class="col-lg-6">
                                      <input type="text" class="form-control" name="contact" value="<?php echo $_SESSION["_Tcontact"];?>" pattern="^[-çéèùa-zA-Z\s]{3,30}$">
                                  </div>
                                </div>

                            </div>
                            
                            <!--3ème colonne-->
                            <div class="col-lg-4">
                                <!-- Liste des immatriculations associées au transporteur -->           
                                <table>
                                    <tr class="trh1">
                                        <td class="td1"> Immatriculations </td>                           
                                    </tr>
                                </table>
                                <div class="scroll">
                                    <table id='tabImmat'>                                        
                                        <!-- récupération des valeurs de la colonne "Immatriculation" de la bdd -->
                                        <?php 
                                        $sql = $pdo->query("SELECT * FROM immatriculations WHERE id_transporteur ='".$_SESSION["idT"]. "' ORDER BY Immatriculation");          
                                        $compteur = 0;
                                        while($immats = $sql->fetch()){?>  
                                        <tr id="trb">
                                            <td class="td1"><?php echo $immats["Immatriculation"]; $compteur++;?></td>
                                        </tr>
                                        <?php                      
                                        }
                                        // en fonction de la longueur du tableau, affichage de la bordure du bas ou non
                                        if($compteur>5){
                                            echo "<style type='text/css'> .scroll{border-bottom: solid 1px black;} </style>";
                                        }
                                        $conn = null;
                                        ?>
                                    </table>                                    
                                </div>
                            </div>
            </div>
                            
            <div class="row">
                            <!-- Validation-->
                            <div class="pull-center">
                                <div class="col-lg-push-4 form-group col-lg-5 ">
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
            </div><!-- /.row -->
            
            
 
            <br>
            <br>
            <br>
        </div>
            
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>