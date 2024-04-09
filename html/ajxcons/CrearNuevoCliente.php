<?php
session_start();
ob_start();
require '../BD/conexion.php';
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$ClienteNombres = isset($_POST['ClienteNombres']) ? $_POST['ClienteNombres'] : '';
$ClienteApellidos = isset($_POST['ClienteApellidos']) ? $_POST['ClienteApellidos'] : '';
$ClienteTelef = isset($_POST['ClienteTelef']) ? $_POST['ClienteTelef'] : '';
$ClientePlanServicio = isset($_POST['ClientePlanServicio']) ? $_POST['ClientePlanServicio'] : '';
$ClienteServicioContratado = isset($_POST['ClienteServicioContratado']) ? $_POST['ClienteServicioContratado'] : '';
$ClienteFecha_af = isset($_POST['ClienteFecha_af']) ? $_POST['ClienteFecha_af'] : '';
$ClienteCosto = isset($_POST['ClienteCosto']) ? $_POST['ClienteCosto'] : '';
$ClienteAsesor = isset($_POST['ClienteAsesor']) ? $_POST['ClienteAsesor'] : '';
$ClienteEmpresa = isset($_POST['ClienteEmpresa']) ? $_POST['ClienteEmpresa'] : '';

$NombreActualDocumento = isset($_FILES['ClienteContrato']['name']) ? $_FILES['ClienteContrato']['name'] : '';
$NombreTemporalDocumento = isset($_FILES['ClienteContrato']['tmp_name']) ? $_FILES['ClienteContrato']['tmp_name'] : '';

$ClienteDetalleContrato = isset($_POST['ClienteDetalleContrato']) ? $_POST['ClienteDetalleContrato'] : '';
$ClienteEmail = isset($_POST['ClienteEmail']) ? $_POST['ClienteEmail'] : '';
$ClientePassword = isset($_POST['ClientePassword']) ? $_POST['ClientePassword'] : '';
//   echo "$ClienteNombres | $ClienteApellidos | $ClienteTelef | $ClientePlanServicio | $ClienteFecha_af | $ClienteCosto | $ClienteAsesor | $ClienteEmpresa | $NombreActualDocumento | $NombreTemporalDocumento| $ClienteDetalleContrato | $ClienteEmail | $ClientePassword | ";
//    echo "$ClienteNombres | $ClienteApellidos | $ClientePlanServicio | $ClienteServicioContratado | $ClienteFecha_af | $ClienteCosto | $ClienteAsesor | $NombreActualDocumento | $NombreTemporalDocumento | $ClienteEmail | $ClientePassword |";
if ($ClienteNombres == '' || $ClienteApellidos == '' || $ClientePlanServicio == 0 || $ClienteServicioContratado=='' || $ClienteFecha_af == '' || $ClienteCosto == '' || $ClienteAsesor == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' || $ClienteEmail == '' || $ClientePassword == '') {
    echo "void";
} else {
    $AddConsulta = "";
    if ($ClienteEmpresa <> '' || $ClienteDetalleContrato<>'') {
        $AddConsulta = " INSERT INTO empresa (dato, idcliente) VALUES ('$ClienteEmpresa', @idcliente);";
    }

    // $insert1 = "INSERT INTO usuario ( email, psw, idestadou) VALUES ('', '', '')";
    // $insert2 = "INSERT INTO foto (fotocol, idusuario) VALUES ('', ) ";
    // $insert3 = "INSERT INTO persona (nombre, apellido, telefono) VALUES ()";
    // $insert4 = "INSERT INTO cliente (idpersona) VALUES ()";
    // $insert5 = "INSERT INTO info (servicio, fecha_afiliacion, costo_plan, idtipo_plan, idasesor, idcliente) VALUES ()";
    // $insert6 = "INSERT INTO contrato (contrato, detalle, idcliente) VALUES ()";
    // $insert7 = "";
    $NombreEncriptadoDoc=date('Y-m-d').'_'.rand(1, 10) . '_' . rand(11, 100) . '_' . rand(101, 1000) . '_' . rand(1001, 10000);
             

$con->begin_transaction();

// Insertar en la tabla "usuario"
$consultaUsuario = "INSERT INTO usuario (email, psw, idestadou) VALUES (?, ?, 1)";
$sentenciaUsuario = $con->prepare($consultaUsuario);
$sentenciaUsuario->bind_param("ss", $ClienteEmail, $ClientePassword);

$sentenciaUsuario->execute();

// Insertar en la tabla "foto"
$consultaFoto = "INSERT INTO foto (fotocol, idusuario) VALUES (?, ?)";
$sentenciaFoto = $con->prepare($consultaFoto);
$sentenciaFoto->bind_param("si", $fotocol, $idUsuario);

$fotocol = ""; // Base64 de la imagen
$idUsuario = $sentenciaUsuario->insert_id; // Obtener ID generado en "usuario"

$sentenciaFoto->execute();

// Insertar en la tabla "persona"
$consultaPersona = "INSERT INTO persona (nombre, apellido, telefono, idusuario) VALUES (?, ?, ?, ?)";
$sentenciaPersona = $con->prepare($consultaPersona);
$sentenciaPersona->bind_param("sssi", $ClienteNombres, $ClienteApellidos, $ClienteTelef, $idUsuario);

$sentenciaPersona->execute();

// Insertar en la tabla "cliente"
$consultaCliente = "INSERT INTO cliente(idpersona) VALUES(?)";
$sentenciaCliente = $con->prepare($consultaCliente);
$sentenciaCliente->bind_param("i", $idPersona);
$idPersona = $sentenciaPersona->insert_id;
$sentenciaCliente->execute();

// Insertar en la tabla "info"
$consultaInfo = "INSERT INTO info(servicio, fecha_afiliacion, costo_plan, idtipo_plan, idasesor, idcliente) 
                    SELECT  ? ,STR_TO_DATE(?, '%d-%m-%Y'),?,?,idasesor,? 
                    FROM asesor 
                    WHERE folio='$ClienteAsesor';";
$sentenciaInfo = $con->prepare($consultaInfo);
$sentenciaInfo->bind_param("sssii", $ClienteServicioContratado,$ClienteFecha_af, $ClienteCosto, $ClientePlanServicio, $idCliente);
$idCliente = $sentenciaCliente->insert_id;

$sentenciaInfo->execute();

// Insertar en la tabla "contrato"
$consultaContrato = "INSERT INTO contrato(contrato, detalle, idcliente) 
                    VALUES (?,?,?);";
$sentenciaContrato = $con->prepare($consultaContrato);
$sentenciaContrato->bind_param("ssi", $NombreEncriptadoDoc,$ClienteDetalleContrato, $idCliente);

$sentenciaContrato->execute();
if ($sentenciaUsuario->execute()&&$sentenciaFoto->execute()&&$sentenciaPersona->execute()&& $sentenciaCliente->execute() && $sentenciaInfo->execute() && $sentenciaContrato->execute()) {
    $con->commit();
    echo "correcto";
} else {
    echo "Error al insertar registros";
    $con->rollBack();
}
}