<?php
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";
    $pdo = gestionnaireDeConnexion();
    

// code utilisateur de la session
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo 'Erreur';
    }
// gestion bouton annuler
    if(isset($_POST["annuler"])){
        if(($_POST["client"] != "") || ($_POST["immat"] != "") || ($_POST["matiere"] != "") || ($_POST["poidsE"] != "")){
            ?>
            <script language="javascript">
                if(confirm("Voulez-vous quitter sans enregistrer les modifications ?")){
                    window.location.href='gestionPeseesEntrees.php?idS=<?php echo $codeU_Session; ?>';
                }else{
                    history.back();
                }
            </script>
            <?php
            exit();
        
        }else{
            ?><script>document.location="accueil.php?idS=<?php echo $codeU_Session; ?>";</script><?php
            exit();
        }
        
// gestion bouton valider        
    }elseif(isset($_POST["valider"])){
        if(!empty($_POST["client"]) && !empty($_POST["immat"]) && !empty($_POST["matiere"]) && !empty($_POST["poidsE"])){
            $client = strtoupper($_POST["client"]);
            $immat = strtoupper($_POST["immat"]);
            $matiere = strtoupper($_POST["matiere"]);
            $poidsE = round($_POST["poidsE"],0);
            
            // vérification que le véhicule n'est pas déjà en zone de déchargement
            $reqVerif = $pdo->prepare("SELECT Immatriculation FROM pesees WHERE Immatriculation='" .$immat. "';");
            $reqVerif->execute();
            $verif = $reqVerif->rowCount();
            if($verif === 1){
                ?><script language="javascript">
                    alert("Ce véhicule est déjà sur le site !!");
                    history.back();
                </script>
                <?php
                exit();
            }
            $reqVerif->closeCursor();
            
            // récupération de !'id de l'utilisateur            
            $req = $pdo->query('SELECT * FROM utilisateurs WHERE codeUtilisateur="' .$codeU_Session.'";');        
            $bdd = $req->fetch();            
            $idUtilisateurE = $bdd["id_utilisateurs"];
            $req->closeCursor();
            
            // récupération du code client
            $req = $pdo->query('SELECT * FROM clients WHERE RaisonSociale="' .$client.'";');        
            $bdd = $req->fetch();            
            $codeC = $bdd["CodeClient"];
            $req->closeCursor();

            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage;charset=utf8","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $pdo->prepare("INSERT INTO `pesage`.`pesees` (`id_pesees`, `idUtilisateurEntree`, `idUtilisateurSortie`, `CodeClient`, `DateEntree`, `DateSortie`, `PoidsEntree`, `PoidsSortie`, `Immatriculation`, `CodeMatiere`, `Prix`) VALUES (NULL, '" .$idUtilisateurE. "', NULL, '" .$codeC. "', NOW(), NULL, '" .$poidsE. "', NULL, '" .$immat. "', '" .$matiere. "', NULL);");
                $sql->execute();

            } catch (Exception $ex) {
                echo $sql . "<br>" . $ex->getMessage();
            }
            $conn = null;

            ?>
            <script language="javascript">
                alert("Entrée enregistrée !");
                window.location.href='gestionPeseesEntrees.php?idS=<?php echo $codeU_Session; ?>';
            </script>
            <?php 
            
        }else{
           ?>
           <script language="javascript">
               alert("Veuillez remplir tous les champs");
               history.back();
           </script>
           <?php
        }
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue... ");
            window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
        </script>
        <?php
    }