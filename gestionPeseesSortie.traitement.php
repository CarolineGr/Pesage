<?php
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";
    $pdo = gestionnaireDeConnexion();
    

// code utilisateur de la session
    if(isset($_GET["idS"]) && isset($_GET["dateE"])){
        $codeU_Session = $_GET["idS"];
        $dateE = $_GET["dateE"];
    }else{
        echo 'Erreur';
    }
// gestion bouton annuler
    if(isset($_POST["annuler"])){
        if(($_POST["poidsS"] != "")){
            ?>
            <script language="javascript">
                if(confirm("Voulez-vous quitter sans enregistrer les modifications ?")){
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
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
        if(!empty($_POST["poidsS"])){
            $poidsS = round($_POST["poidsS"],0);
            $poidsE = $_POST["poidsE"];
            $idPesee = $_POST["idP"];
            $codeClient = $_POST["codeC"];
            $idUtiEn = $_POST["idUE"];
            $idUtiSo = $_POST["idUS"];
            $immat = $_POST["immat"];
            $codeMatiere = $_POST["codeMat"];
            
            $req = $pdo->query('SELECT Prix FROM matieres WHERE codeMatiere="' .$codeMatiere.'";');        
            $bdd = $req->fetch();            
            $prix = $bdd["Prix"];
            $req->closeCursor();
            
            
            // gestion du poids et du prix
            if($poidsS>$poidsE){
                ?>
                <script language="javascript">
                    alert("Erreur : le poids de sortie est supérieur au poids d'entrée...");
                    history.back();                    
                </script>
                <?php
                exit();
            }elseif($poidsE == $poidsS){
                ?>
                <script language="javascript">
                    if(confirm("Le poids de sortie est identique au poids d'entrée. Confirmez-vous la sortie sans déchargement ?")){
                        window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                    }else{
                        history.back();
                    }
                </script>
                <?php
                exit();
            }else{
                $poidsT = $poidsE - $poidsS;
                $prixTemp = $prix * $poidsT /1000;
                $prixT = round($prixTemp,2);
            }
            
            // enregitrement dans la bdd historiquePesees
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage;charset=utf8","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $pdo->prepare("INSERT INTO `pesage`.`historiquePesees` (`id_pesees`, `idUtilisateurEntree`, `idUtilisateurSortie`, `CodeClient`, `DateEntree`, `DateSortie`, `PoidsEntree`, `PoidsSortie`, `Immatriculation`, `CodeMatiere`, `Prix`) VALUES ('" .$idPesee. "', '" .$idUtiEn. "', '" .$idUtiSo. "', '" .$codeClient. "', '" .$dateE. "', NOW(), '" .$poidsE. "', '" .$poidsS. "', '" .$immat. "', '" .$codeMatiere. "', '" .$prixT. "');");
                $sql->execute();

            } catch (Exception $ex) {
                echo $sql . "<br>" . $ex->getMessage();
            }
            $conn = null;

            // effacement de la pesées dans la bdd pesees
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage;charset=utf8","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql1 = $pdo->prepare("DELETE FROM `pesage`.`pesees` WHERE `pesees`.`id_pesees` = '" .$idPesee. "'");
                $sql1->execute();

            } catch (Exception $ex1) {
                echo $sql1 . "<br>" . $ex1->getMessage();
            }
            $conn = null;
            
            ?>
            <script language="javascript">
                if(confirm("Sortie enregistrée ! Souhaitez-vous imprimer le ticket ?")){
                    window.open("facturette.php?idS=<?php echo $codeU_Session;?>&idP=<?php echo $idPesee;?>","facturette","menubar=no, status=no, scrollbars=no, menubar=no, width=800, height=600");
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                }else{
                    window.location.href='accueil.php?idS=<?php echo $codeU_Session; ?>';
                }
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
