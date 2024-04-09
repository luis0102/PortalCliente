<?php 
    $CONSULTA = "   START TRANSACTION;
    INSERT INTO usuario(email, psw, idestadou)
    VALUES('$ClienteEmail','$ClientePassword',1);

    SELECT LAST_INSERT_ID() INTO @idusuario;

    INSERT INTO persona(nombre, apellido, telefono, idusuario)
    VALUES('$ClienteNombres','$ClienteApellidos','$ClienteTelef', @idusuario);

    SELECT LAST_INSERT_ID() INTO @idpersona;

    INSERT INTO foto(fotocol, idusuario)
    VALUES('', @idusuario);

    INSERT INTO cliente(idpersona) VALUES (@idpersona);

    SELECT LAST_INSERT_ID() INTO @idcliente;

    INSERT INTO info(servicio, fecha_afiliacion, costo_plan, idtipo_plan, idasesor, idcliente) 
    SELECT  '$ClienteServicioContratado',STR_TO_DATE('$ClienteFecha_af', '%d-%m-%Y'),'$ClienteCosto','$ClientePlanServicio',idasesor,@idcliente 
    FROM asesor 
    WHERE folio='$ClienteAsesor';

    INSERT INTO contrato(contrato, detalle, idcliente) 
    VALUES ('$NombreEncriptadoDoc','$ClienteDetalleContrato',@idcliente); $AddConsulta COMMIT;";
    echo $CONSULTA;
$Consulta_cliente = mysqli_query($con,$CONSULTA)or die(mysqli_error($con));;
if ($Consulta_cliente) {
echo "correcto";

} else {
echo "error";
echo $CONSULTA;
}

?>