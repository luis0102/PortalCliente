<?php
session_start();
ob_start();
require '../BD/conexion.php';
$titular = isset($_POST['email']) ? $_POST['email'] : '';
$clave = isset($_POST['password']) ? $_POST['password'] : '';
$html = '';

if ($titular == "" || $clave == "") {
    $html .= "void";
} else {
    $cont = 0;
    $html = '';

    // Utiliza una sentencia preparada
    $stmt = $con->prepare("SELECT idusuario FROM usuario WHERE email = ? AND psw = ? AND idestadou = 1");
    $stmt->bind_param("ss", $titular, $clave);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Usuario válido
        $_SESSION['nus_PORTALCONSULTANCY'] = $titular;
        $_SESSION['estado_PORTALCONSULTANCY'] = "on";

        // Obtén el nombre del cliente de manera segura

        $stmt->bind_result($ObtenerID);
        $stmt->fetch();

        $Consulta_cliente = mysqli_query($con, "SELECT CONCAT(p.nombre, ' ', p.apellido) AS dat1 
                                                FROM usuario u, persona p 
                                                WHERE u.idusuario = p.idusuario AND u.email = '$titular' AND p.idusuario = $ObtenerID;");
        while ($valorft = mysqli_fetch_array($Consulta_cliente)) {
            $Ncliente = $valorft['dat1'];
        }
        $_SESSION['cliente_PORTALCONSULTANCY'] = $Ncliente;
        $ContadordeExistCliente = 0;
        $ConsultaExistCliente = mysqli_query($con, "select * from usuario u, persona p, cliente c where u.idusuario=p.idusuario and p.idpersona=c.idpersona and u.email='$titular' and p.idusuario = $ObtenerID ;");
        while ($valorft1 = mysqli_fetch_array($ConsultaExistCliente)) {
            $ContadordeExistCliente++;
        }
        $ContadordeExistAsesor = 0;
        $ConsultaExistAsesor = mysqli_query($con, "select * from usuario u, persona p, asesor a where u.idusuario=p.idusuario and p.idpersona=a.idpersona and u.email='$titular' and p.idusuario = $ObtenerID ;");
        while ($valorft2 = mysqli_fetch_array($ConsultaExistAsesor)) {
            $ContadordeExistAsesor++;
        }
        if ($ContadordeExistCliente > 0) {
            $_SESSION['RolUsuario'] = 1;
            $html .= 1;
        } else {
            if ($ContadordeExistAsesor > 0) {
                $_SESSION['RolUsuario'] = 2;
                $html .= 2;
            }
        }
    } else {
        $html .= 'Usuario o contraseña incorrectos...';
    }
}

echo $html;
