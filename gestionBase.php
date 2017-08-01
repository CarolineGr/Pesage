<?php
    function gestionnaireDeConnexion() {
        $pdo = null;
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=pesage', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
        } catch (PDOException $err) {
            $messageErreur = $err->getMessage();
            error_log($messageErreur, 0);
        }
        return $pdo;
        }
    
    function verifDate($tab){
        list($jour, $mois, $annee) = explode("-", $tab);
        if($annee>date("Y") || $annee<1900){
            ?><script language="javascript">
            alert("Erreur de date...");
            history.back();
            </script>
            <?php
        }else{
            return checkdate($mois, $jour, $annee);
        }
    }
    
    function modulerDate($tab){
        list($annee, $mois, $jour) = explode("-", $tab);
        return $jour . "-" . $mois . "-" . $annee;
    }
    
    function modulerDateBDD($tab){
        list($jour, $mois, $annee) = explode("-", $tab);
        return  $annee . "-" . $mois . "-" . $jour;
    }
    
    function modulerDateHeureBDD($tab){
        $tab = str_replace(":", "-", $tab);
        $tab = str_replace(" ", "-", $tab);
        list($annee, $mois, $jour, $heure, $minute, $seconde) = explode("-", $tab);
        return  $jour. "-" .$mois. "-" .$annee. " " .$heure. ":" .$minute. ":" .$seconde;
    }
    
    function listeUtilisateurs() {
        $baseUtilisateurs = array(); //initialisation d'une variable résultat
        $pdo = gestionnaireDeConnexion(); //appel de la fonction gestionnaireDeConnexion et initialisation
        //de l'objet pdo
        if ($pdo != False) { //test pour savoir si l'objet pdo est convenablement initialisé
            $req = "select * from utilisateurs"; //interroge la BDD
            $pdoStatement = $pdo->query($req);
            //récupère les informations des utilisateurs sous la forme d'un tableau de tableau
            $baseUtilisateurs = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseUtilisateurs; // renvoie la variable résultat
    }
    
    function listeTransporteurs(){
        $baseTransp = array();
        $pdo = gestionnaireDeConnexion();
        if($pdo!=false){
            $req = "select * from transporteurs";
            $pdoStatement = $pdo->query($req);
            $baseTransp = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseTransp;
    }

    function listeClient(){
        $baseClient = array();
        $pdo = gestionnaireDeConnexion();
        if($pdo!=false){
            $req = "select * from clients";
            $pdoStatement = $pdo->query($req);
            $baseClient = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseClient;
    }    
    
    function listeSessions(){
        $baseSessions = array();
        $pdo = gestionnaireDeConnexion();
        if($pdo!=false){
            $req = "select * from sessions";
            $pdoStatement = $pdo->query($req);
            $baseSessions = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseSessions;
    }
    
    function listeSite(){
        $baseSite = array();
        $pdo = gestionnaireDeConnexion();
        if($pdo!=false){
            $req = "select * from site";
            $pdoStatement = $pdo->query($req);
            $baseSite = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseSite;
    }
    
    function listeImmatriculation(){
        $baseImmat = array();
        $pdo = gestionnaireDeConnexion();
        if($pdo!=false){
            $req = "select * from immatriculations";
            $pdoStatement = $pdo->query($req);
            $baseImmat = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseImmat;
    }
    
    function listeMatiere(){
        $baseMatiere = array();
        $pdo = gestionnaireDeConnexion();
        if($pdo!=false){
            $req = "select * from matieres";
            $pdoStatement = $pdo->query($req);
            $baseMatiere = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseMatiere;
    }
    
    function listeHistorique(){
        $baseHistorique = array();
        $pdo = gestionnaireDeConnexion();
        if($pdo!=false){
            $req = "SELECT * FROM historiquepesees";
            $pdoStatement = $pdo->query($req);
            $baseHistorique = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $baseHistorique;    
    }
    
    function verifFormatIP($ip){
        list($nb1, $nb2, $nb3, $nb4) = explode(".", $ip);
        if($nb1>255 || $nb1<1){
            $result = "false";
        }elseif($nb2>255 || $nb2<0){
            $result = "false";
        }elseif($nb3>255 || $nb3<0){
            $result = "false";
        }elseif($nb4>255 || $nb4<1){
            $result = "false";
        }else{
            $result = "true";
        }
        return $result;
    }
    
    function sansAccents($str){
        $url = $str;
        $url = preg_replace('#Ç#', 'C', $url);    
        $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
        $url = preg_replace('#À|Á|Â|Ã|Ä|Å#', 'A', $url);
        $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
        $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
        $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
        $url = preg_replace('#Ý#', 'Y', $url);
        $url = preg_replace('#ç#', 'c', $url);    
        $url = preg_replace('#è|é|ê|ë#', 'e', $url);
        $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
        $url = preg_replace('#ì|í|î|ï#', 'i', $url);
        $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
        $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
        $url = preg_replace('#ý|ÿ#', 'y', $url);
        $url = preg_replace('#\'#', ' ', $url);

        return ($url);
    }
    
    function get_ip() {
	// IP si internet partagé
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
	}
	// IP derrière un proxy
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	// Sinon : IP normale
	else {
            return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
    } 
    
