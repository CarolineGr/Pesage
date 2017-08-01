<?php
    session_start();
    include_once 'gestionBase.php';
    echo "<meta charset='utf-8'>";
    
    // gestion boutons annuler/valider
    if (isset($_POST['annuler'])){
        header("Location: http:\\Pesage\authentification.php");
        exit;
    
    }elseif (isset($_POST['valider'])){ 
    // connexion à la bdd pour y enregistrer le nouveau mdp
        // vérification que les mots de passe sont bien identiques
        if($_POST["password"] != $_POST["password-control"]){
            //Fenetre popup : alerte mauvais mdp
            ?><script language="javascript">
                alert("Les mots de passe ne correspondent pas !");
                history.back();
            </script><?php

            // Enregistrement des données dans la bdd
        }else{
            $mdp = htmlspecialchars($_POST["password"]);
            $cmdp = htmlspecialchars($_POST["password-control"]);
            
            try{
                $conn = new PDO("mysql:host=localhost;dbname=Pesage;charset=utf8","root","");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if(isset($_POST["codeU"])){
                    $codeU = $_POST["codeU"];
                }
                $sql = "UPDATE `pesage`.`utilisateurs` SET `MotDePasse` = '$mdp' WHERE `utilisateurs`.`codeUtilisateur` = '$codeU';";

                $conn->exec($sql);
                // fenêtre avertissement succès puis redirection
                ?><script language="javascript">
                    alert("Nouveau mot de passe enregistré avec succès !");
                    window.location.href='authentification.php';
                </script><?php 
                
            }
            catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }          

            $conn = null;
        }
        // END - connexion à la bdd pour enregistrer le nouveau mdp dans la bdd
    }

