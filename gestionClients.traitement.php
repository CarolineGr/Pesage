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
        if(isset($_POST["codeC"]) && isset($_POST["raiSoc"]) && isset($_POST["ad1"]) && isset($_POST["ad2"]) && isset($_POST["ad3"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["pays"]) && isset($_POST["tel"]) && isset($_POST["mail"]) && isset($_POST["contact"])){
            if(($_SESSION["_CcodeC"] == $_POST["codeC"]) && ($_SESSION["_CraiSoc"] == $_POST["raiSoc"]) && ($_SESSION["_Cad1"] == $_POST["ad1"]) && ($_SESSION["_Cad2"] == $_POST["ad2"]) && ($_SESSION["_Cad3"] == $_POST["ad3"]) && ($_SESSION["_Ccp"] == $_POST["cp"]) && ($_SESSION["_Cville"] == $_POST["ville"]) && ($_SESSION["_Cpays"] == $_POST["pays"]) && ($_SESSION["_Ctel"] == $_POST["tel"]) && ($_SESSION["_Cmail"] == $_POST["mail"]) && ($_SESSION["_Ccontact"] == $_POST["contact"])){ 
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
        if(isset($_POST["codeC"]) && isset($_POST["raiSoc"]) && isset($_POST["ad1"]) && isset($_POST["ad2"]) && isset($_POST["ad3"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["pays"]) && isset($_POST["tel"]) && isset($_POST["mail"]) && isset($_POST["contact"])){
            $codeC = sansAccents($_POST["codeC"]);
            $codeC = mb_strtoupper($codeC); //forcer la casse pour uniformiser la bdd
            
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
                $conn = new PDO("mysql:host=localhost;dbname=Pesage","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
                $req = "UPDATE pesage.clients SET RaisonSociale = '" .$raisonSociale. "', Adresse1 = '" .$adresse1. "', Adresse2 = '" .$adresse2. "', Adresse3 ='" .$adresse3. "', CodePostal = '" .$cp. "', Ville ='" .$ville. "', Pays ='" .$pays. "', Telephone ='" .$telephone. "', Mail = '" .$mail. "', Contact ='" .$contact. "' WHERE CodeClient = '" .$codeC. "';";
                $conn->exec($req);                
            }catch (Exception $ex){
                echo $req . "<br>" . $ex->getMessage();
            }
            $conn = null;
            
            // Confirmation de l'exécution des modifications
            ?>
            <script language="javascript">
                alert("Modification client enregistrée !");
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

