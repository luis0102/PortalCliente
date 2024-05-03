<?php
session_start();
ob_start();
require '../BD/conexion.php';
$ModalBuscarAsesor = isset($_POST['ModalBuscarAsesor']) ? $_POST['ModalBuscarAsesor'] : '';



$VariableDeBusqueda = " and p.nombre LIKE '%$ModalBuscarAsesor%' and p.apellido LIKE '%$ModalBuscarAsesor%'";


$ConsultarCliente = "SELECT a.folio  as dat1, CONCAT(p.nombre,'',p.apellido) as dat2 FROM asesor a, persona p where p.idpersona=a.idpersona $VariableDeBusqueda limit 10;";
$resultadoConsultaCliente = mysqli_query($con, $ConsultarCliente);
$num_rows = $resultadoConsultaCliente->num_rows;
$html='';
$numreg = 0;
if ($num_rows > 0) {
    while ($row = $resultadoConsultaCliente->fetch_assoc()) {
        $numreg++;
        $html .= '<tr id="SelectAsesor" style="cursor: pointer;" data-bs-dismiss="modal" data-valor-nombre="'.$row['dat1'].'" valor-id="'.$row['dat2'].'" data-id="'.$row['dat2'].'">
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>' . $numreg . '</strong></td>
                        <td><b>' . $row['dat1'] . '</b></td>
                        <td><b>' . $row['dat2'] . '</b></td>                        
                </tr>';
    }
} else {
    $html .= '<tr><td colspan="13"><b>No hay resultados para: ' . $ModalBuscarAsesor . '</b></td></tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
