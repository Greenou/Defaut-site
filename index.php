<?php
	//FICHIERS CONFIG
	require_once 'conf/conf.php';
	require_once 'conf/fonctions.php';

	// HEADER
	include_once 'templates/header.php';

	// INCLUSION DE TOUTES LES AUTRES PAGES DU SITE
	if(isset($_GET['p']) AND file_exists('./pages/'.$_GET['p'].'.php'))
        {
            include './pages/'.$_GET['p'].'.php';
        }
        else{
           	include './pages/index.php';
        }

	// FOOTER
	include_once 'templates/footer.php';
?>