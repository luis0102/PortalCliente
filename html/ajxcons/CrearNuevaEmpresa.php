<?php
session_start();
ob_start();
require '../BD/conexion.php';

$identificadorCliente = isset($_POST['identificadorCliente']) ? $_POST['identificadorCliente'] : null;
$NuevaNEmpresa = isset($_POST['NuevaNEmpresa']) ? $_POST['NuevaNEmpresa'] : '';
$EmpresaCosto = isset($_POST['EmpresaCosto']) ? $_POST['EmpresaCosto'] : '';

// recibiendo datos del archivo 
$NombreActualDocumento = isset($_FILES['EmpresaArchivoContrato']['name']) ? $_FILES['EmpresaArchivoContrato']['name'] : '';
$NombreTemporalDocumento = isset($_FILES['EmpresaArchivoContrato']['tmp_name']) ? $_FILES['EmpresaArchivoContrato']['tmp_name'] : '';

$EmpresaDetalle = isset($_POST['EmpresaDetalle']) ? $_POST['EmpresaDetalle'] : 'Ninguno';

// if ($DocumentoTipoPersona == 0 || $DocumentoTipoDocumento == 0 || $DocumentoEstado == 0 || $identificadorEmpresa == '' || $DocumentoMes == '' || $DocumentoAnio == '' || $DocumentoISR == '' || $DocumentoIVA == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' ) {
//     echo "void";

$admitidos = array('.pdf', '.PDF');
$nombreEncriptado = date('Y-m-d') . '_' . rand(1, 10) . '_' . rand(11, 100) . '_' . rand(101, 1000) . '_' . rand(1001, 10000);
$extension = substr($NombreActualDocumento, strrpos($NombreActualDocumento, '.'));
if ($identificadorCliente == '' || $NuevaNEmpresa == '' || $EmpresaCosto == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '') {
    echo "void";
} else {
    $completoDocName = 'Contrato_' . $nombreEncriptado . $extension;
    $con->begin_transaction();
    $ConsultaNuevaEmpresa = "INSERT INTO empresa (dato, idcliente) 
        VALUES (?, (SELECT idcliente FROM cliente where nCURP=?));";
    $sentenciaNuevaEmpresa = $con->prepare($ConsultaNuevaEmpresa);
    $sentenciaNuevaEmpresa->bind_param(
        "si",
        $NuevaNEmpresa,
        $identificadorCliente
    );
    $sentenciaNuevaEmpresa->execute();

    $filasNuevaEmpresa = $sentenciaNuevaEmpresa->affected_rows;

    $ConsultaNContrato = "INSERT INTO contrato (contrato, detalle, idcliente) 
        VALUES ('$completoDocName', ?, (SELECT idcliente FROM cliente where nCURP=?)) ;";
    $sentenciaNContrato = $con->prepare($ConsultaNContrato);
    $sentenciaNContrato->bind_param(
        "si",
        $EmpresaDetalle,
        $identificadorCliente
    );
    $sentenciaNContrato->execute();

    $filasContrato = $sentenciaNContrato->affected_rows;

    $ConsultaUpdateInfo = "UPDATE info 
                            SET costo_plan = ? 
                            WHERE idcliente = (SELECT idcliente FROM cliente where nCURP=?) ;";
    $sentenciaUpdateInfo = $con->prepare($ConsultaUpdateInfo);
    $sentenciaUpdateInfo->bind_param(
        "si",
        $EmpresaCosto,
        $identificadorCliente
    );
    $sentenciaUpdateInfo->execute();

    $filasUpdateInfo = $sentenciaUpdateInfo->affected_rows;

    if ($filasNuevaEmpresa > 0 && $filasContrato > 0 && $filasUpdateInfo > 0) {
        $con->commit();
        echo "correcto";
        if (in_array($extension, $admitidos)) {
            if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$completoDocName")) {
                // echo "correctoFoto";
            } else {
                echo "Ocurrió un error";
            }
        } else {
            $respuesta = "errorfotoformato";
        }
    } else {
        echo "Error al insertar registros";
        // echo $completoDocName . '-------' . $sentenciaNContrato;
        $con->rollBack();
    }
}
// echo $identificadorCliente .'  |'. $NuevaNEmpresa .'  |'. $EmpresaCosto .'   |'. $NombreActualDocumento .'   |'. $NombreTemporalDocumento.'|' ;