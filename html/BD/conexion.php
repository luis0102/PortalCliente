
	<?php
date_default_timezone_set("America/Mexico_City");

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
	

?>