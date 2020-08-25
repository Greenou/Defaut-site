<?php 
session_start();
	// LOCAL
	if($_SERVER['SERVER_ADDR']=="127.0.0.1"){
		$host = "localhost";
    	$user = "zarctus";
    	$passwd = "fs73aw65";
    	$db = ""; // A MODIFIER
	}else{
	// DISTANT
		$host = "localhost:3307";
        $user = "root";
        $passwd = "fs73aw65";
        $db = ""; // A MODIFER
	}

	$pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $passwd);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

