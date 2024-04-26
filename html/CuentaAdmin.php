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

    <title>Portal del Cliente-ADMIN</title>

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
    <style>
        .modal-backdrop {
            z-index: -1;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include  "reciclables/lateralAdmin.php"; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include  "reciclables/miusuarioAdmin.php"; ?>
                <!-- / Navbar -->
                <?php

                $titular = $_SESSION['nus_PORTALCONSULTANCY'];
                $Consulta_cliente = mysqli_query($con, "select p.nombre as dat1, p.apellido as dat2,p.telefono as dat3, u.email as dat4 
        from usuario u,persona p, cliente c 
        where u.idusuario=p.idusuario and p.idpersona=c.idpersona and u.email='$titular' ;");
                while ($valorft = mysqli_fetch_array($Consulta_cliente)) {
                    $nombre = $valorft['dat1'];
                    $apellido = $valorft['dat2'];
                    $telef = $valorft['dat3'];
                    $email = $valorft['dat4'];
                }
                ?>
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Inicio</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Cuenta</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="datosEmpresariales.php"><i class="bx bx-bell me-1"></i> ----</a>
                                    </li>
                                    <!-- <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-connections.html"><i class="bx bx-link-alt me-1"></i> Conexiones</a>
                  </li> -->
                                </ul>
                                <div class="card mb-4">
                                    <h5 class="card-header">Detalles del Perfil</h5>
                                    <!-- Account -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            <img src="../assets/img/avatars/8.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                    <span class="d-none d-sm-block">Cambiar imagen</span>
                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                    <input type="file" id="upload" name="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                </label>
                                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cancelar</span>
                                                </button>

                                                <p class="text-muted mb-0">Formatos permitidos: JPG, GIF or PNG. Tamaño máximo 500Kb</p>
                                                <button type="button" id="EnviarFoto" name="EnviarFoto" class="btn rounded-pill btn-outline-primary">
                                                    <span class="tf-icons bx bxs-send"></span>&nbsp; Guardar Foto
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Nombres</label>
                                                    <input class="form-control" type="text" id="firstName" name="firstName" value="<?php echo $AdminNombre; ?>" autofocus />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="lastName" class="form-label">Apellidos</label>
                                                    <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $AdminApellido; ?>" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" type="text" id="email" name="email" value="<?php echo $AdminEmail; ?>" placeholder="correo@ejemplo.com" readonly disabled />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="phoneNumber">Telefono</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">MX (+52)</span>
                                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?php echo $AdminTelef; ?>" placeholder="<?php if ($AdminTelef == "") {
                                                                                                                                                                                    echo "No tiene un número registrado";
                                                                                                                                                                                } ?>" />
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" id="guardarCambioAdmin" name="guardarCambioAdmin" class="btn btn-primary me-2">Guardar cambios</button>
                                                <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                                            </div>
                                        </form>
                                        <div id="mensajeCuenta">
                                        </div>
                                    </div>
                                    <!-- /Account -->
                                </div>
                                
                                <div class="card">
                                    <h5 class="card-header">Actualizar Contraseña</h5>
                                    <div class="card-body">
                                        <div class="mb-3 col-12 mb-0">
                                            <div class="alert alert-warning">
                                                <h6 class="alert-heading fw-bold mb-1">Éstá seguro(a) de realizar éste cambio?</h6>
                                                <p class="mb-0">Recuerde que su correo electrónico seguirá siendo el mismo.</p>
                                            </div>
                                        </div>
                                        <form id="formAccountDeactivation" onsubmit="return false">
                                            <div class="mb-3 col-md-6">
                                                <label for="clave_actual" class="form-label">Contraseña actual</label>
                                                <input type="password" class="form-control" id="clave_actual" name="clave_actual" placeholder="***" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="clave" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="clave" name="clave" placeholder="***" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="clave2" class="form-label">Confirmar Contraseña</label>
                                                <input type="password" class="form-control" id="clave2" name="clave2" placeholder="***" />
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                                                <label class="form-check-label" for="accountActivation">Estoy de acuerdo</label>
                                            </div>
                                            <button type="submit" id="UpdatePassword" name="UpdatePassword" class="btn btn-danger deactivate-account">Cambiar contraseña</button>
                                        </form>
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

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>
    <!-- <script src="../assets/js/ui-modals.js"></script> -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="jvscons/funcionesjs.js"></script>
    <script type="text/javascript">
        buscarCliente();
        document.getElementById("ModalBuscarCliente").addEventListener("keyup", buscarCliente)
        document.getElementById("ModalBuscarEmpresa").addEventListener("keyup", buscarEmpresa)
        $(document).ready(function() {
            $("#BTNCompletarRegistroCliente").on('click', function(e) {
                e.preventDefault();
                CrearNuevoCliente();
            });
        });
        $(document).ready(function() {
            $("#BTNCompletarRegistroDocumento").on('click', function(e) {
                e.preventDefault();
                CrearNuevoDocumento();
            });
        });
        
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#guardarCambioAdmin").on('click', function(e) {
                e.preventDefault();
                actualizarUsuario();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#UpdatePassword").on('click', function(e) {
                e.preventDefault();
                actualizarPassword();
            });
        });
    </script>
    <script>
        function selectorTipoPersona() {
            let DocumentoTipoPersona = document.getElementById('DocumentoTipoPersona');
            let OpcionDocumentoTipoPersona = DocumentoTipoPersona.value;
            if (OpcionDocumentoTipoPersona == 1) {
                document.getElementById('CajaDocumentoNEmpresa').style.display = 'none';
            } else {
                if (OpcionDocumentoTipoPersona == 2) {
                    // campo de empresa
                    document.getElementById('CajaDocumentoNEmpresa').style.display = '';
                } else {

                }
            }
        }

        function selectorTipoDocumento() {
            let DocumentoTipoDocumento = document.getElementById('DocumentoTipoDocumento');
            let OpcionDocumentoTipoDocumento = DocumentoTipoDocumento.value;
            if (OpcionDocumentoTipoDocumento == 1 || OpcionDocumentoTipoDocumento == 2) {
                document.getElementById('CajaDocumentoEstado').style.display = '';
                document.getElementById('CajaDocumentoAnio').style.display = '';
                document.getElementById('CajaDocumentoISR').style.display = '';
                document.getElementById('CajaDocumentoIVA').style.display = '';

            } else {
                if (OpcionDocumentoTipoDocumento == 3) {
                    
                    document.getElementById('CajaDocumentoISR').style.display = 'none';
                    document.getElementById('CajaDocumentoIVA').style.display = 'none';

                } else {
                    if (OpcionDocumentoTipoDocumento == 4) {
                        document.getElementById('CajaDocumentoEstado').style.display = 'none';
                        
                        
                        document.getElementById('CajaDocumentoISR').style.display = 'none';
                        document.getElementById('CajaDocumentoIVA').style.display = 'none';

                    } else {}
                }
            }
        }
    </script>
    <script>
        // pasar id
        $(document).on("click", "#SelectClienteDocumento", function() {
            var id = $(this).data("id");
            var valor = $(this).data("valor-nombre");

            // document.getElementById("DocumentoNCliente").setAttribute("value", id);
            document.getElementById("DocumentoNCliente").setAttribute("value", valor);
            document.getElementById("identificadorCliente").setAttribute("value", id);

        })
        $(document).on("click", "#SelectEmpresaDocumento", function() {
            var id = $(this).data("id");
            var valor = $(this).data("valor-nombre");

            // document.getElementById("DocumentoNCliente").setAttribute("value", id);
            document.getElementById("DocumentoNEmpresa").setAttribute("value", valor);
            document.getElementById("identificadorEmpresa").setAttribute("value", id);

        })
    </script>
    <script src="jvscons/funcionesjs.js"></script>
    <script src="jvscons/funcionesjsAdmin.js"></script>
    <?php
    include  "reciclables/scripts2.php";
    ?>
</body>

</html>