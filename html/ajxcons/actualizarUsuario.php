<?php
session_start();
ob_start();
require '../BD/conexion.php';
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';
$upload = isset($_FILES['upload']['name']) ? $_FILES['upload']['name'] : '';
$titular=$_SESSION['nus_PORTALCONSULTANCY'];
$html = '';


if ($firstName=="" || $lastName=="" ) {
   
    echo "void";
} else {
    echo $firstName."".$lastName."".$phoneNumber."".$upload."";
    $obtenerIDPersona = mysqli_query($con, "select u.idusuario as dat1, p.idpersona as dat2 
    from usuario u, persona p 
    where u.idusuario=p.idusuario and u.email='$titular'");
    while ($valorArrayIDPersona = mysqli_fetch_array($obtenerIDPersona)) {
        $idusuario = $valorArrayIDPersona['dat1'];
        $idpersona = $valorArrayIDPersona['dat2'];        
      }

    $consultaUpdateCliente="update persona set nombre='$firstName' , apellido='$lastName' , telefono='$phoneNumber' 
    where idpersona=$idpersona";
    $resultado2= mysqli_query($con,$consultaUpdateCliente);
    if (!$resultado2) {
            echo "error";
        } else {
            echo "correcto";
        }
}

?>