<?php
session_start();
ob_start();
require '../BD/conexion.php';
$identificadorCliente2 = isset($_POST['identificadorCliente2']) ? $_POST['identificadorCliente2'] : null;
$DocumentoUpdateTipoPersona = isset($_POST['DocumentoUpdateTipoPersona']) ? $_POST['DocumentoUpdateTipoPersona'] : null;
$DocumentoUpdateTipoDocumento = isset($_POST['DocumentoUpdateTipoDocumento']) ? $_POST['DocumentoUpdateTipoDocumento'] : null;
// $VariableDeBusqueda = " and c.nCURP LIKE '%$ModalBuscarCliente%'";


$ConsultarCliente = "SELECT d.mes as dat1, d.isr as dat2, d.iva as dat3, d.isr+d.iva as dat4, d.idestado_doc as dat5, d.ruta as dat6, iddoc_tributacion as dat7
FROM cliente c, info i, doc_tributacion d, tipo t, tipo_documento td 
WHERE C.nCURP='$identificadorCliente2' AND c.idcliente=i.idcliente AND i.idinfo=d.idinfo AND d.idtipo=t.idtipo AND d.idtipo_documento=td.idtipo_documento AND d.idtipo=$DocumentoUpdateTipoPersona AND d.idtipo_documento=$DocumentoUpdateTipoDocumento  limit 10;";
$resultadoConsultaCliente = mysqli_query($con, $ConsultarCliente);
$num_rows = $resultadoConsultaCliente->num_rows;
$html = '';
$numreg = 0;
if ($num_rows > 0) {
    while ($row = $resultadoConsultaCliente->fetch_assoc()) {
        $numreg++;
        $html .= '<tr id="SelectRegistroForUpdateDocumento" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#ModalEditarDocumento" data-valor-nombre="' . $row['dat1'] . '" valor-id="' . $row['dat7'] . '" data-id="' . $row['dat7'] . '">
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>' . $numreg . '</strong></td>                        
                        <td><b>' . $row['dat2'] . '</b></td>
                        <td><b>' . $row['dat3'] . '</b></td>
                        <td><b>' . $row['dat1'] . '</b></td>
                        <td><b>';

        if ($row['dat5'] == 1) {
            $html .= '<span class="badge bg-label-warning me-1">Pendiente</span>';
        } else {
            if ($row['dat5'] == 2) {
                $html .= '<span class="badge bg-label-success me-1">Completado</span>';
            }
        }
        $html .= '</b></td>
                        <td><button type="button" class="btn btn-icon btn-outline-danger">
                        <span class="tf-icons bx bx-trash"></span>
                      </button></td>
                </tr>';
    }
} else {
    $html .= '<tr><td colspan="13"><b>No hay resultados para: </b></td></tr>';
}
// echo $identificadorCliente2.'|'.$DocumentoUpdateTipoPersona.'|'.$DocumentoUpdateTipoDocumento;
echo json_encode($html, JSON_UNESCAPED_UNICODE);
