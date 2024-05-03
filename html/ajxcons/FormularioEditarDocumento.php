<?php
session_start();
ob_start();
require '../BD/conexion.php';
$IdentificadorForUdapteDocumento = isset($_POST['IdentificadorForUdapteDocumento']) ? $_POST['IdentificadorForUdapteDocumento'] : null;

// $VariableDeBusqueda = " and c.nCURP LIKE '%$ModalBuscarCliente%'";


$ConsultarCliente = "SELECT d.iddoc_tributacion as dat1, d.mes as dat2, d.anio as dat3, d.isr as dat4,d.iva as dat5,d.detalle as dat6
FROM doc_tributacion d
WHERE d.iddoc_tributacion=$IdentificadorForUdapteDocumento ;";
$resultadoConsultaCliente = mysqli_query($con, $ConsultarCliente);
$num_rows = $resultadoConsultaCliente->num_rows;
$html = '';
$numreg = 0;
if ($num_rows > 0) {
    while ($row = $resultadoConsultaCliente->fetch_assoc()) {
        $numreg++;
        $html .= '<div class="row mb-3">
        <label for="EditarDocumentoMes" class="col-sm-2 col-form-label">MES (*)</label>
        <div class="col-sm-10">
            <input class="form-control" list="datalistOptions" id="EditarDocumentoMes" value="' . $row['dat2'] . '" placeholder="Seleccione un mes de la lista" />
            <datalist id="datalistOptions">
                <option value="ENERO"></option>
                <option value="FEBRERO"></option>
                <option value="MARZO"></option>
                <option value="ABRIL"></option>
                <option value="MAYO"></option>
                <option value="JUNIO"></option>
                <option value="JULIO"></option>
                <option value="AGOSTO"></option>
                <option value="SEPTIEMBRE"></option>
                <option value="OCTUBRE"></option>
                <option value="NOVIEMBRE"></option>
                <option value="DICIEMBRE"></option>
            </datalist>
        </div>
    </div>
    <div id="CajaDocumentoAnio" class="row mb-3">
        <label class="col-sm-2 col-form-label" for="EditarDocumentoAnio">Año <strong>(*)</strong></label>
        <div class="col-sm-10">
            <div class="input-group input-group-merge">
                <input type="text" class="form-control" id="EditarDocumentoAnio" placeholder="Ingrese año" value="' . $row['dat3'] . '" aria-label="Ingrese año" aria-describedby="basic-icon-default-fullname2">
                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
            </div>
        </div>
    </div>
    <div id="CajaEditarDocumentoISR" class="row mb-3">
        <label class="col-sm-2 col-form-label" for="EditarDocumentoISR">ISR</label>
        <div class="col-sm-10">
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                <input type="text" class="form-control" id="EditarDocumentoISR" name="EditarDocumentoISR" value="' . $row['dat4'] . '" placeholder="Ingrese ISR" aria-label="Ingrese ISR" aria-describedby="IconDocumentoISR2">
                <span class="input-group-text">($)</span>
            </div>
        </div>
    </div>
    <div id="CajaEditarDocumentoIVA" class="row mb-3">
        <label class="col-sm-2 form-label" for="EditarDocumentoIVA">IVA</label>
        <div class="col-sm-10">
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                <input type="text" id="EditarDocumentoIVA" name="EditarDocumentoIVA" class="form-control phone-mask" value="' . $row['dat5'] . '" placeholder="Ingrese Monto IVA " aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="EditarDocumentoDetalle">Detalle <strong>(*)</strong></label>
        <div class="col-sm-10">
            <div class="input-group input-group-merge">
                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-detail"></i></span>
                <textarea id="EditarDocumentoDetalle" name="EditarDocumentoDetalle" class="form-control" value="' . $row['dat6'] . '" placeholder="Escriba alguna descripción si es el caso" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md">
    <small class="text-light fw-semibold d-block">ESTADO</small>
    <div class="form-check form-check-inline mt-3">
      <input
        class="form-check-input"
        type="radio"
        name="EditarDocumentoEstado"
        id="EditarDocumentoEstado"
        value="option1"
      />
      <label class="form-check-label" for="inlineRadio1">PENDIENTE</label>
    </div>
    <div class="form-check form-check-inline">
      <input
        class="form-check-input"
        type="radio"
        name="EditarDocumentoEstado"
        id="EditarDocumentoEstado"
        value="option2"
      />
      <label class="form-check-label" for="inlineRadio2">COMPLETADO</label>
    </div>
    </div>';
    }
} else {
    $html .= '<tr><td colspan="13"><b>No hay resultados para: </b></td></tr>';
}
// echo $identificadorCliente2.'|'.$DocumentoUpdateTipoPersona.'|'.$DocumentoUpdateTipoDocumento;
echo json_encode($html, JSON_UNESCAPED_UNICODE);
