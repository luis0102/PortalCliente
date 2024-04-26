<?php
session_start();
ob_start();
require '../BD/conexion.php';

$identificadorCliente2 = isset($_POST['identificadorCliente2']) ? $_POST['identificadorCliente2'] : 0;
$UsuarioEstado = isset($_POST['UsuarioEstado']) ? $_POST['UsuarioEstado'] : '';

if ($identificadorCliente2 == 0 || $UsuarioEstado == '' ) {
    echo "void";
} else {
    
    $con->begin_transaction();

    $ConsultaUpdateEstadoUsuario = "UPDATE usuario 
                            SET idestadou = ? 
                            WHERE idusuario = (SELECT p.idusuario FROM cliente c, persona p where c.idpersona=p.idpersona and c.nCURP=?) ;";
    $sentenciaUpdateEstadoUsuario = $con->prepare($ConsultaUpdateEstadoUsuario);
    $sentenciaUpdateEstadoUsuario->bind_param(
        "is",
        $UsuarioEstado,
        $identificadorCliente2
    );
    $sentenciaUpdateEstadoUsuario->execute();

    $filasUpdateEstadoUsuario = $sentenciaUpdateEstadoUsuario->affected_rows;

    if ($filasUpdateEstadoUsuario > 0) {
        $con->commit();
        echo "correcto";        
    } else {
        echo "Error al insertar registros";
        // echo $completoDocName . '-------' . $sentenciaNContrato;
        $con->rollBack();
    }
}
//  echo $identificadorCliente2 .'  |'. $UsuarioEstado .'  |';