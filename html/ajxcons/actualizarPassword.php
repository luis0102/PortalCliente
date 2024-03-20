<?php
session_start();
ob_start();
require '../BD/conexion.php';
$clave_actual = isset($_POST['clave_actual']) ? $_POST['clave_actual'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
$clave2 = isset($_POST['clave2']) ? $_POST['clave2'] : '';

$titular = $_SESSION['nus_PORTALCONSULTANCY'];
$html = '';


if ($clave_actual == "" || $clave == "" || $clave2 == "") {

    echo "void";
} else {
    $contadorDeIgualdad = 1;
    $ConsultaIgualdadPassword = mysqli_query($con, "select idusuario,psw from usuario where email = '$titular' and idestadou=1");
    while ($ArrayConsulta = mysqli_fetch_array($ConsultaIgualdadPassword)) {
        $ObtenerID = $ArrayConsulta['idusuario'];
        $contra = $ArrayConsulta['psw'];
        $contadorDeIgualdad++;
    }

    if ($contra == $clave_actual) {
        $existenciaClave = "si";
    } else {
        echo "no";
        exit();
    }
    if ($clave == $clave2) {
    } else {
        echo "desigual";
        exit();
    }
    $consultaUpdatePasword = "update usuario set psw='$clave2'
            where idusuario=$ObtenerID and email='$titular'";
    $resultado2 = mysqli_query($con, $consultaUpdatePasword);
    if ($resultado2) {
        echo "correcto";
    } else {
        echo "error";
        exit();
    }
}
