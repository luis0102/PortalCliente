<?php
session_start();
    ob_start();    
    $_SESSION['estado_PORTALCONSULTANCY']="off";
    $_SESSION['nus_PORTALCONSULTANCY']="";
    $_SESSION['fotograf_PORTALCONSULTANCY']="defecto.png";

header("Location:../index.php");
?>