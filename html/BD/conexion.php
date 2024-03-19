
	<?php
date_default_timezone_set("America/Mexico_City");
	//echo '<!DOCTYPE html>
//<html lang="es">
//<head>
//	<meta charset="UTF-8">
//	<meta name="viewport" content="width=device-width, initial-scale=1.0">
//	<meta http-equiv="X-UA-Compatible" content="ie=edge">
//	<title>Document</title>
//
//</head>
//<body>';
	#$server="mysql.webcindario.com";
	$server="localhost";
	 $username="root";
	// $username="id21402251_luis";
	// $password="awdsc432dfASD$/(";
	 $password="";
	// $db="id21402251_base1publicaperu";
	 $db="consultancyBDPC";
	##
	$con=mysqli_connect($server, $username, $password,$db) or die("no se ha podido establecer la conexion");
	mysqli_set_charset($con,"utf8");
	
//	echo '</body></html>';
?>