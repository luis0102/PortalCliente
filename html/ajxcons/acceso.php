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
    // $html.= 'no';

    $cont = 0;
    $html = '';
    $resultados = mysqli_query($con, "select idusuario from usuario where email = '$titular' and psw = '$clave' and idestadou=1");
    while ($ArrayConsulta = mysqli_fetch_array($resultados)) {
        $ObtenerID=$ArrayConsulta['idusuario'];
        $cont++;
    }
    if ($cont <> 0) {
        $_SESSION['nus_PORTALCONSULTANCY'] = $titular;
        $_SESSION['estado_PORTALCONSULTANCY'] = "on";
        //$cxfotico = mysqli_query($con,"select p.perflft as dat1 from usuario u,perfl p where u.idusuario=p.idusuario and u.usuario='$titular';");
        //while($valorft = mysqli_fetch_array($cxfotico)) { $fotico=$valorft['dat1'];}
        //$_SESSION['fotograf']=$fotico;
        $Consulta_cliente = mysqli_query($con, "select concat(p.nombre,' ',p.apellido) as dat1 
                                                from usuario u,persona p 
                                                where u.idusuario=p.idusuario and u.email='$titular' and p.idusuario=$ObtenerID;");
        while ($valorft = mysqli_fetch_array($Consulta_cliente)) {
            $Ncliente = $valorft['dat1'];
        }
        $_SESSION['cliente_PORTALCONSULTANCY'] = $Ncliente;
        $html .= "correcto";
        // header('Location: ../');

    } else {
        if ($cont == 0) {
            
            $html .= 'Usuario o contraseña incorrectos...';
        }
    }
    //$_SESSION['u']=$user;                  
    #include 'cerrar_conexion.php';                                            
}

echo $html;
