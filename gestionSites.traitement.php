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
        if(isset($_POST["codeS"]) && isset($_POST["raiSoc"]) && isset($_POST["ad1"]) && isset($_POST["ad2"]) && isset($_POST["ad3"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["pays"]) && isset($_POST["tel"]) && isset($_POST["mail"]) && isset($_POST["contact"])){
            if(($_SESSION["_ScodeS"] == $_POST["codeS"]) && ($_SESSION["_SraiSoc"] == $_POST["raiSoc"]) && ($_SESSION["_Sad1"] == $_POST["ad1"]) && ($_SESSION["_Sad2"] == $_POST["ad2"]) && ($_SESSION["_Sad3"] == $_POST["ad3"]) && ($_SESSION["_Scp"] == $_POST["cp"]) && ($_SESSION["_Sville"] == $_POST["ville"]) && ($_SESSION["_Spays"] == $_POST["pays"]) && ($_SESSION["_Stel"] == $_POST["tel"]) && ($_SESSION["_Smail"] == $_POST["mail"]) && ($_SESSION["_Scontact"] == $_POST["contact"])){ 
                header("Location: http:\\Pesage\accueil.php?idS=$codeU_Session");
                exit;
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
                exit;
            }
        }else{
            echo "erreur";
        }
    // gestion bouton valider            
    }elseif (isset($_POST['valider'])){ 
        //récupération des données du formulaire
        if(isset($_POST["codeS"]) && isset($_POST["raiSoc"]) && isset($_POST["ad1"]) && isset($_POST["ad2"]) && isset($_POST["ad3"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["pays"]) && isset($_POST["tel"]) && isset($_POST["mail"]) && isset($_POST["contact"])){
            $codeS = sansAccents($_POST["codeS"]);
            $codeS = mb_strtoupper($codeS); //forcer la casse pour uniformiser la bdd
            
            $raisonSociale = sansAccents($_POST["raiSoc"]);
            $raisonSociale = mb_strtoupper($raisonSociale);
            
            $adresse1 = sansAccents($_POST["ad1"]);
            $adresse1 = mb_strtolower($adresse1);
            
            $adresse2 = sansAccents($_POST["ad2"]);
            $adresse2 = mb_strtolower($adresse2);
            
            $adresse3 = sansAccents($_POST["ad3"]);
            $adresse3 = mb_strtolower($adresse3);
            
            $cp = $_POST["cp"];
            
            $ville = sansAccents($_POST["ville"]);
            $ville = mb_strtoupper($ville);
            
            $pays = sansAccents($_POST["pays"]);
            $pays = mb_strtoupper($pays);
            
            $telephone = $_POST["tel"];
            
            $mail = sansAccents($_POST["mail"]);
            $mail = mb_strtolower($mail);
            
            $contact = sansAccents($_POST["contact"]);
            $contact = mb_strtoupper($contact);
            
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage;charset=utf8","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
                $req = "UPDATE pesage.site SET RaisonSociale = '" .$raisonSociale. "', Adresse1 = '" .$adresse1. "', Adresse2 = '" .$adresse2. "', Adresse3 ='" .$adresse3. "', CodePostal = '" .$cp. "', Ville ='" .$ville. "', Pays ='" .$pays. "', Telephone ='" .$telephone. "', Mail = '" .$mail. "', Contact ='" .$contact. "' WHERE CodeSite = '" .$codeS. "';";
                $conn->exec($req);                
            }catch (Exception $ex){
                echo $req . "<br>" . $ex->getMessage();
            }
            $conn = null;
            
            // Confirmation de l'exécution des modifications
            ?>
            <script language="javascript">
                alert("Modification site enregistrée !");
                window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php           
            
        }else{
            ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='rechercheClients.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
        }
        
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='rechercheClients.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
    }

