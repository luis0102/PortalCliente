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
            <?php include  "reciclables/lateral2.php"; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include  "reciclables/miusuario2.php"; ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Consultancy /</span> Mis Pagos</h4>
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
                        <!-- Bootstrap Table with Header - Footer -->
                        <div class="card">
                            <h5 class="card-header">Pagos por servicios de Consultancy</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Mes</th>
                                            <th>Monto</th>
                                            <th>Fecha de Vencimiento</th>
                                            <!-- <th>Total</th>                                             -->
                                            <th>Estado</th>
                                            <th>Adjunto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ConsultaEmpresas = mysqli_query($con, "select p.mes as dat1, p.monto as dat2, p.f_vencimiento as dat3, p.idestado_p as dat4, p.archivo as dat5
                                            FROM cliente c, pagos p 
                                            WHERE p.idcliente=c.idcliente AND c.idcliente=$cliente ");
                                        $ContTabEmpresas1 = 1;
                                        while ($valorft = mysqli_fetch_array($ConsultaEmpresas)) {
                                            $servicioss = $valorft['dat1'];
                                            echo "<tr>
                                            <td class=\"text-nowrap\"><strong>" . $ContTabEmpresas1 . "</strong></td>
                                            <td class=\"text-nowrap\">" . $valorft['dat1'] . "</td>
                                            <td class=\"text-nowrap\">$ " . $valorft['dat2'] . "</td>
                                            <td> " . $valorft['dat3'] . "</td>
                                             
                                            <td>";
                                            if ($valorft['dat4'] == 1) {
                                                echo "<span class=\"badge bg-label-warning me-1\">Pendiente</span>";
                                            } else {
                                                if ($valorft['dat4'] == 2) {
                                                    echo "<span class=\"badge bg-label-success me-1\">Completado</span>";
                                                }
                                            }
                                            echo "</td>
                                            <td>
                                                <a type=\"button\" href=\"docs/" . $valorft['dat5'] . "\" class=\"btn btn-icon btn-outline-primary\">
                                                    <span class=\"tf-icons bx bxs-file-pdf\"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </a>
                                            </td>
                                            </tr>";
                                            $ContTabEmpresas1++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot class="table-border-bottom-0">
                                        <tr>
                                            <th></th>
                                            <th>Total: </th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <hr class="my-5" />
                        <div class="card">
                            <h5 class="card-header">Métodos de Pago</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><strong>N°</strong></th>
                                            <th>Método</th>
                                            <th>Enlace</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap"><strong>1</strong></td>
                                            <td class="text-nowrap">Mercado Pago</td>

                                            <td>
                                                <a type="button" href="docs/" class="btn btn-icon btn-outline-primary" target="_blank" rel="noopener noreferrer">
                                                    <span class="tf-icons bx bx-link-external"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap"><strong>2</strong></td>
                                            <td class="text-nowrap">Paypal</td>

                                            <td>
                                                <a type="button" href="https://paypal.me/consultancysc" class="btn btn-icon btn-outline-primary" target="_blank" rel="noopener noreferrer">
                                                    <span class="tf-icons bx bx-link-external"></span>
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
                        <div class="card">
                            <h5 class="card-header">+ Información</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // select d.mes as dat1, d.isr as dat2, d.iva as dat3, d.ruta as dat4 
                                        // FROM doc_tributacion d, info i, tipo t, tipo_documento td, empresa e 
                                        // WHERE d.idinfo=1 AND d.idtipo=t.idtipo AND d.idtipo_documento=td.idtipo_documento AND d.idempresa=e.idempresa;
                                        $ConsultaEmpresas = mysqli_query($con, "select d.fecha_registro as dat1, d.mes as dat2, d.detalle as dat3, d.ruta as dat4
                                            FROM doc_tributacion d, info i, tipo t, tipo_documento td 
                                            WHERE d.idinfo=$idinfo AND d.idtipo=t.idtipo AND d.idtipo_documento=td.idtipo_documento AND d.idtipo=1 AND d.idtipo_documento=4");
                                        $ContTabEmpresas2 = 1;
                                        while ($valorft = mysqli_fetch_array($ConsultaEmpresas)) {
                                            $servicioss = $valorft['dat1'];
                                            echo "<tr>
                                            <td class=\"text-nowrap\"><strong>" . $ContTabEmpresas2 . "</strong></td>
                                            <td class=\"text-nowrap\">" . $valorft['dat1'] . "</td>
                                            <td class=\"text-nowrap\">" . $valorft['dat2'] . "</td>
                                            <td class=\"text-nowrap\">" . $valorft['dat3'] . "</td>
                                            <td>
                                                <a type=\"button\" href=\"docs/" . $valorft['dat4'] . "\" class=\"btn btn-icon btn-outline-primary\">
                                                    <span class=\"tf-icons bx bxs-file-pdf\"></span>
                                                    <box-icon name='pie-chart-alt'></box-icon>
                                                </a>
                                            </td>
                                            </tr>";
                                            $ContTabEmpresas2++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot class="table-border-bottom-0">
                                        <tr>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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