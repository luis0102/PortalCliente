<?php 
//inicializando variable ...
if (isset($_SESSION['estado_PORTALCONSULTANCY'])) { 
    
} else {
    $_SESSION['estado_PORTALCONSULTANCY']="off";
    $_SESSION['nus_PORTALCONSULTANCY']="";
    $_SESSION['fotograf_PORTALCONSULTANCY']="defecto.png";
    // echo "variable de sesion inicializada...";
}
?>