<?php
    include_once 'gestionBase.php';    
    echo "<meta charset='utf-8'>";
    $pdo = gestionnaireDeConnexion();
    
    // récupération du code utilisateur de la session en cours 
    if(isset($_GET["idS"])){
        $codeU_Session = $_GET["idS"];
    }else{
        echo "erreur";
    }
       
    // gestion boutons annuler/valider
    if (isset($_POST['annuler'])){
        ?><script>document.location="authentification.php";</script><?php
        
    }elseif (isset($_POST['valider'])){ 
        if(isset($_POST["clefA"])){
            // récupération de l'entrée de l'utilisateur
            $clefA = $_POST["clefA"];
            
            // récupération de la clef d'activation dans la bdd             
            $req = $pdo->query('SELECT * FROM utilisateurs WHERE codeUtilisateur="'.$codeU_Session .'"');    
            $bdd = $req->fetch();
            $clef_activation = $bdd["Clef_Activation"];
            $prenom = $bdd["Prenom"];
            
            // comparaison et redirection
            if($clefA == $clef_activation){
                ?>
                <script language="javascript">
                    alert("Bonjour <?php echo $prenom ; ?>, veuillez choisir un mot de passe personnel.");
                    window.location.href='modificationMdP.php?idS=<?php echo $codeU_Session ;?>';
                </script>
                <?php
            }else{
                ?>
                <script language="javascript">
                    alert("Mauvaise clef d'activation saisie !");
                    history.back();
                </script>
                <?php 
            }            
        }else{
            ?>
            <script language="javascript">
                alert("Une erreur est survenue...");
                window.location.href='authentification.php';
            </script>
            <?php        
        }
    }else{
        ?>
        <script language="javascript">
            alert("Une erreur est survenue...");
            window.location.href='authentification.php';
        </script>
        <?php
    }