<?php


    

//echo INGRESO_DATOS1($apellidos,$nombres,$telef,$dni,$direc,$unuevo,$cnuevo);
function INGRESO_DATOS1($v1,$v2,$v3,$v4,$v5,$v6,$v7){
  include "conexion.php";
  
  if ($v1=="" || $v2=="" || $v3=="" || $v4=="" || $v5==""|| $v6==""|| $v7=="") {
    echo "Porfavor complete todos los campos";
    //echo '<script>window.history.go(-1);</script>';
  }else {

  $verificar_existencia = mysqli_query($con,"select * from persona where dni='$v4'");
  if (mysqli_num_rows($verificar_existencia)>0){
    echo "Esta persona ya tiene una cuenta en PUBLICAPerú";
    //echo '<script>window.history.go(-1);</script>';
  exit;
  }else {
    $verificar_existenciaus = mysqli_query($con,"select * from usuario where usuario='$v6'");
    if (mysqli_num_rows($verificar_existenciaus)>0){
    echo '<script> alert("Éste correo electrónico ya está asociado a una cuenta"); 
    window.history.go(-1);
        </script>';
    exit;
    }else {
      $insertar1 = "insert into persona ( ape, nom, tel, dni,dir) VALUES ( '$v1', '$v2', '$v3', '$v4', '$v5')";
      $resultado1= mysqli_query($con,$insertar1);
    
        ################################ obtener el id de ultima persona y ultimo usuario grabado
    $vidup = mysqli_query($con,"select max(idpersona) as ma from persona");
    while($valor = mysqli_fetch_array($vidup))
      {
        $idup=$valor['ma'];        
      }
      $insertar2 = "insert INTO usuario (usuario, psw, idpersona, idestado,idrangoc) VALUES ('$v6','$v7',$idup,1,1)";
      $resultado2= mysqli_query($con,$insertar2);
    ########################### muajajajajaja perros todo lo ven dinero lacras!!!!    
    header("Location: login.php");
    ##
    }
  }
}
//include 'cs.php';
}

function addfoto($adf1,$adf2,$adf3,$adf4){
 include "conexion.php";
 
  if ($adf1=="" || $adf2=="" || $adf3=="") {
    echo "Porfavor seleccione una fotografia permitida.";
    //echo '<script>window.history.go(-1);</script>';
  }else { 
          $verificar_existencia_img = mysqli_query($con,"select * from publi where ruta='$adf1'");
          if (mysqli_num_rows($verificar_existencia_img)>0){
            echo "Una persona ya publicó ésta una fotografía con el mismo nombre en PUBLICAPerú, escoge otro distinto.";
            //echo '<script>window.history.go(-1);</script>';
          //exit;
                                                            }
          else { 
                ###### obtener el id del usuario activo
                $oid = mysqli_query($con,"select idusuario as u from usuario where usuario='$adf2'");
                while($valor = mysqli_fetch_array($oid))
                { $vidu=$valor['u'];} 
                //
                $verificar_tieneimg= mysqli_query($con,"select * from usuario u,perfl p where u.idusuario=p.idusuario and u.idusuario='$vidu';");
                if (mysqli_num_rows($verificar_tieneimg)>0){
                    //                     
                    $espera = unlink("muestras/logs/".$adf4);                                                      
                    //
                    $actualizarfto= mysqli_query($con,"update perfl set perflft='$adf1' where idusuario='$vidu'");
                    if (move_uploaded_file($adf3,"muestras/logs/$adf1")) {
                                            echo "Tu fotografía se ha subido exitósamente (actualice la pagina para visualizar los cambios)";
                                            $_SESSION['fotograf']=$adf1;
                                            header("Location: perfl.php");
                                            }        
                                                            }
                else {
                      $insertar_primerafto= mysqli_query($con,"insert into perfl (perflft,idusuario) values ('$adf1',$vidu);");     
                      if (move_uploaded_file($adf3,"muestras/logs/$adf1")) {
                                            echo "El fotografía se ha subido exitósamente";
                                            $_SESSION['fotograf']=$adf1;
                                            header("Location: perfl.php");
                                            }   
                      
                      }
                }  
        }
}

function publica($vp1,$vp2,$vp3,$vp4,$vp5,$vp6,$valorusu,$nomPrimario,$nomTemporal,$extension){
  include "conexion.php";
  $admitidos=array('.jpg','.jpeg','.png','.JPG','.JPEG','.PNG');
  $respuesta="";
  if ($vp1=="" || $vp2=="" || $vp3=="" || $vp4=="" || $vp5==""|| $vp6==""|| $valorusu=="") {
    $respuesta= "Porfavor complete todos los campos $vp1 | $vp2 | $vp3 | $vp4 | $vp5| $vp6 | $valorusu >>>";
  }else {
  $nombreEncriptado=rand(1,10).'_'.rand(11,100).'_'.rand(101,1000).'_'.rand(1001,10000);
  $verificar_existencia = mysqli_query($con,"select * from publi where ruta='$nombreEncriptado'");
  if (mysqli_num_rows($verificar_existencia)>0){
    $respuesta= "Una persona ya publicó una fotografía con el mismo nombre en PUBLICAPerú";
  //exit;
  }else {                               
      ###### obtener el id del usuario activo
      $oid = mysqli_query($con,"select idusuario as u from usuario where usuario='$valorusu'");
      while($valor = mysqli_fetch_array($oid))
      { $vidu=$valor['u'];}
      $insertar2 = "insert into publi ( titu, descrip,precio,dir,fecha,ruta,idusuario,idtipopub) 
                    VALUES ( '$vp1', '$vp2', '$vp3', '$vp4',curdate(),'$nombreEncriptado$extension',$vidu,$vp6)";
      $resultado2= mysqli_query($con,$insertar2);
    ########################### muajajajajaja perros todo lo ven dinero lacras!!!!  
    
    // INICIO DE GUARDADO DE LA IMAGEN
    if (in_array($extension,$admitidos)) {
        if (move_uploaded_file($nomTemporal,"../muestras/$nombreEncriptado$extension")) {
            $respuesta= "El imagen se ha subido exitósamente";
            } else {
                    $respuesta= "Ocurrió un error";
                    }
            } else {
                    $respuesta= "El archivo que quiere subir no está admitido";
                    }
    //
    if (!$resultado2) {
      $respuesta= 'HUBO UN ERROR INTERNO EN EL REGISTRO. INTÉNTELO MÁS TARDE';
    }else {
      $respuesta= 'SU AVISO SE HA PUBLICADO EXITOSAMENTE';    
         
    }
    ##
    
  }
}
echo $respuesta;
//include 'cs.php';
}
// función para denunciar
function denunciar($dpar1,$dpar2,$dpar3,$dpar4){
 include "conexion.php";
  if ( $dpar1=="" || $dpar2=="" || $dpar3==""|| $dpar4=="") {echo "Porfavor complete el formulario de manera correcta";} 
  else{ 
      ###### obtener el id del usuario activo
      $oid = mysqli_query($con,"select idusuario as u from usuario where usuario='$dpar4'");
      while($valor = mysqli_fetch_array($oid))
      { $vidu=$valor['u'];}
      ##
        $dinsertar1 = "insert into denuncia ( asunto, descrip, fecha,idpubli,idusuario) 
                          VALUES ( '$dpar1', '$dpar2', curdate(),$dpar3,$vidu)";
        $dresultado1= mysqli_query($con,$dinsertar1);
        if (!$dresultado1) {
          echo 'HUBO UN ERROR INTERNO. INTÉNTELO MÁS TARDE';
                            }else {
                              echo '<a href="pruebas.php">Su denucia se ha enviado exitosamente, ahora envie su evidencia en el Formulario #02</a>';
                              //echo '<script> alert("");</script>';
                              //header("Location: verp.php?dt=".$cpar3);   
            
                                  }
        
      }
}
//
function addevidencia($addpar1,$addpar2,$addnomPrimario,$addnomTemporal,$addextension){
 include "conexion.php";
 $addadmitidos=array('.jpg','.jpeg','.png','.pdf','.docx','.pptx','.xlsx');
  if ( $addpar1=="" || $addpar2=="" || $addnomPrimario=="" || $addnomTemporal=="" || $addextension=="") {echo "Porfavor complete el formulario de manera correcta";} 
  else{       
      ##
        $dinsertar1 = "insert into evidencia ( evidencia, ruta, iddenuncia) 
                          VALUES ( '$addpar1', '$addnomPrimario', $addpar2)";
        $dresultado1= mysqli_query($con,$dinsertar1);
        if (!$dresultado1) {
          echo 'HUBO UN ERROR INTERNO. INTÉNTELO MÁS TARDE';
                            }else {
                              ###### obtener el id del usuario activo
                                    if (in_array($addextension,$addadmitidos)) {
                                      if (move_uploaded_file($addnomTemporal,"evidences/$addnomPrimario")) {
                                          echo "El archivo $addnomPrimario se ha subido exitósamente";
                                          } else {
                                                  echo "Ocurrió un error";
                                                  }
                                                                                          
                                          } else {
                                                  echo "El archivo que quiere subir no está admitido";
                                                  }                                    
                                  //
                              //echo '<p>Su evidencia se ha registrado exitosamente, Gracias por colaborar con PublicaPERU</p>';
                              echo '<script> alert("Su evidencia se ha registrado exitosamente, Gracias por colaborar con PublicaPERU");</script>';
                              //header("Location: verp.php?dt=".$cpar3);   
            
                                  }
        
      }
}
//;
// funcion para comentar
function comentar($cpar1, $cpar2, $cpar3){
  include "conexion.php";
  if ( $cpar2=="" || $cpar3=="") {
    echo "Porfavor inicie sesión primero ...";
    //echo '<script>window.history.go(-1);</script>';
  }else {
    ###### obtener el id del usuario activo
      $oid = mysqli_query($con,"select idusuario as u from usuario where usuario='$cpar2'");
      while($valor = mysqli_fetch_array($oid))
      { $vidu=$valor['u'];}
    ##
    $insertar2 = "insert into comenta ( comentar, fech, hor,idusuario,idpubli) 
                    VALUES ( '$cpar1', curdate(), curtime(),$vidu,$cpar3)";
      $resultado2= mysqli_query($con,$insertar2);
      if (!$resultado2) {
          echo 'HUBO UN ERROR INTERNO. INTÉNTELO MÁS TARDE';
        }else {
          header("Location: verp.php?dt=".$cpar3);   
            
        }
  }
}
//
// funcion para recomendar
function recomendar($rvar1, $rvar2){
include "conexion.php";
  if ( $rvar1=="" || $rvar2=="" ) {
    echo "Porfavor inicie sesión primero ...";
    //echo '<script>window.history.go(-1);</script>';
  }else {
    ###### obtener el id del usuario activo
      $oid = mysqli_query($con,"select idusuario as u from usuario where usuario='$rvar2'");
      while($valor1 = mysqli_fetch_array($oid))
      { $vidu=$valor1['u'];}
    ## comprobar si existe una recomendacion hecha a una publicacion
    $consrec = mysqli_query($con,"select count(*) as cct from recomend where idpubli=$rvar1 and idusuario=$vidu;");
      while($valor2 = mysqli_fetch_array($consrec))
      { $cant=$valor2['cct'];}
        if ($cant==0) {
            ## insertar
          $rinsertar2 = "insert into recomend ( idpubli,idusuario) 
                        VALUES ( '$rvar1',$vidu)";
          $rresultado2= mysqli_query($con,$rinsertar2);
          if (!$rresultado2) {
              echo 'HUBO UN ERROR INTERNO. INTÉNTELO MÁS TARDE';
            }else {
              header("Location: index.php");   
                
            }
        } else{header("Location: index.php");}
  // fin primer else
  }
}
//funcion eliminar
function eliminar($el1){
include "conexion.php";
  if ($el1=="" ) {
    echo "Porfavor inicie sesión primero ...";
    //echo '<script>window.history.go(-1);</script>';
  }else {
      $nombreUsuario=$_SESSION['estado_actualPublicaPeru'];
###### obtener el id del usuario activo
      $oid = mysqli_query($con,"select idusuario as u from usuario where usuario='$nombreUsuario';");
      while($valor1 = mysqli_fetch_array($oid))
      { $vidu=$valor1['u'];}
      //

      $redl1 = mysqli_query($con,"select ruta from publi where idpubli=".$el1.";");
       
    //consulta de eliminacion de publicacion
      $dl1 = mysqli_query($con,'delete from comenta WHERE idpubli='.$el1);
      $dl2 = mysqli_query($con,"delete from recomend WHERE idpubli=".$el1);
      $dl3 = mysqli_query($con,"delete from publi WHERE idpubli=".$el1);
    
          
          
          if (!$dl3) {
              echo 'Es posible que el anuncio tenga una denuncia y por ello no permite eliminar la publicacion';
            }else {
                
              while ($imagen=mysqli_fetch_array($redl1)) {
                $espera = unlink("../muestras/".$imagen['ruta']);
                                                }
              echo 'Eliminado correctamente';
            }
         
  // fin primer else

  }
  
}
//$mica->ingreso("","");

?>