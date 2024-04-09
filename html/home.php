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
<html lang="es" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

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

  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

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
            <div class="row">
              <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Bienvenido <?php echo $_SESSION['cliente_PORTALCONSULTANCY']; ?>! 🎉</h5>
                        <p class="mb-4">
                          Estamos atentos a cuealquier duda, puedes contactarnos en la de <span class="fw-bold">Soporte</span> y demás medios detallados allí...
                        </p>

                        <a href="MiSoporte.php" class="btn btn-sm btn-outline-primary">Necesito ayuda</a>
                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                  <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                          </div>
                          <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                              <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Profit</span>
                        <h3 class="card-title mb-2">$12,628</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                          </div>
                          <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                              <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                          </div>
                        </div>
                        <span>Sales</span>
                        <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

              <!-- Total Revenue -->
              
              <!--/ Total Revenue -->
              
            </div>
            <div class="row">
              <!-- Order Statistics -->
              
              <!--/ Order Statistics -->

              <!-- Expense Overview -->
              
              <!--/ Expense Overview -->

              <!-- Transactions -->
              
              <!--/ Transactions -->
            </div>

            <h5 class="pb-1 mb-4">Resumen</h5>
            <div class="row">
              <div class="col-md-6 col-xl-4">
                <div class="card bg-primary text-white mb-4">
                  <div class="card-header">Servicio</div>
                  <div class="card-body">
                    <h5 class="card-title text-white"><?php echo $Hservicio ?></h5>
                    <p class="card-text">+ Detalles en Información Tributaria.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card bg-secondary text-white mb-3">
                  <div class="card-header">Asesor(ra)</div>
                  <div class="card-body">
                    <h5 class="card-title text-white"><?php echo $Hcliente ?></h5>
                    <p class="card-text">Contacto: .</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card bg-success text-white mb-3">
                  <div class="card-header">Plan</div>
                  <div class="card-body">
                    <h5 class="card-title text-white">$ <?php echo $Hcosto ?></h5>
                    <p class="card-text">Mensual.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card bg-danger text-white mb-3">
                  <div class="card-header">Atención</div>
                  <div class="card-body">
                    <h5 class="card-title text-white">Horario de oficina</h5>
                    <p class="card-text">Lunes a Viernes <?php echo $HHorario ?> (Hora México).</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card bg-warning text-white mb-3">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title text-white">Warning card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card bg-info text-white mb-3">
                  <div class="card-header">Header</div>
                  <div class="card-body">
                    <h5 class="card-title text-white">Info card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up.</p>
                  </div>
                </div>
              </div>
            </div>



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
  <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <?php
  include  "reciclables/scripts2.php";
  ?>
</body>

</html>