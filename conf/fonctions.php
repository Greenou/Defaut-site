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
