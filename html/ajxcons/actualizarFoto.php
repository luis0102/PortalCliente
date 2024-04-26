<?php
session_start();
ob_start();
require '../BD/conexion.php';

$upload = isset($_FILES['upload']['name']) ? $_FILES['upload']['name'] : '';
$direccionTemporalUpload = isset($_FILES['upload']['tmp_name']) ? $_FILES['upload']['tmp_name'] : '';
$titular = $_SESSION['nus_PORTALCONSULTANCY'];
$html = '';


if ($upload == "") {
    echo "void";
} else {

    $obtenerIDPersona = mysqli_query($con, "select u.idusuario as dat1, p.idpersona as dat2, fotocol as dat3 
    from usuario u, persona p, foto f
    where u.idusuario=p.idusuario and u.email='$titular' and u.idusuario=f.idusuario");
    while ($valorArrayIDPersona = mysqli_fetch_array($obtenerIDPersona)) {
        $idusuario = $valorArrayIDPersona['dat1'];
        $idpersona = $valorArrayIDPersona['dat2'];
        $fotoActual = $valorArrayIDPersona['dat3'];
    }
    if ($upload <> "") {
        $admitidos = array('.jpg', '.jpeg', '.png', '.JPG', '.JPEG', '.PNG');
        $nombreEncriptado = rand(1, 10) . '_' . rand(11, 100) . '_' . rand(101, 1000) . '_' . rand(1001, 10000);
        $extension = substr($upload, strrpos($upload, '.'));
        $consultaUpdateFotoUsuario = "update foto set fotocol='$nombreEncriptado$extension'   
        where idusuario=$idusuario";
        $resultadoFoto = mysqli_query($con, $consultaUpdateFotoUsuario);
        if ($resultadoFoto) {

            if (in_array($extension, $admitidos)) {
                if (move_uploaded_file($direccionTemporalUpload, "../fotosPerfil/$nombreEncriptado$extension")) {
                    echo "correctoFoto";
                    unlink("../fotosPerfil/" . $fotoActual);
                } else {
                    echo "Ocurrió un error";
                }
            } else {
                $respuesta = "errorfotoformato";
            }
        } else {
            echo "errorfoto";
        }
    }
}
