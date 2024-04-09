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
                                        <a class="nav-link" href="datosEmpresariales.php"><i class="bx bx-bell me-1"></i> Información empresarial</a>
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
                                                    <input class="form-control" type="text" id="firstName" name="firstName" value="<?php echo $nombre; ?>" autofocus />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="lastName" class="form-label">Apellidos</label>
                                                    <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $apellido; ?>" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="correo@ejemplo.com" />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="phoneNumber">Telefono</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">MX (+52)</span>
                                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?php echo $telef; ?>" placeholder="<?php if ($telef == "") {
                                                                                                                                                                                    echo "No tiene un número registrado";
                                                                                                                                                                                } ?>" />
                                                    </div>
                                                </div>
                                                <!-- <div class="mb-3 col-md-6">
                          <label for="address" class="form-label">Dirección</label>
                          <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                        </div> -->
                                                <!-- <div class="mb-3 col-md-6">
                          <label for="state" class="form-label">State</label>
                          <input class="form-control" type="text" id="state" name="state" placeholder="California" />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="zipCode" class="form-label">Zip Code</label>
                          <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" />
                        </div> -->
                                                <!-- <div class="mb-3 col-md-6">
                          <label class="form-label" for="country">Country</label>
                          <select id="country" class="select2 form-select">
                            <option value="">Select</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="language" class="form-label">Language</label>
                          <select id="language" class="select2 form-select">
                            <option value="">Select Language</option>
                            <option value="en">English</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="pt">Portuguese</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="timeZones" class="form-label">Timezone</label>
                          <select id="timeZones" class="select2 form-select">
                            <option value="">Select Timezone</option>
                            <option value="-12">(GMT-12:00) International Date Line West</option>
                            <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                            <option value="-10">(GMT-10:00) Hawaii</option>
                            <option value="-9">(GMT-09:00) Alaska</option>
                            <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                            <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                            <option value="-7">(GMT-07:00) Arizona</option>
                            <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                            <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                            <option value="-6">(GMT-06:00) Central America</option>
                            <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                            <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                            <option value="-6">(GMT-06:00) Saskatchewan</option>
                            <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                            <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                            <option value="-5">(GMT-05:00) Indiana (East)</option>
                            <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                            <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                          </select>
                        </div> -->
                                                <!-- <div class="mb-3 col-md-6">
                          <label for="currency" class="form-label">Currency</label>
                          <select id="currency" class="select2 form-select">
                            <option value="">Select Currency</option>
                            <option value="usd">USD</option>
                            <option value="euro">Euro</option>
                            <option value="pound">Pound</option>
                            <option value="bitcoin">Bitcoin</option>
                          </select>
                        </div> -->
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" id="guardarcambio" name="guardarcambio" class="btn btn-primary me-2">Guardar cambios</button>
                                                <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                                            </div>
                                        </form>
                                        <div id="mensajeCuenta">
                                        </div>
                                    </div>
                                    <!-- /Account -->
                                </div>
                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                                                <i class="tf-icons bx bx-home"></i> Inicio
                                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">3</span>
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-nuevo-cliente" aria-controls="navs-nuevo-cliente" aria-selected="false">
                                                <i class="tf-icons bx bx-user"></i> Añadir Nuevo Cliente
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-nuevo-documento" aria-controls="navs-nuevo-documento" aria-selected="false">
                                                <i class="tf-icons bx bx-user"></i> Añadir Nuevo Documento
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                                                <i class="tf-icons bx bx-message-square"></i> Messages
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                                            <p>
                                                Inicio
                                            </p>

                                        </div>
                                        <div class="tab-pane fade" id="navs-nuevo-cliente" role="tabpanel">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Datos del Cliente</h5>
                                                <small class="text-muted float-end">Merged input group</small>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteNombres">Nombres <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                <input type="text" class="form-control" id="ClienteNombres" name="ClienteNombres" placeholder="Ingrese nombres" aria-label="Ingrese nombres" aria-describedby="basic-icon-default-fullname2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteApellidos">Apellidos <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                                <input type="text" class="form-control" id="ClienteApellidos" placeholder="Ingrese apellidos" aria-label="Ingrese apellidos" aria-describedby="basic-icon-default-fullname2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 form-label" for="ClienteTelef">Teléfono</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                <input type="text" id="ClienteTelef" name="ClienteTelef" class="form-control phone-mask" placeholder="Ingrese su número de teléfono" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
                                                                <span id="basic-icon-default-phone2" class="input-group-text">(+52)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="m-0">
                                                    <h5 class="card-header">Datos del Servicio</h5>
                                                    <div class="row mb-3">
                                                        <label for="ClientePlanServicio" class="col-sm-2 form-label">Plan de Servicio <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="ClientePlanServicio" name="ClientePlanServicio" class="form-select">
                                                                    <option value="0">Seleccione un plan</option>
                                                                    <option value="1">Plan Mensual</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 form-label" for="ClienteServicioContratado">Servicio Contratado</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bxs-business"></i></span>
                                                                <input type="text" id="ClienteServicioContratado" name="ClienteServicioContratado" class="form-control phone-mask" placeholder="Ingrese servicio " aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="ClienteFecha_af" class="col-md-2 col-form-label">Fecha de afiliación <strong>(*)</strong></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="date" value="" id="ClienteFecha_af" name="ClienteFecha_af">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteCosto">Costo de Plan <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                                                                <input type="text" id="ClienteCosto" name="ClienteCosto" class="form-control" placeholder="Costo" aria-label="Costo" aria-describedby="basic-icon-default-company2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteAsesor">Asesor <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bxs-user"></i></span>
                                                                <input type="text" id="ClienteAsesor" name="ClienteAsesor" class="form-control" placeholder="Ingrese folio del asesor" aria-label="Ingrese folio del asesor" aria-describedby="basic-icon-default-company2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteContrato">Agregar Contrato</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="ClienteContrato" name="ClienteContrato">
                                                                <label class="input-group-text" for="ClienteContrato">Agregar Contrato</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="m-0">
                                                    <h5 class="card-header">Información Empresarial</h5>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteEmpresa">Nombre de empresa</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                                                <input type="text" id="ClienteEmpresa" name="ClienteEmpresa" class="form-control" placeholder="Ingrese nombre de la empresa" aria-label="Ingrese nombre de la empresa" aria-describedby="basic-icon-default-company2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 form-label" for="ClienteDetalleContrato">Detalles adicionales del contrato</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-detail"></i></span>
                                                                <textarea id="ClienteDetalleContrato" name="ClienteDetalleContrato" class="form-control" placeholder="Escriba alguna observación si es el caso" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="m-0">
                                                    <h5 class="card-header">Credenciales de acceso</h5>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteEmail">Email <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                                <input type="text" id="ClienteEmail" name="ClienteEmail" class="form-control" placeholder="Ingrese su correo electrónico" aria-label="john.doe" aria-describedby="basic-icon-default-email2">
                                                                <span id="basic-icon-default-email2" class="input-group-text">@ejemplo.com</span>
                                                            </div>
                                                            <div class="form-text">Tenga en cuenta que el correo no podrá modificarse posteriormente.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 form-label" for="ClientePassword">Contraseña <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="form-password-toggle">
                                                                <div class="input-group input-group-merge">
                                                                    <input type="password" class="form-control" id="ClientePassword" name="ClientePassword" placeholder="Ingrese contraseña" aria-describedby="basic-default-password2">
                                                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-text">Recordárle al cliente que cambie la contraseña.</div>
                                                        </div>
                                                    </div>
                                                    <hr class="m-0">
                                                    <div class="mb-3 col-12 mb-0">
                                                        <div class="alert alert-warning">
                                                            <h6 class="alert-heading fw-bold mb-1">Alerta</h6>
                                                            <p class="mb-0">Los campos con <strong>(*)</strong> son obligatorios.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-10">
                                                            <button type="submit" id="BTNCompletarRegistroCliente" class="btn btn-primary">Completar Registro</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                            <p>
                                                Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                                                cupcake gummi bears cake chocolate.
                                            </p>
                                            <p class="mb-0">
                                                Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                                                roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                                                jelly-o tart brownie jelly.
                                            </p>
                                        </div>
                                    </div>
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

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="jvscons/funcionesjs.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#BTNCompletarRegistroCliente").on('click', function(e) {
                e.preventDefault();
                CrearNuevoCliente();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#guardarcambio").on('click', function(e) {
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
    <script src="jvscons/funcionesjs.js"></script>
    <?php
    include  "reciclables/scripts2.php";
    ?>
</body>

</html>