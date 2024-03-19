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

  <title>Portal del Cliente</title>

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
        <?php

        $titular = $_SESSION['nus_PORTALCONSULTANCY'];
        $Consulta_cliente = mysqli_query($con, "select i.servicio as dat1, i.fecha_afiliacion as dat2, i.costo_plan as dat3, t.nombre_tipo as dat4 
        from usuario u,persona p, cliente c, info i , tipo_plan t
        where u.idusuario=p.idusuario and p.idpersona=c.idpersona and u.email='$titular'  
        and c.idcliente=i.idcliente and i.idtipo_plan=t.idtipo_plan;");
        while ($valorft = mysqli_fetch_array($Consulta_cliente)) {
          $servicio = $valorft['dat1'];
          $fechaInicio = $valorft['dat2'];
          $costo = $valorft['dat3'];
          $tipoPlan = $valorft['dat4'];
        }
        ?>
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Mi Perfil /</span> Información Empresarial
            </h4>

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                    <a class="nav-link" href="cuenta.php"><i class="bx bx-user me-1"></i> Cuenta</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-bell me-1"></i> Información Empresarial</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-connections.html"><i class="bx bx-link-alt me-1"></i> Connections</a>
                  </li>
                </ul>
                <div class="card">
                  <!-- Notifications -->
                  <h5 class="card-header">Servicio Contratado: <?php echo $servicio ?></h5>
                  <div class="card-body">
                    <span><span class="notificationRequest"><strong>Plan: </strong><?php echo $tipoPlan ?></span> <strong>Fecha de Afiliación: </strong></span> <?php echo $fechaInicio ?> <strong>Costo:</strong></span> $<?php echo $costo ?>
                    </span>
                    <div class="error"></div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless border-bottom">
                      <thead>
                        <tr>
                          <th class="text-nowrap">N°</th>
                          <th class="text-nowrap">Nombre</th>
                          <th class="text-nowrap text-center">✉️ Asesor</th>
                          <th class="text-nowrap text-center">🖥 Contacto</th>
                          <th class="text-nowrap text-center">👩🏻‍💻 Horario de contacto</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $ConsultaEmpresas = mysqli_query($con, "select i.servicio as dat1, i.fecha_afiliacion as dat2, i.costo_plan as dat3, t.nombre_tipo as dat4 
                          from usuario u,persona p, cliente c, info i , tipo_plan t
                          where u.idusuario=p.idusuario and p.idpersona=c.idpersona and u.email='$titular' and c.telefono='LP202024028' 
                          and c.idcliente=i.idcliente and i.idtipo_plan=t.idtipo_plan;");
                        while ($valorft = mysqli_fetch_array($ConsultaEmpresas)) {
                          $servicioss = $valorft['dat1'];
                          echo "<h1>probando texto</h1>";
                        }
                        ?>
                        <tr>
                          <td class="text-nowrap">1</td>
                          <td class="text-nowrap">New for you</td>
                          <td>

                          </td>
                          <td>

                          </td>
                          <td>

                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <h6>When should we send you notifications?</h6>
                    <form action="javascript:void(0);">
                      <div class="row">
                        <div class="col-sm-6">
                          <select id="sendNotification" class="form-select" name="sendNotification">
                            <option selected>Only when I'm online</option>
                            <option>Anytime</option>
                          </select>
                        </div>
                        <div class="mt-4">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Discard</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /Notifications -->
                </div>
              </div>
            </div>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
              </div>
              <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
              </div>
            </div>
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
  <!-- / Layout wrapper -->

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

</html>