<?php
    session_start();
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";
    $pdo = gestionnaireDeConnexion();
    
    // variable de session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'Erreur';
    }
    
    // gestion bouton annuler
    if(isset($_POST['annuler'])){
        if(($_SESSION["_Unom"] == $_POST["nomU"]) && ($_SESSION["_Uprenom"] == $_POST["prenomU"]) && ($_SESSION["_UdateDeNaissance"] == $_POST["dateNaissanceU"]) && ($_SESSION["_Uadmin"] == $_POST["droitAdmin"]) && ($_POST["reinitialiser"] == "")){ 
            header("Location: http:\\Pesage\accueil.php?idS=$codeU_Session");
            exit();
        }else{
            ?>
            <script language="javascript">
                if(confirm("Voulez-vous quitter sans enregistrer les modifications ?")){
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                }else{
                    history.back();
                }
            </script>
            <?php
            
        }
    
    // gestion bouton valider
    }elseif (isset($_POST['valider'])){ 
        //récupération des données du formulaire
        if(isset($_POST["codeU"]) && isset($_POST["nomU"]) && isset($_POST["prenomU"]) && isset($_POST["dateNaissanceU"]) && isset($_POST["droitAdmin"]) && isset($_POST["clefA"])){
            $codeU = sansAccents($_POST["codeU"]);
            $codeU = mb_strtoupper($codeU); //forcer la majuscule pour uniformiser la bdd
            $nomU = sansAccents($_POST["nomU"]);
            $nomU = mb_strtoupper($nomU);
            $prenomU = sansAccents($_POST["prenomU"]);
            $prenomU = ucwords(strtolower($prenomU));
            $dateNaissanceTemp = $_POST["dateNaissanceU"];
            $dateNaissanceU = modulerDateBDD($dateNaissanceTemp);
        
            // gestion checkbox de réinitialisation du mdp
            if(isset($_POST["reinitialiser"])){
                $reinit = $_POST["reinitialiser"];
            }else{
                $reinit = "non";
            }

            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage;charset=utf8","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $req = $conn->prepare("SELECT MotDePasse FROM utilisateurs WHERE codeUtilisateur='" .$codeU. "'");
                $req->execute();
                $mdpBDD = $req->fetch();

                if($reinit == "oui"){
                    $mdp = null;
                }else{
                    $mdp = $mdpBDD["MotDePasse"];
                }
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
            $conn = null;
            
            // gestion pour garder la checkbox admin cochée
            if(isset($_POST["droitAdmin"])){
                if($_POST["droitAdmin"] == "OUI"){
                    $droitAdmin = $_POST["droitAdmin"];
                }else{
                    $neg = "NON";
                    $droitAdmin = $neg;
                }
            }else{
                echo 'error';
            }        

            // connexion à la bdd pour entrer/modifier des informations
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage;charset=utf8","root","");            
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
                $sql = "UPDATE pesage.utilisateurs SET Nom = '$nomU', Prenom = '$prenomU', DateDeNaissance = '$dateNaissanceU', Administrateur = '$droitAdmin', MotDePasse = '$mdp' WHERE codeUtilisateur = '$codeU'";
                $conn->exec($sql);

                // message de confirmation de l'exécution de la requète
                ?>
                <script language="javascript">
                    alert("Modification enregistrée !");
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                </script>
                <?php                 
            }            
            catch (Exception $e) {
                echo $sql . "<br>" . $e->getMessage();
            } 
            $conn = null;
        }else{
            ?>
            <script language="javascript">
                alert("Une erreur est survenue...");
                window.location.href='gestionUtilisateurs.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php
        }
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='gestionUtilisateurs.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
    }

