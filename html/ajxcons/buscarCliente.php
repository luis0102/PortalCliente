<?php
session_start();
ob_start();
require '../BD/conexion.php';
$ModalBuscarCliente = isset($_POST['ModalBuscarCliente']) ? $_POST['ModalBuscarCliente'] : null;



$VariableDeBusqueda = " and c.nCURP LIKE '%$ModalBuscarCliente%'";


$ConsultarCliente = "SELECT idcliente as id,CONCAT(p.apellido,' ',p.nombre) as dat1, c.nCURP as dat2 FROM cliente c, persona p WHERE c.idpersona=p.idpersona $VariableDeBusqueda limit 10;";
$resultadoConsultaCliente = mysqli_query($con, $ConsultarCliente);
$num_rows = $resultadoConsultaCliente->num_rows;
$html='';
$numreg = 0;
if ($num_rows > 0) {
    while ($row = $resultadoConsultaCliente->fetch_assoc()) {
        $numreg++;
        $html .= '<tr id="SelectClienteDocumento" style="cursor: pointer;" data-bs-dismiss="modal" data-valor-nombre="'.$row['dat1'].'" valor-id="'.$row['dat2'].'" data-id="'.$row['dat2'].'">
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>' . $numreg . '</strong></td>
                        <td><b>' . $row['dat1'] . '</b></td>
                        <td><b>' . $row['dat2'] . '</b></td>                        
                </tr>';
    }
} else {
    $html .= '<tr><td colspan="13"><b>No hay resultados para: ' . $ModalBuscarCliente . '</b></td></tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
