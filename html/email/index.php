<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
//$body = file_get_contents('htmlemail/plantilla.php');
session_start();
ob_start();
include_once "../BD/conexion.php";
include  "../reciclables/sesion.php";
$consultaParaEnviarEmail = mysqli_query($con, "select i.servicio as dat1, DATE_FORMAT(i.fecha_afiliacion, '%d-%M-%Y') as dat2, i.costo_plan as dat3, t.nombre_tipo as dat4, c.idcliente as dat5, p.nombre as dat6, CONCAT(LPAD(DAY(fecha_afiliacion), 2, '0'),'-',LPAD(MONTH(CURDATE()), 2, '0')) AS dat7,u.email as dat8
from usuario u,persona p, cliente c, info i , tipo_plan t
where u.idusuario=p.idusuario and p.idpersona=c.idpersona   
and c.idcliente=i.idcliente and i.idtipo_plan=t.idtipo_plan;");
while ($valorft = mysqli_fetch_array($consultaParaEnviarEmail)) {
  $servicio = $valorft['dat1'];
  $fechaInicio = $valorft['dat2'];
  $costo = $valorft['dat3'];
  $tipoPlan = $valorft['dat4'];
  $idcliente = $valorft['dat5'];
  $nomCliente = $valorft['dat6'];
  $fechaVencimiento = $valorft['dat7'];
  $EmailDestinatarioCliente = $valorft['dat8'];
## ESTRUCTURA DE TODO EL CONTENIDO RECURSIVO

$body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Notificación Mensual</title>

  <style type="text/css">
    /* Take care of image borders and formatting */

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      border: 0;
      outline: none;
    }

    a img {
      border: none;
    }

    /* General styling */

    td,
    h1,
    h2,
    h3 {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    td {
      font-size: 13px;
      line-height: 150%;
      text-align: left;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }

    table {
      border-collapse: collapse !important;
    }


    h1,
    h2,
    h3 {
      padding: 0;
      margin: 0;
      color: #444444;
      font-weight: 400;
      line-height: 110%;
    }

    h1 {
      font-size: 35px;
    }

    h2 {
      font-size: 30px;
    }

    h3 {
      font-size: 24px;
    }

    h4 {
      font-size: 18px;
      font-weight: normal;
    }

    .important-font {
      color: #21BEB4;
      font-weight: bold;
    }

    .hide {
      display: none !important;
    }

    .force-full-width {
      width: 100% !important;
    }

    td.desktop-hide {
      font-size: 0;
      height: 0;
      display: none;
      color: #ffffff;
    }
  </style>

  <style type="text/css" media="screen">
    @media screen {
      @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);

      /* Thanks Outlook 2013! */
      td,
      h1,
      h2,
      h3 {
        font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 600px)">
    /* Mobile styles */
    @media only screen and (max-width: 600px) {

      table[class="w320"] {
        width: 320px !important;
      }

      table[class="w300"] {
        width: 300px !important;
      }

      table[class="w290"] {
        width: 290px !important;
      }

      td[class="w320"] {
        width: 320px !important;
      }

      td[class~="mobile-padding"] {
        padding-left: 14px !important;
        padding-right: 14px !important;
      }

      td[class*="mobile-padding-left"] {
        padding-left: 14px !important;
      }

      td[class*="mobile-padding-right"] {
        padding-right: 14px !important;
      }

      td[class*="mobile-block"] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        padding-bottom: 15px !important;
      }

      td[class*="mobile-no-padding-bottom"] {
        padding-bottom: 0 !important;
      }

      td[class~="mobile-center"] {
        text-align: center !important;
      }

      table[class*="mobile-center-block"] {
        float: none !important;
        margin: 0 auto !important;
      }

      *[class*="mobile-hide"] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        line-height: 0 !important;
        font-size: 0 !important;
      }

      td[class*="mobile-border"] {
        border: 0 !important;
      }

      td[class*="desktop-hide"] {
        display: block !important;
        font-size: 13px !important;
        height: 61px !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        color: #444444 !important;
      }
    }
  </style>
</head>

<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" bgcolor="#ffffff" width="100%">

        <table cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td style="background:#1f1f1f" width="100%">
              <center>
                <table cellspacing="0" cellpadding="0" width="600" class="w320">
                  <tr>
                    <td valign="top" class="mobile-block mobile-no-padding-bottom mobile-center" width="270" style="background:#1f1f1f;padding:10px 10px 10px 20px;">
                      <a href="#" style="text-decoration:none;">
                        <img src="https://portalcliente.consultancysc.com/html/img/icons.png" width="120" height="30" style=" border-radius: 3px; border: 5px;border-color: white ;" alt="Consultancy" />
                      </a>
                    </td>
                    <td valign="top" class="mobile-block mobile-center" width="270" style="background:#1f1f1f;padding:10px 15px 10px 10px">
                      <table border="0" cellpadding="0" cellspacing="0" class="mobile-center-block" align="right">
                        <tr>
                          <td align="right">
                            <a href="#">
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbgrTDquNegyW5vWVpUY6Um08ak9t2qguASOuA_55aTw&s" width="30" height="30" alt="social icon" />
                            </a>
                          </td>
                          <td align="right" style="padding-left:5px">
                            <a href="#">
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdpqsVby5yA0jVHlvL3mfXMBXV_4gq6Uaxt-TGjn9Q5Q&s" width="30" height="30" alt="social icon" />
                            </a>
                          </td>
                          <td align="right" style="padding-left:5px">
                            <a href="#">
                              <img src="https://static.vecteezy.com/system/resources/thumbnails/015/730/519/small/eps10-black-camera-abstract-line-art-icon-isolated-on-white-background-social-media-outline-symbol-in-a-simple-flat-trendy-modern-style-for-your-website-design-logo-and-mobile-application-vector.jpg" width="30" height="30" alt="social icon" />
                            </a>
                          </td>
                          <td align="right" style="padding-left:5px">
                            <a href="#">
                              <img src="https://static.vecteezy.com/system/resources/thumbnails/003/692/704/small/linkedin-american-business-logo-social-media-icon-black-pictogram-illustration-isolated-on-white-backgroud-free-vector.jpg" width="30" height="30" alt="social icon" />
                            </a>
                          </td>

                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </center>
            </td>
          </tr>
          <tr>
            <td style="border-bottom:1px solid #e7e7e7;">
              <center>
                <table cellpadding="0" cellspacing="0" width="600" class="w320">
                  <tr>
                    <td align="left" class="mobile-padding" style="padding:20px">

                      <br class="mobile-hide" />

                      <div>
                        <b>Hola, '.$nomCliente.'</b><br>
                        <br>
                        Teléfono: 462 100 0030<br>
                        <br>
                        Le recordamos que debe de realizar pagos por los servicios de Consultancy antes del día: '.$fechaVencimiento.'.
                        <p>Para más información consulte el portal del cliente.</p>
                        <p>Tenga buen día</p>
                      </div>

                      <br>

                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td style="width:100px;background:#D84A38;">
                            <div>
                              <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="#" style="background-color:#6b049b;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;width:100px;-webkit-text-size-adjust:none;">Ir al Portal</a>
                              <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                            </div>
                          </td>
                          <td width="281" style="background-color:#ffffff; font-size:0; line-height:0;">&nbsp;</td>
                        </tr>
                      </table>
                    </td>
                    <td class="mobile-hide" style="padding-top:20px;padding-bottom:0; vertical-align:bottom;" valign="bottom">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td align="right" valign="bottom" style="padding-bottom:0; vertical-align:bottom;">
                            <img style="vertical-align:bottom;" src="https://png.pngtree.com/png-clipart/20210912/original/pngtree-customer-service-business-cooperation-reception-png-image_6738640.jpg" width="190" height="294" />
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </center>
            </td>
          </tr>
          <tr>
            <td valign="top" style="background-color:#f8f8f8;border-bottom:1px solid #e7e7e7;">

              <center>
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;">
                  <tr>
                    <td valign="top" class="mobile-padding" style="padding:20px;">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td style="padding-right:20px">
                            <b>Servicio Contratado</b>
                          </td>
                          <td style="padding-right:20px">
                            <b>Plan</b>
                          </td>
                          <td style="padding-right:20px">
                            <b>Fecha de afiliación</b>
                          </td>
                          <td>
                            <b>Costo</b>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; ">
                            '.$servicio.'
                          </td>
                          <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                          '.$tipoPlan.'
                          </td>
                          <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                          '.$fechaInicio.'
                          </td>
                          <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                          $ '.$costo.'
                          </td>
                        </tr>
                      </table>
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td style="padding-top:35px;">
                            <table cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                                <td width="350" class="mobile-hide" style="vertical-align:top;">
                                  Gracias por elegir Consultancy, estaremos atentos a cualquier duda. <a href="#">Contáctenos</a> <br>
                                  <h4>*No es necesario que responda éste correo electronico<h4>
                                </td>
                                <td style="padding:0px 0 15px 30px;" class="mobile-block">
                                  <table cellspacing="0" cellpadding="0" width="100%">
                                    <!-- <tr>
                                      <td>Subtotal:</td>
                                      <td><b> $160.00</b></td>
                                    </tr>
                                    <tr>
                                      <td>Tax</td>
                                      <td>$8.00</td>
                                    </tr>
                                    <tr>
                                      <td>Amount Due:</td>
                                      <td><b>$168.00</b></td>
                                    </tr>
                                    <tr>
                                      <td>Due by:</td>
                                      <td>Feb 4, 2014</td>
                                    </tr> -->
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="vertical-align:top;" class="desktop-hide">
                                  Gracias por elegir Consultancy, estaremos atentos a cualquier duda. <a href="#">Contáctenos</a> <br>
                                  <h4>*No es necesario que responda éste correo electronico<h4>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </center>
            </td>
          </tr>
          <tr>
            <td style="background-color:#1f1f1f;">
              <center>
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;color:#ffffff" bgcolor="#1f1f1f">
                  <tr>
                    <td align="right" valign="middle" class="mobile-padding" style="font-size:12px;padding:20px; background-color:#1f1f1f; color:#ffffff; text-align:left; ">
                      <a style="color:#ffffff;">Contáctenos</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                      <a style="color:#ffffff;">Facebook</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                      <a style="color:#ffffff;">Twitter</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                      <a style="color:#ffffff;">Soporte</a>
                    </td>
                  </tr>
                </table>
              </center>
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
</body>

</html>';
$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'mail.consultancysc.com';
    $mail->SMTPAuth = true;
    $mail->Username = '@consultancysc.com';
    $mail->Password = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('notificacionesportalcliente@consultancysc.com', 'CONSULTANCY');
    $mail->addAddress($EmailDestinatarioCliente, 'Receptor');
    // $mail->addCC('concopia@gmail.com');

    $mail->addAttachment('docs/icons.png', 'logo.png');

    $mail->isHTML(true);
    $mail->Subject = 'Notificaciones Consultancy';
    $mail->Body = $body;
    $mail->send();

    echo 'Correo enviado';
} catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
}

}
