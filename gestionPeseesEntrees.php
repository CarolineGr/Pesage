<?php
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();   
    
    // récupération du code utilisateur
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'erreur';
    }
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
                <div class="col-lg-10 col-lg-offset-1">
                    <form class="form-horizontal" role="form" method="post" action="gestionPeseesEntrees.traitement.php?idS=<?php echo $codeU_Session;?>">
                        <fieldset>
                        <legend>Pesées à l'entrée</legend>
                        <br>
                        
                        <!-- liste selection Clients -->
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Client</label>
                            <div class="col-lg-7">
                                <select type="text" name="client" class="form-control">
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
                        
                        <!-- liste selection immatriculations -->
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Immatriculation</label>
                            <div class="col-lg-7">
                                <select type="text" name="immat" class="form-control">
                                <?php
                                $bddImmat = listeImmatriculation();
                                // récupération des valeurs de la colonne raison sociale des Clients
                                $immats = array_column($bddImmat, 'Immatriculation');
                                // Tri alphabétique de la liste
                                $nomsArrayObject = new ArrayObject($immats);
                                $nomsArrayObject->asort();
                                // Boucle d'affichage
                                    foreach ($nomsArrayObject as $immat){?>
                                    <option value="<?php echo $immat; ?>">
                                    <?php echo $immat; ?>
                                    </option>                                    
                                <?php } 
                                ?>
                                </select> 
                            </div>
                        </div>                        
                        
                        <!-- liste selection matière -->
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="textinput">Matière</label>
                            <div class="col-lg-7">
                                <select style="text-transform: uppercase" type="text" name="matiere" class="form-control">
                                <?php
                                $bddMatiere = listeMatiere();
                                // récupération des valeurs de la colonne raison sociale des Clients
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
                        <div class="form-group col-lg-6">
                            <label style="text-align: left" class="col-lg-4 control-label" for="poidsE">Poids d'entrée</label>
                            <div class="col-lg-7">
                            <input class="form-control" style="text-transform: uppercase" type="text" name="poidsE" id="poidsE" pattern="^[.0-9\s]{2,15}$" autocomplete="off" >
                            </div>
                        </div>
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
                        
                    </fieldset>
                </form>
                
                <!-- affichage en tableau des véhicules en cours de déchargement -->
                <div class="col-lg-offset-3">
                    <table id="entrees" border="1">                        
                        <caption>** Véhicule en cours de déchargement **</caption>
                        <thead>
                        <tr>
                            <th>ID pesée</th>
                            <th>ID utilisateur</th>
                            <th>Date</th>
                            <th>Immatriculation</th>
                            <th>Matière</th>
                            <th>Poids</th>                             
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $sql = $pdo->prepare("SELECT id_pesees, idUtilisateurEntree, DateEntree, PoidsEntree, Immatriculation, CodeMatiere FROM pesees;");
                        $sql->execute();
                        
                        while($bdd = $sql->fetch()){
                            $idPesee = $bdd["id_pesees"];
                            $idUtiEn = $bdd["idUtilisateurEntree"];
                            $dateE = $bdd["DateEntree"];
                            $poidsE = $bdd["PoidsEntree"];
                            $immat = $bdd["Immatriculation"];
                            $cMat = $bdd["CodeMatiere"]; 
                        ?>
                        <tr>
                            <td><a href="gestionPeseesSortie.php?idS=<?php echo $codeU_Session;?>&idP=<?php echo $idPesee; ?>"><?php echo $idPesee; ?></a></td>
                            <td><?php echo $idUtiEn; ?></td>
                            <td><?php echo $dateE; ?></td>
                            <td><?php echo $immat; ?></td>
                            <td><?php echo $cMat; ?></td>
                            <td><?php echo $poidsE; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>                        
                    </table> 
                    <br>
                </div>     
                
            </div>          
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
