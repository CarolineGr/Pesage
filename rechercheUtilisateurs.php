<?php session_start();
    include_once 'gestionBase.php';
    $pdo = gestionnaireDeConnexion();
    
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'Erreur';
    }
  
    $bdd = listeUtilisateurs();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recherche utilisateur Pesage</title>        
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
                    <form class="form-horizontal" role="form" method="post" action="rechercheUtilisateurs.php?idS=<?php echo $codeU_Session;?>">
                    <fieldset>

                      <!-- Nom du formulaire -->
                      <legend>Consulter un utilisateur</legend>
                      <br>
                      
                    <!-- Nom-->
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="textinput">Nom</label>
                        <div class="col-lg-7">
                            <select type="text" name="nom" class="form-control">
                                <!-- Extraction et affichage des noms de la bdd -->
                                <?php
                                // récupération des valeurs de la colonne 'Nom"
                                $noms = array_column($bdd, 'Nom');
                                // Tri alphabétique de la liste
                                $nomsArrayObject = new ArrayObject($noms);
                                $nomsArrayObject->asort();
                                // END - tri
                                    foreach ($nomsArrayObject as $nom){?>
                                    <option value="<?php echo $nom;?>">
                                    <?php echo $nom;?>
                                    </option>                                    
                                <?php } 
                                ?>
                            </select> 
                        </div>
                      </div>                     

                      <!-- Validation-->
                      <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-4">
                          <div class="pull-right">                            
                            <button type="submit" class="btn btn-primary">Chercher</button>
                          </div>
                        </div>
                      </div>

                    </fieldset>
                  </form>
                </div>
            

                <!-- Affichage au 2ème chargement de la page uniquement -->
                <?php if(!empty($_POST['nom'])){  ?>      
                    <div class="col-lg-offset-5 col-lg-3">                
                        <br>
                        <br>
                        <?php
                        //Requete bdd pour pré-remplir les champs
                        $nomT = $_POST["nom"];

                        $req = $pdo->query('SELECT * FROM utilisateurs WHERE Nom="' .$nomT.'";');        
                        $bdd = $req->fetch();

                        $nom = $bdd["Nom"];
                        $prenom = $bdd["Prenom"];


                        $req->closeCursor();
                        ?>

                        <!-- Affichage des nom et prénom avec lien vers la page de modification -->
                        <div class="well col-lg-pull-1 col-lg-10" style="text-align: center">
                            <a href="gestionUtilisateurs.php?idS=<?php echo $codeU_Session;?>&nom=<?php echo $nom; ?>"><?php echo $nom . ' ' . $prenom; ?></a>                
                        </div>
                    </div>
                <?php  } ?>   
            </div>
        </div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
