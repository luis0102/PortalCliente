<?php
session_start();
ob_start();
require '../BD/conexion.php';
$identificadorCliente= isset($_POST['identificadorCliente']) ? $_POST['identificadorCliente'] : null;
$ModalBuscarEmpresa = isset($_POST['ModalBuscarEmpresa']) ? $_POST['ModalBuscarEmpresa'] : null;



$VariableDeBusqueda = " AND c.nCURP='$identificadorCliente' ";
$VariableDeBusqueda2= "$VariableDeBusqueda AND e.dato LIKE '%$ModalBuscarEmpresa%'";


$ConsultarCliente = "SELECT idempresa as id,e.dato as dat1 FROM cliente c, empresa e WHERE c.idcliente=e.idcliente $VariableDeBusqueda2 limit 10;";
$resultadoConsultaCliente = mysqli_query($con, $ConsultarCliente);
$num_rows = $resultadoConsultaCliente->num_rows;
$html='';
$numreg = 0;
if ($num_rows > 0) {
    while ($row = $resultadoConsultaCliente->fetch_assoc()) {
        $numreg++;
        $html .= '<tr id="SelectEmpresaDocumento" style="cursor: pointer;" data-bs-dismiss="modal" data-valor-nombre="'.$row['dat1'].'" data-id="'.$row['id'].'">
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>' . $numreg . '</strong></td>
                        <td><b>' . $row['dat1'] . '</b></td>
                                               
                </tr>';
    }
} else {
    $html .= '<tr><td colspan="13"><b>No hay resultados para: ' . $ModalBuscarEmpresa . '</b></td></tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);