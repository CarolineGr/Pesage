<?php
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();
    
    // récupération du code utilisateur de la session en cours
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "Erreur";
    }
    
?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="UTF-8">
        <title>Facture périodique - Pesage</title>
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
                    <form class="form-horizontal" role="form" method="POST" action="factureMensuelle.traitement.php?idS=<?php echo $codeU_Session;?>">
                        <div class=" col-lg-offset-1 col-lg-10">
                            <fieldset>
                            <legend>Facture périodique</legend>
                            <br>
                            
                            <div class="row">
                                <!--1ère colonne-->
                                <div class="col-lg-6">

                                    <!-- date de début de la sélection-->
                                    <div class="form-group">
                                      <label style="text-align: left" class="control-label col-lg-5" for="textinput">Date de début</label>
                                      <div class="col-lg-7 col-lg-pull-1">
                                          <input type="date" placeholder="Format JJ-MM-AAAA" class="form-control" name="dateD">
                                      </div>
                                    </div>
                                    
                                    <!-- heure de début de sélection -->
                                    <div class="form-group">
                                        <label style="text-align: left" class="control-label col-lg-5" for="textinput">Heure de début</label>
                                        <div class="col-lg-7 col-lg-pull-1">
                                            <select type="time" class="form-control" name="heureD">
                                                <option value=""></option>
                                                <option value="00:00:00">00:00</option>
                                                <option value="01:00:00">01:00</option>
                                                <option value="02:00:00">02:00</option>
                                                <option value="03:00:00">03:00</option>
                                                <option value="04:00:00">04:00</option>
                                                <option value="05:00:00">05:00</option>
                                                <option value="06:00:00">06:00</option>
                                                <option value="07:00:00">07:00</option>
                                                <option value="08:00:00">08:00</option>
                                                <option value="09:00:00">09:00</option>
                                                <option value="10:00:00">10:00</option>
                                                <option value="11:00:00">11:00</option>
                                                <option value="12:00:00">12:00</option>
                                                <option value="13:00:00">13:00</option>
                                                <option value="14:00:00">14:00</option>
                                                <option value="15:00:00">15:00</option>
                                                <option value="16:00:00">16:00</option>
                                                <option value="17:00:00">17:00</option>
                                                <option value="18:00:00">18:00</option>
                                                <option value="19:00:00">19:00</option>
                                                <option value="20:00:00">20:00</option>
                                                <option value="21:00:00">21:00</option>
                                                <option value="22:00:00">22:00</option>
                                                <option value="23:00:00">23:00</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                </div>

                                <!-- 2ème colonne-->
                                <div class="col-lg-6">

                                    <!-- date de fin de la sélection-->
                                    <div class="form-group">
                                      <label style="text-align: left" class="control-label col-lg-5" for="textinput">Date de fin</label>
                                      <div class="col-lg-7 col-lg-pull-1">
                                          <input type="date" placeholder="Format JJ-MM-AAAA" class="form-control" name="dateF">
                                      </div>
                                    </div>
                                    
                                    <!-- heure de fin de sélection -->
                                    <div class="form-group">
                                        <label style="text-align: left" class="control-label col-lg-5" for="textinput">Heure de fin</label>
                                        <div class="col-lg-7 col-lg-pull-1">
                                            <select type="time" class="form-control" name="heureF">
                                                <option value=""></option>
                                                <option value="00:00:00">00:00</option>
                                                <option value="01:00:00">01:00</option>
                                                <option value="02:00:00">02:00</option>
                                                <option value="03:00:00">03:00</option>
                                                <option value="04:00:00">04:00</option>
                                                <option value="05:00:00">05:00</option>
                                                <option value="06:00:00">06:00</option>
                                                <option value="07:00:00">07:00</option>
                                                <option value="08:00:00">08:00</option>
                                                <option value="09:00:00">09:00</option>
                                                <option value="10:00:00">10:00</option>
                                                <option value="11:00:00">11:00</option>
                                                <option value="12:00:00">12:00</option>
                                                <option value="13:00:00">13:00</option>
                                                <option value="14:00:00">14:00</option>
                                                <option value="15:00:00">15:00</option>
                                                <option value="16:00:00">16:00</option>
                                                <option value="17:00:00">17:00</option>
                                                <option value="18:00:00">18:00</option>
                                                <option value="19:00:00">19:00</option>
                                                <option value="20:00:00">20:00</option>
                                                <option value="21:00:00">21:00</option>
                                                <option value="22:00:00">22:00</option>
                                                <option value="23:00:00">23:00</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <br>
                            <br>
                            
                            <div class="row">
                                <!--1ère colonne-->
                                <div class="col-lg-6">
                                    <!-- Client -->
                                    <div class="form-group">
                                      <label style="text-align: left" class="control-label col-lg-5" for="textinput">Client</label>
                                      <div class="col-lg-7 col-lg-pull-1">
                                            <select type="text" class="form-control" name="client">
                                                <?php
                                                $bddClient = listeClient();
                                                // récupération des valeurs de la colonne raison sociale des Clients
                                                $raiSocC = array_column($bddClient, 'RaisonSociale');
                                                // Tri alphabétique de la liste
                                                $nomsArrayObject = new ArrayObject($raiSocC);
                                                $nomsArrayObject->asort();
                                                // Boucle d'affichage
                                                    foreach ($nomsArrayObject as $raiSoc){?>
                                                    <option value="<?php echo $raiSoc; ?>">
                                                    <?php echo $raiSoc; ?>
                                                    </option>                                    
                                                <?php } 
                                                ?>
                                            </select> 
                                      </div>
                                    </div>                                 
                                </div>                            

                                <!--2eme colonne-->
                                <div class="col-lg-6">                                     
                                    <!-- Code matière -->
                                    <div class="form-group">
                                      <label style="text-align: left" class="control-label col-lg-5" for="textinput">Code matière</label>
                                      <div class="col-lg-7 col-lg-pull-1">
                                            <select type="text" class="form-control" name="codeMat">
                                                <?php
                                                $bddMatiere = listeMatiere();
                                                // récupération des valeurs de la colonne Matiere de matières
                                                $matieres = array_column($bddMatiere, 'CodeMatiere');
                                                // Tri alphabétique de la liste
                                                $nomsArrayObject = new ArrayObject($matieres);
                                                $nomsArrayObject->asort();
                                                // Boucle d'affichage
                                                    foreach ($nomsArrayObject as $matiere){?>
                                                    <option value="<?php echo $matiere; ?>">
                                                    <?php echo $matiere; ?>
                                                    </option>                                    
                                                <?php } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>                                                                   
                                </div>
                            </div>
                            
                            <!--validation/annulation-->   
                            <div class="col-lg-5 col-lg-offset-4">
                                <div class="col-lg-5"> 
                                      <button type="submit" name="annuler" class="btn btn-default">Annuler</button>                            
                                </div>
                                <div class="col-lg-5">
                                      <button type="submit" name="valider" class="btn btn-primary">Valider</button>
                                </div>
                                
                            </div>                           
                        </div>
                    </form>
                </div>
            </div>  <!-- row -->  
            <br>
        </div><!-- cont -->
            
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>


