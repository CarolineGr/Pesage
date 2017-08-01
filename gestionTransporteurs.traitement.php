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
        if(isset($_POST["codeT"]) && isset($_POST["raiSoc"]) && isset($_POST["ad1"]) && isset($_POST["ad2"]) && isset($_POST["ad3"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["pays"]) && isset($_POST["tel"]) && isset($_POST["mail"]) && isset($_POST["contact"])){
            if(($_SESSION["_TcodeT"] == $_POST["codeT"]) && ($_SESSION["_TraiSoc"] == $_POST["raiSoc"]) && ($_SESSION["_Tad1"] == $_POST["ad1"]) && ($_SESSION["_Tad2"] == $_POST["ad2"]) && ($_SESSION["_Tad3"] == $_POST["ad3"]) && ($_SESSION["_Tcp"] == $_POST["cp"]) && ($_SESSION["_Tville"] == $_POST["ville"]) && ($_SESSION["_Tpays"] == $_POST["pays"]) && ($_SESSION["_Ttel"] == $_POST["tel"]) && ($_SESSION["_Temail"] == $_POST["mail"]) && ($_SESSION["_Tcontact"] == $_POST["contact"])){ 
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
    // gestion du bouton valider 
    }elseif (isset($_POST['valider'])){ 
        //récupération des données du formulaire
        if(isset($_POST["codeT"]) && isset($_POST["raiSoc"]) && isset($_POST["ad1"]) && isset($_POST["ad2"]) && isset($_POST["ad3"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["pays"]) && isset($_POST["tel"]) && isset($_POST["mail"]) && isset($_POST["contact"])){
            $codeT = sansAccents($_POST["codeT"]);
            $codeT = mb_strtoupper($codeT); //forcer la casse pour uniformiser la bdd
            
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
                $req = "UPDATE pesage.transporteurs SET RaisonSociale = '" .$raisonSociale. "', Adresse1 = '" .$adresse1. "', Adresse2 = '" .$adresse2. "', Adresse3 ='" .$adresse3. "', CodePostal = '" .$cp. "', Ville ='" .$ville. "', Telephone ='" .$telephone. "', Mail = '" .$mail. "', Contact ='" .$contact. "' WHERE CodeTransporteur = '" .$codeT. "';";
                $conn->exec($req);                
            } catch (Exception $ex) {
                echo $req . "<br>" . $ex->getMessage();
            }
            $conn = null;
            
            // sript confirmation de l'exécution de la requète
            ?>
            <script language="javascript">
                alert("Modification transporteur enregistrée !");
                window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php 
             
        }else{
            ?>
            <script language="javascript">
                alert("Une erreur est survenue...");
                window.location.href='rechercheTransporteurs.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php
        }
        
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='rechercheTransporteurs.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
    }

