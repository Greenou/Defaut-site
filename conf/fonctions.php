<?php
// Navigation
	$nav = substr($_SERVER['QUERY_STRING'], 2, 4);
// Navigation

// ENCODAGE DES CARACTERES	
	function encoder($string)
	  {
		 //si ma chaîne n'est pas encodée
		 if(!mb_detect_encoding($string, 'UTF-8', true))
		 {
		   //je la ré-encode et je la renvoie
		   return utf8_encode($string);
		 }
		 //sinon si elle est déjà dans le bon format
		 else
		 {
		   //je renvoie la même chose
		   return $string;
		 }
	  }
// ENCODAGE DES CARACTERES

// DATE US en FR
function changedateusfr($dateus) 
{ 
	$datefr=$dateus{8}.$dateus{9}."/".$dateus{5}.$dateus{6}."/".$dateus{2}.$dateus{3}; 
	return $datefr; 
}
// DATE US en FR
// DATE US en FR
function changedatehusfr($datehus) 
{ 
	$datehfr=$datehus{8}.$datehus{9}."/".$datehus{5}.$datehus{6}."/".$datehus{2}.$datehus{3}." à ".$datehus{11}.$datehus{12}.":".$datehus{14}.$datehus{15}; 
	return $datehfr; 
}
// DATE US en FR

// CONNEXION	
	function is_logged(){
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
		if(!isset($_SESSION['auth'])){
			$_SESSION['flash']['danger']['connexion'] = "Vous avez été déconnecté !";
			header('Location: login.php');
			exit();
		}
	}
// CONNEXION

// COOKIES
	function reconnect_cookie(){
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
		if(!isset($pdo)){
			global $pdo;
		}
		if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
			$remember_token = $_COOKIE['remember'];
			$parts = explode('==', $remember_token);
			$user_id = $parts[0];
			$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
			$req->execute([$user_id]);
			$user = $req->fetch();
			if($user){
				$expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'ZaYu');
				if($expected == $remember_token){
					session_start();
					$_SESSION['auth'] = $user;
					setcookie('remember', $remember_token, time() + 60 *60 * 24 * 7);
				}else{
					setcookie('remember', NULL, -1);
				}
			}else{
				setcookie('remember', NULL, -1);
			}
			}
		}
// COOKIES

// RANDOM POUR CONNEXION
	function str_random($length){
		$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
	}


// FORMATAGE DES NOMBRES
	function money($valeur){
		return number_format($valeur, 2, ',', ' ');
	}

// NOM DES DATES EN FRANCAIS
	// Convertit une date ou un timestamp en français
	function dateFrench($nom) {
		if($nom == "January")	{ $dateFrench = "Janvier"; }                   	
		if($nom == "February")	{ $dateFrench = "Février"; }                  
		if($nom == "March")	{ $dateFrench = "Mars"; }                  
		if($nom == "April")	{ $dateFrench = "Avril"; } 
		if($nom == "May")	{ $dateFrench = "Mai"; } 
		if($nom == "June")	{ $dateFrench = "Juin"; } 
		if($nom == "July")	{ $dateFrench = "Juillet"; } 
		if($nom == "August")	{ $dateFrench = "Août"; }        
		if($nom == "September")	{ $dateFrench = "Septembre"; } 
		if($nom == "October")	{ $dateFrench = "Octobre"; } 
		if($nom == "November")	{ $dateFrench = "novembre"; } 
		if($nom == "December")	{ $dateFrench = "Décembre"; } 

		return $dateFrench;
	}
// Formatage monaitaire
function montant($montant){
	$fmt = new NumberFormatter( 'fr_FR', NumberFormatter::CURRENCY );
	return $fmt->formatCurrency($montant, "EUR")."\n";
}

function get_total_all_records()
{
	// LOCAL
	if($_SERVER['SERVER_ADDR']=="127.0.0.1"){
		$host = "localhost";
    	$user = "zarctus";
    	$passwd = "fs73aw65";
    	$db = "yuza";
	}else{
	// DISTANT
		$host = "localhost:3307";
        $user = "root";
        $passwd = "fs73aw65";
        $db = "yuza";

	}

	$pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $passwd);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


	
	$statement = $pdo->prepare("SELECT * FROM operations");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function arianne($nav){
	switch ($nav) {
    case "oper":
    	echo "<li class='breadcrumb-item'>Nos comptes</li>";
        echo "<li class='breadcrumb-item active'>Les opérations</li>";
        break;
    case "prev":
        echo "<li class='breadcrumb-item'>Nos comptes</li>";
        echo "<li class='breadcrumb-item active'>Les prévisions</li>";
        break;
    case "epar":
        echo "<li class='breadcrumb-item'>Nos comptes</li>";
        echo "<li class='breadcrumb-item active'>Epargnes</li>";
        break;
    case "livr":
        echo "<li class='breadcrumb-item'>Nos comptes</li>";
        echo "<li class='breadcrumb-item active'>Livret A</li>";
        break;
    case "grap":
        echo "<li class='breadcrumb-item'>Nos comptes</li>";
        echo "<li class='breadcrumb-item active'>Graph. Alimentations</li>";
        break;
    case "char":
        echo "<li class='breadcrumb-item'>Nos comptes</li>";
        echo "<li class='breadcrumb-item'><a href='?p=operations'>Les opérations</a></li>";
        echo "<li class='breadcrumb-item active'>Graphiques</li>";
        break;
    case "cour":
        echo "<li class='breadcrumb-item'>Logement</li>";
        echo "<li class='breadcrumb-item active'>Les courses</li>";
        break;
    case "edf":
        echo "<li class='breadcrumb-item'>Logement</li>";
        echo "<li class='breadcrumb-item active'>EDF</li>";
        break;
    case "suiv":
        echo "<li class='breadcrumb-item'>Divers</li>";
        echo "<li class='breadcrumb-item active'>Suivi de colis</li>";
        break;
    case "ygg":
        echo "<li class='breadcrumb-item'>Divers</li>";
        echo "<li class='breadcrumb-item active'>YggTorrent</li>";
        break;

}
}
// RANDOM URL
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 5; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


// AJOUT DE DATE DE VISITE
	if(isset($_SESSION['auth']->username))
	{
		if($_SESSION['auth']->username == "Yuyu" OR $_SESSION['auth']->username == "yuyu"){
			$req_visite = $pdo->prepare('UPDATE users SET last_visite = ? WHERE id = ?');
			$today_visite = date("Y-m-d H:i:s");
			$req_visite->execute([$today_visite, $_SESSION['auth']->id]);
		}
	}
