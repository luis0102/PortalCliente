<?php
session_start();
ob_start();
include_once "BD/conexion.php";
include  "reciclables/sesion.php";
if ($_SESSION['estado_PORTALCONSULTANCY'] <> "on") {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Portal del cliente</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include  "reciclables/miusuario2.php"; ?>
                <?php include  "reciclables/lateral2.php"; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Consultancy /</span> Soporte</h4>
                        <?php

                        $titular = $_SESSION['nus_PORTALCONSULTANCY'];
                        $Consulta_cliente = mysqli_query($con, "select i.servicio as dat1, i.fecha_afiliacion as dat2, i.costo_plan as dat3, c.idcliente as dat4, i.idinfo as dat5 
                        from usuario u,persona p, cliente c, info i 
                        where u.idusuario=p.idusuario and p.idpersona=c.idpersona and u.email='luis95k@gmail.com' and c.idcliente=i.idcliente;");
                        while ($valorft = mysqli_fetch_array($Consulta_cliente)) {
                            $servicio = $valorft['dat1'];
                            $fechaInicio = $valorft['dat2'];
                            $costo = $valorft['dat3'];
                            $cliente = $valorft['dat4'];
                            $idinfo = $valorft['dat5'];
                        }
                        ?>

                        <div class="card">
                            <h5 class="card-header">Medios de soporte del portal</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><strong>N°</strong></th>
                                            <th>Canal de Ayuda</th>
                                            <th>Enlace</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap"><strong>1</strong></td>
                                            <td class="text-nowrap"><strong>Whatsapp:</strong> <a href="https://api.whatsapp.com/send?phone=524621000030" target="_blank" rel="noopener">462 100 0030</a></td>
                                            <td>
                                                <a type="button" class="btn btn-icon btn-outline-primary" href="https://api.whatsapp.com/send?phone=524621000030" target="_blank" rel="noopener">
                                                    <span class="tf-icons bx bxl-whatsapp"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap"><strong>2</strong></td>
                                            <td class="text-nowrap"><strong>Email:</strong> <a href="mailto:contactenos@consultancysc.com?Subject=Dudas%20sobre%20el%20Portal%20dell%20Cliente" target="_blank" rel="noopener noreferrer">contactenos@consultancysc.com</a></td>
                                            <td>
                                                <a type="button" href="mailto:contactenos@consultancysc.com?Subject=Dudas%20sobre%20el%20Portal%20dell%20Cliente" class="btn btn-icon btn-outline-primary" target="_blank" rel="noopener noreferrer">
                                                    <span class="tf-icons bx bx-mail-send"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-border-bottom-0">
                                        <tr>
                                            <th></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- <hr class="my-5" />
                        <div class="card">
                            <h5 class="card-header">Declaración Informativa de Operaciones con Terceros (DIOT)</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Mes</th>
                                            <th>ISR*</th>
                                            <th>IVA*</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>Adjunto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>MES1</strong></td>
                                            <td>$ 000.00</td>
                                            <td>$ 000.00</td>
                                            <td>$ 000.00</td>
                                            <td><span class="badge bg-label-success me-1">Completado</span></td>
                                            <td>
                                                <button type="button" class="btn btn-icon btn-outline-primary">
                                                    <span class="tf-icons bx bxs-file-pdf"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>MES1</strong></td>
                                            <td>$ 000.00</td>
                                            <td>$ 000.00</td>
                                            <td>$ 000.00</td>
                                            <td><span class="badge bg-label-warning me-1">Pendiente</span></td>
                                            <td>
                                                <button type="button" class="btn btn-icon btn-outline-primary">
                                                    <span class="tf-icons bx bxs-file-pdf"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>MES1</strong></td>
                                            <td>$ 000.00</td>
                                            <td>$ 000.00</td>
                                            <td>$ 000.00</td>
                                            <td><span class="badge bg-label-success me-1">Completado</span></td>
                                            <td>
                                                <button type="button" class="btn btn-icon btn-outline-primary">
                                                    <span class="tf-icons bx bxs-file-pdf"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </button> 
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-border-bottom-0">
                                        <tr>
                                            <th>Total</th>
                                            <th>Total</th>
                                            <th>Total</th>
                                            <th>Total</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> -->

                        <hr class="my-5" />
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                    <?php include  "reciclables/footer.php"; ?>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
<?php
include  "reciclables/scripts2.php";
?>

</html>