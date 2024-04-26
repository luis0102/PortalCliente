<?php
session_start();
ob_start();
require '../BD/conexion.php';
$DocumentoTipoPersona = isset($_POST['DocumentoTipoPersona']) ? $_POST['DocumentoTipoPersona'] : 0;
$DocumentoTipoDocumento = isset($_POST['DocumentoTipoDocumento']) ? $_POST['DocumentoTipoDocumento'] : 0;
$DocumentoEstado = isset($_POST['DocumentoEstado']) ? $_POST['DocumentoEstado'] : null;
$identificadorCliente = isset($_POST['identificadorCliente']) ? $_POST['identificadorCliente'] : '';
$identificadorEmpresa = isset($_POST['identificadorEmpresa']) ? $_POST['identificadorEmpresa'] : null;
$DocumentoMes = isset($_POST['DocumentoMes']) ? $_POST['DocumentoMes'] : '';
$DocumentoAnio = isset($_POST['DocumentoAnio']) ? $_POST['DocumentoAnio'] : '';
$DocumentoISR = isset($_POST['DocumentoISR']) ? $_POST['DocumentoISR'] : '';
$DocumentoIVA = isset($_POST['DocumentoIVA']) ? $_POST['DocumentoIVA'] : '';
// recibiendo datos del archivo 
$NombreActualDocumento = isset($_FILES['DocumentoArchivo']['name']) ? $_FILES['DocumentoArchivo']['name'] : '';
$NombreTemporalDocumento = isset($_FILES['DocumentoArchivo']['tmp_name']) ? $_FILES['DocumentoArchivo']['tmp_name'] : '';

$DocumentoDetalle = isset($_POST['DocumentoDetalle']) ? $_POST['DocumentoDetalle'] : 'Ninguno';

// if ($DocumentoTipoPersona == 0 || $DocumentoTipoDocumento == 0 || $DocumentoEstado == 0 || $identificadorEmpresa == '' || $DocumentoMes == '' || $DocumentoAnio == '' || $DocumentoISR == '' || $DocumentoIVA == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' ) {
//     echo "void";

$admitidos = array('.pdf', '.PDF');
$nombreEncriptado = date('Y-m-d') . '_' . rand(1, 10) . '_' . rand(11, 100) . '_' . rand(101, 1000) . '_' . rand(1001, 10000);
$extension = substr($NombreActualDocumento, strrpos($NombreActualDocumento, '.'));
if ($DocumentoTipoPersona == 1 && $DocumentoTipoDocumento == 1) {
    if ($DocumentoMes == '' || $DocumentoAnio == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' || $DocumentoEstado == 0 || $identificadorCliente == '') {
        echo "void";
    } else {
        $completoDocName = $nombreEncriptado . $extension;
        $con->begin_transaction();
        $ConsultaMoral11 = "INSERT INTO doc_tributacion (mes, anio, ISR, IVA, ruta, detalle, fecha_registro, idinfo, idtipo, idtipo_documento, idempresa, idestado_doc) 
            VALUES ((SELECT
                                CASE
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '01' THEN 'ENERO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '02' THEN 'FEBRERO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '03' THEN 'MARZO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '04' THEN 'ABRIL'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '05' THEN 'MAYO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '06' THEN 'JUNIO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '07' THEN 'JULIO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '08' THEN 'AGOSTO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '09' THEN 'SEPTIEMBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '10' THEN 'OCTUBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '11' THEN 'NOVIEMBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '12' THEN 'DICIEMBRE'
                                    ELSE 'MES DESCONOCIDO'
                                END AS mes_completo), ?, ?, ?, '$completoDocName', ?, NOW(), (SELECT idinfo FROM info i, cliente c, persona p WHERE p.idpersona=c.idpersona AND c.idcliente=i.idcliente AND c.nCURP=?), ?, ?, ?, ?)";
        $sentenciaMoral11 = $con->prepare($ConsultaMoral11);
        $sentenciaMoral11->bind_param(
            "sssssiiii",
            $DocumentoAnio,
            $DocumentoISR,
            $DocumentoIVA,
            $DocumentoDetalle,
            $identificadorCliente,
            $DocumentoTipoPersona,
            $DocumentoTipoDocumento,
            $identificadorEmpresa,
            $DocumentoEstado
        );
        $sentenciaMoral11->execute();

        $filasMoral11 = $sentenciaMoral11->affected_rows;

        if ($filasMoral11 > 0) {
            $con->commit();
            echo "correcto";
            if (in_array($extension, $admitidos)) {
                if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$nombreEncriptado$extension")) {
                    // echo "correctoFoto";
                } else {
                    echo "Ocurrió un error";
                }
            } else {
                $respuesta = "errorfotoformato";
            }
        } else {
            echo "Error al insertar registros";
            echo $completoDocName . '-------' . $sentenciaMoral11;
            $con->rollBack();
        }
    }
} else {
    if ($DocumentoTipoPersona == 1 && $DocumentoTipoDocumento == 2) {
        if ($DocumentoMes == '' || $DocumentoAnio == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' || $DocumentoEstado == 0 || $identificadorCliente == '') {
            echo "void";
        } else {
            $completoDocName = $nombreEncriptado . $extension;
            $con->begin_transaction();
            $ConsultaMoral11 = "INSERT INTO doc_tributacion (mes, anio, ISR, IVA, ruta, detalle, fecha_registro, idinfo, idtipo, idtipo_documento, idempresa, idestado_doc) 
                VALUES ((SELECT
                                CASE
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '01' THEN 'ENERO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '02' THEN 'FEBRERO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '03' THEN 'MARZO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '04' THEN 'ABRIL'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '05' THEN 'MAYO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '06' THEN 'JUNIO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '07' THEN 'JULIO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '08' THEN 'AGOSTO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '09' THEN 'SEPTIEMBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '10' THEN 'OCTUBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '11' THEN 'NOVIEMBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '12' THEN 'DICIEMBRE'
                                    ELSE 'MES DESCONOCIDO'
                                END AS mes_completo), ?, ?, ?, '$completoDocName', ?, NOW(), (SELECT idinfo FROM info i, cliente c, persona p WHERE p.idpersona=c.idpersona AND c.idcliente=i.idcliente AND c.nCURP=?), ?, ?, ?, ?)";
            $sentenciaMoral11 = $con->prepare($ConsultaMoral11);
            $sentenciaMoral11->bind_param(
                "sssssiiii",
                $DocumentoAnio,
                $DocumentoISR,
                $DocumentoIVA,
                $DocumentoDetalle,
                $identificadorCliente,
                $DocumentoTipoPersona,
                $DocumentoTipoDocumento,
                $identificadorEmpresa,
                $DocumentoEstado
            );
            $sentenciaMoral11->execute();

            $filasMoral11 = $sentenciaMoral11->affected_rows;

            if ($filasMoral11 > 0) {
                $con->commit();
                echo "correcto";
                if (in_array($extension, $admitidos)) {
                    if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$nombreEncriptado$extension")) {
                        // // echo "correctoFoto";
                    } else {
                        echo "Ocurrió un error";
                    }
                } else {
                    $respuesta = "errorfotoformato";
                }
            } else {
                echo "Error al insertar registros";
                echo $completoDocName . '-------' . $sentenciaMoral11;
                $con->rollBack();
            }
        }
    } else {
        if ($DocumentoTipoPersona == 1 && $DocumentoTipoDocumento == 4) {
            if ($DocumentoMes == '' || $DocumentoAnio == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' || $identificadorCliente == '') {
                echo "void";
            } else {
                $completoDocName = $nombreEncriptado . $extension;
                $con->begin_transaction();
                $ConsultaMoral11 = "INSERT INTO doc_tributacion (mes, anio, ISR, IVA, ruta, detalle, fecha_registro, idinfo, idtipo, idtipo_documento, idempresa, idestado_doc) 
                    VALUES ((SELECT
                            CASE
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '01' THEN 'ENERO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '02' THEN 'FEBRERO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '03' THEN 'MARZO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '04' THEN 'ABRIL'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '05' THEN 'MAYO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '06' THEN 'JUNIO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '07' THEN 'JULIO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '08' THEN 'AGOSTO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '09' THEN 'SEPTIEMBRE'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '10' THEN 'OCTUBRE'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '11' THEN 'NOVIEMBRE'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '12' THEN 'DICIEMBRE'
                                ELSE 'MES DESCONOCIDO'
                            END AS mes_completo)
                            , ?, ?, ?, '$completoDocName', ?, NOW(), (SELECT idinfo FROM info i, cliente c, persona p WHERE p.idpersona=c.idpersona AND c.idcliente=i.idcliente AND c.nCURP=?), ?, ?, ?, null)";
                $sentenciaMoral11 = $con->prepare($ConsultaMoral11);
                $sentenciaMoral11->bind_param(
                    "sssssiii",
                    $DocumentoAnio,
                    $DocumentoISR,
                    $DocumentoIVA,
                    $DocumentoDetalle,
                    $identificadorCliente,
                    $DocumentoTipoPersona,
                    $DocumentoTipoDocumento,
                    $identificadorEmpresa
                );
                $sentenciaMoral11->execute();

                $filasMoral11 = $sentenciaMoral11->affected_rows;

                if ($filasMoral11 > 0) {
                    $con->commit();
                    echo "correcto";
                    if (in_array($extension, $admitidos)) {
                        if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$nombreEncriptado$extension")) {
                            // // echo "correctoFoto";
                        } else {
                            echo "Ocurrió un error";
                        }
                    } else {
                        $respuesta = "errorfotoformato";
                    }
                } else {
                    echo "Error al insertar registros";
                    // // echo $completoDocName . '-------' . $sentenciaMoral11;
                    echo $DocumentoEstado;
                    $con->rollBack();
                }
            }
        } else {
            if ($DocumentoTipoPersona == 2 && $DocumentoTipoDocumento == 1) {
                if ($DocumentoMes == '' || $DocumentoAnio == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' || $DocumentoEstado == 0 || $identificadorCliente == '' || $identificadorEmpresa == null) {
                    echo "void";
                } else {
                    $completoDocName = $nombreEncriptado . $extension;
                    $con->begin_transaction();
                    $ConsultaMoral11 = "INSERT INTO doc_tributacion (mes, anio, ISR, IVA, ruta, detalle, fecha_registro, idinfo, idtipo, idtipo_documento, idempresa, idestado_doc) 
                        VALUES ((SELECT
                            CASE
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '01' THEN 'ENERO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '02' THEN 'FEBRERO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '03' THEN 'MARZO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '04' THEN 'ABRIL'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '05' THEN 'MAYO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '06' THEN 'JUNIO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '07' THEN 'JULIO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '08' THEN 'AGOSTO'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '09' THEN 'SEPTIEMBRE'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '10' THEN 'OCTUBRE'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '11' THEN 'NOVIEMBRE'
                                WHEN SUBSTRING('$DocumentoMes', 6, 2) = '12' THEN 'DICIEMBRE'
                                ELSE 'MES DESCONOCIDO'
                            END AS mes_completo), ?, ?, ?, '$completoDocName', ?, NOW(), (SELECT idinfo FROM info i, cliente c, persona p WHERE p.idpersona=c.idpersona AND c.idcliente=i.idcliente AND c.nCURP=?), ?, ?, ?, ?)";
                    $sentenciaMoral11 = $con->prepare($ConsultaMoral11);
                    $sentenciaMoral11->bind_param(
                        "sssssiiii",
                        $DocumentoAnio,
                        $DocumentoISR,
                        $DocumentoIVA,
                        $DocumentoDetalle,
                        $identificadorCliente,
                        $DocumentoTipoPersona,
                        $DocumentoTipoDocumento,
                        $identificadorEmpresa,
                        $DocumentoEstado
                    );
                    $sentenciaMoral11->execute();

                    $filasMoral11 = $sentenciaMoral11->affected_rows;

                    if ($filasMoral11 > 0) {
                        $con->commit();
                        echo "correcto";
                        if (in_array($extension, $admitidos)) {
                            if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$nombreEncriptado$extension")) {
                                // echo "correctoFoto";
                            } else {
                                echo "Ocurrió un error";
                            }
                        } else {
                            $respuesta = "errorfotoformato";
                        }
                    } else {
                        echo "Error al insertar registros";
                        echo $completoDocName . '-------' . $sentenciaMoral11;
                        $con->rollBack();
                    }
                }
            } else {
                if ($DocumentoTipoPersona == 2 && $DocumentoTipoDocumento == 2) {
                    if ($DocumentoMes == '' || $DocumentoAnio == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' || $DocumentoEstado == 0 || $identificadorCliente == '' || $identificadorEmpresa == null) {
                        echo "void";
                        echo $DocumentoMes.'|'.$DocumentoAnio.'|'.$NombreActualDocumento.'|'.$NombreTemporalDocumento.'|'.$DocumentoEstado.'|'.$identificadorCliente.'|'.$identificadorEmpresa.'|';
                    } else {
                        $completoDocName = $nombreEncriptado . $extension;
                        $con->begin_transaction();
                        $ConsultaMoral11 = "INSERT INTO doc_tributacion (mes, anio, ISR, IVA, ruta, detalle, fecha_registro, idinfo, idtipo, idtipo_documento, idempresa, idestado_doc) 
                            VALUES ((SELECT
                                CASE
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '01' THEN 'ENERO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '02' THEN 'FEBRERO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '03' THEN 'MARZO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '04' THEN 'ABRIL'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '05' THEN 'MAYO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '06' THEN 'JUNIO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '07' THEN 'JULIO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '08' THEN 'AGOSTO'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '09' THEN 'SEPTIEMBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '10' THEN 'OCTUBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '11' THEN 'NOVIEMBRE'
                                    WHEN SUBSTRING('$DocumentoMes', 6, 2) = '12' THEN 'DICIEMBRE'
                                    ELSE 'MES DESCONOCIDO'
                                END AS mes_completo), ?, ?, ?, '$completoDocName', ?, NOW(), (SELECT idinfo FROM info i, cliente c, persona p WHERE p.idpersona=c.idpersona AND c.idcliente=i.idcliente AND c.nCURP=?), ?, ?, ?, ?)";
                        $sentenciaMoral11 = $con->prepare($ConsultaMoral11);
                        $sentenciaMoral11->bind_param(
                            "sssssiiii",
                            $DocumentoAnio,
                            $DocumentoISR,
                            $DocumentoIVA,
                            $DocumentoDetalle,
                            $identificadorCliente,
                            $DocumentoTipoPersona,
                            $DocumentoTipoDocumento,
                            $identificadorEmpresa,
                            $DocumentoEstado
                        );
                        $sentenciaMoral11->execute();

                        $filasMoral11 = $sentenciaMoral11->affected_rows;

                        if ($filasMoral11 > 0) {
                            $con->commit();
                            echo "correcto";
                            if (in_array($extension, $admitidos)) {
                                if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$nombreEncriptado$extension")) {
                                    // echo "correctoFoto";
                                } else {
                                    echo "Ocurrió un error";
                                }
                            } else {
                                $respuesta = "errorfotoformato";
                            }
                        } else {
                            echo "Error al insertar registros";
                            echo $completoDocName . '-------' . $sentenciaMoral11;
                            $con->rollBack();
                        }
                    }
                } else {
                    if ($DocumentoTipoPersona == 2 && $DocumentoTipoDocumento == 3) {
                        if ($DocumentoMes == '' || $DocumentoAnio == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == '' || $DocumentoEstado == 0 || $identificadorCliente == '' || $identificadorEmpresa == null) {
                            echo "void";
                            echo $DocumentoMes.'|'.$DocumentoAnio.'|'.$NombreActualDocumento.'|'.$NombreTemporalDocumento.'|'.$DocumentoEstado.'|'.$identificadorCliente.'|'.$identificadorEmpresa.'|';
                        } else {
                            $completoDocName = $nombreEncriptado . $extension;
                            $con->begin_transaction();
                            $ConsultaMoral11 = "INSERT INTO doc_tributacion (mes, anio, ISR, IVA, ruta, detalle, fecha_registro, idinfo, idtipo, idtipo_documento, idempresa, idestado_doc) 
                                VALUES ((SELECT
                                    CASE
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '01' THEN 'ENERO'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '02' THEN 'FEBRERO'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '03' THEN 'MARZO'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '04' THEN 'ABRIL'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '05' THEN 'MAYO'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '06' THEN 'JUNIO'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '07' THEN 'JULIO'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '08' THEN 'AGOSTO'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '09' THEN 'SEPTIEMBRE'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '10' THEN 'OCTUBRE'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '11' THEN 'NOVIEMBRE'
                                        WHEN SUBSTRING('$DocumentoMes', 6, 2) = '12' THEN 'DICIEMBRE'
                                        ELSE 'MES DESCONOCIDO'
                                    END AS mes_completo), ?, ?, ?, '$completoDocName', ?, NOW(), (SELECT idinfo FROM info i, cliente c, persona p WHERE p.idpersona=c.idpersona AND c.idcliente=i.idcliente AND c.nCURP=?), ?, ?, ?, ?)";
                            $sentenciaMoral11 = $con->prepare($ConsultaMoral11);
                            $sentenciaMoral11->bind_param(
                                "sssssiiii",
                                $DocumentoAnio,
                                $DocumentoISR,
                                $DocumentoIVA,
                                $DocumentoDetalle,
                                $identificadorCliente,
                                $DocumentoTipoPersona,
                                $DocumentoTipoDocumento,
                                $identificadorEmpresa,
                                $DocumentoEstado
                            );
                            $sentenciaMoral11->execute();
    
                            $filasMoral11 = $sentenciaMoral11->affected_rows;
    
                            if ($filasMoral11 > 0) {
                                $con->commit();
                                echo "correcto";
                                if (in_array($extension, $admitidos)) {
                                    if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$nombreEncriptado$extension")) {
                                        // echo "correctoFoto";
                                    } else {
                                        echo "Ocurrió un error";
                                    }
                                } else {
                                    $respuesta = "errorfotoformato";
                                }
                            } else {
                                echo "Error al insertar registros";
                                echo $completoDocName . '-------' . $sentenciaMoral11;
                                $con->rollBack();
                            }
                        }
                    }else {
                        if ($DocumentoTipoPersona == 2 && $DocumentoTipoDocumento == 4) {
                            if ($DocumentoMes == '' || $DocumentoAnio == '' || $NombreActualDocumento == '' || $NombreTemporalDocumento == ''  || $identificadorCliente == '' || $identificadorEmpresa == null) {
                                echo "void";
                                echo $DocumentoMes.'|'.$DocumentoAnio.'|'.$NombreActualDocumento.'|'.$NombreTemporalDocumento.'|'.$DocumentoEstado.'|'.$identificadorCliente.'|'.$identificadorEmpresa.'|';
                            } else {
                                $completoDocName = $nombreEncriptado . $extension;
                                $con->begin_transaction();
                                $ConsultaMoral11 = "INSERT INTO doc_tributacion (mes, anio, ISR, IVA, ruta, detalle, fecha_registro, idinfo, idtipo, idtipo_documento, idempresa, idestado_doc) 
                                    VALUES ((SELECT
                                        CASE
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '01' THEN 'ENERO'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '02' THEN 'FEBRERO'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '03' THEN 'MARZO'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '04' THEN 'ABRIL'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '05' THEN 'MAYO'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '06' THEN 'JUNIO'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '07' THEN 'JULIO'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '08' THEN 'AGOSTO'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '09' THEN 'SEPTIEMBRE'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '10' THEN 'OCTUBRE'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '11' THEN 'NOVIEMBRE'
                                            WHEN SUBSTRING('$DocumentoMes', 6, 2) = '12' THEN 'DICIEMBRE'
                                            ELSE 'MES DESCONOCIDO'
                                        END AS mes_completo), ?, ?, ?, '$completoDocName', ?, NOW(), (SELECT idinfo FROM info i, cliente c, persona p WHERE p.idpersona=c.idpersona AND c.idcliente=i.idcliente AND c.nCURP=?), ?, ?, ?, null)";
                                $sentenciaMoral11 = $con->prepare($ConsultaMoral11);
                                $sentenciaMoral11->bind_param(
                                    "sssssiii",
                                    $DocumentoAnio,
                                    $DocumentoISR,
                                    $DocumentoIVA,
                                    $DocumentoDetalle,
                                    $identificadorCliente,
                                    $DocumentoTipoPersona,
                                    $DocumentoTipoDocumento,
                                    $identificadorEmpresa
                                );
                                $sentenciaMoral11->execute();
        
                                $filasMoral11 = $sentenciaMoral11->affected_rows;
        
                                if ($filasMoral11 > 0) {
                                    $con->commit();
                                    echo "correcto";
                                    if (in_array($extension, $admitidos)) {
                                        if (move_uploaded_file($NombreTemporalDocumento, "../documentos/$nombreEncriptado$extension")) {
                                            // echo "correctoFoto";
                                        } else {
                                            echo "Ocurrió un error";
                                        }
                                    } else {
                                        $respuesta = "errorfotoformato";
                                    }
                                } else {
                                    echo "Error al insertar registros";
                                    echo $completoDocName . '-------' . $sentenciaMoral11;
                                    $con->rollBack();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
