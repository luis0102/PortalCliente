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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> CLIENTES</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Gestión de Clientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="AdminDocumentos.php"><i class="bx bxs-file-doc"></i> Gestión de Documentos</a>
                                    </li>
                                    <!-- <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-connections.html"><i class="bx bx-link-alt me-1"></i> Conexiones</a>
                  </li> -->
                                </ul>

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
                                                <i class="tf-icons bx bx-buildings"></i> Añadir Nueva Empresa
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-nuevo-admin-usuarios" aria-controls="navs-nuevo-admin-usuarios" aria-selected="false">
                                                <i class="tf-icons bx bx-user-circle"></i> Administración de Usuarios
                                            </button>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                                                <i class="tf-icons bx bx-message-square"></i> Mensajes
                                            </button>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                                            <p>
                                                Bienvenido
                                            </p>

                                        </div>
                                        <div class="tab-pane fade" id="navs-nuevo-cliente" role="tabpanel">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Datos del Cliente</h5>
                                                <small class="text-muted float-end">Merged input group</small>
                                            </div>
                                            <div class="card-body">
                                                <form id="FormNuevoCliente" method="POST">
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
                                                        <label class="col-sm-2 form-label" for="ClienteServicioContratado">Servicio Contratado (*)</label>
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
                                                            <div class="input-group input-group-merge" data-bs-toggle="modal" data-bs-target="#modalBAsesor">
                                                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bxs-user"></i></span>
                                                                <input type="text" id="ClienteAsesor" name="ClienteAsesor" style="cursor: pointer;" class="form-control" placeholder="Seleccione Asesor" aria-label="Seleccione Asesor" aria-describedby="basic-icon-default-company2">
                                                                <label id="NombreAsesor" class="input-group-text" for="ClienteAsesor"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mt-3">
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modalBAsesor" tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalCenterTitle">Buscar Asesor</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3 row">
                                                                                <label for="html5-search-input" class="col-md-2 col-form-label">Ingrese nombre</label>
                                                                                <div class="col-md-10">
                                                                                    <input class="form-control" type="search" placeholder="Buscar Asesor ..." id="ModalBuscarAsesor" />
                                                                                    <input id="identificadorAsesor" type="hidden" class="input-group-text" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row g-2">
                                                                                <div class="card">
                                                                                    <h5 class="card-header">Seleccione el Asesor: </h5>
                                                                                    <div class="table-responsive text-nowrap">
                                                                                        <table class="table table-hover">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>N°</th>
                                                                                                    <th>Folio</th>
                                                                                                    <th>Asesor</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody id="tablaAsesores" class="table-border-bottom-0">

                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <!-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                                Cerrar
                                                                            </button> -->
                                                                            <!-- <button type="button" class="btn btn-primary">Listo</button> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="ClienteContrato">Agregar Contrato (*)</label>
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
                                        <div class="tab-pane fade" id="navs-nuevo-documento" role="tabpanel">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Añadir Nueva Empresa</h5>
                                                <small class="text-muted float-end">Merged input group</small>
                                            </div>
                                            <div class="card-body">
                                                <form id="FormNuevaEmpresa" method="POST">

                                                    <div id="CajaEmpresaNCliente" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="EmpresaNCliente">Cliente <strong>(*)</strong></label>
                                                        <div class="col-sm-10" style="cursor: pointer;">
                                                            <div class="input-group input-group-merge" data-bs-toggle="modal" data-bs-target="#modalBCliente">
                                                                <input type="text" class="form-control" style="cursor: pointer;" id="EmpresaNCliente" placeholder="Seleccionar Cliente" aria-label="Seleccionar Cliente" aria-describedby="basic-icon-default-fullname2" readonly>
                                                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mt-3">
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modalBCliente" tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalCenterTitle">Buscar Cliente</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3 row">
                                                                                <label for="html5-search-input" class="col-md-2 col-form-label">Ingrese CURP</label>
                                                                                <div class="col-md-10">
                                                                                    <input class="form-control" type="search" placeholder="Buscar Cliente ..." id="ModalBuscarCliente" />
                                                                                    <input id="identificadorCliente" type="hidden" class="input-group-text" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row g-2">
                                                                                <div class="card">
                                                                                    <h5 class="card-header">Seleccione el Cliente: </h5>
                                                                                    <div class="table-responsive text-nowrap">
                                                                                        <table class="table table-hover">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>N°</th>
                                                                                                    <th>Cliente</th>
                                                                                                    <th># de CRUP</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody id="tablaClientes" class="table-border-bottom-0">

                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <!-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                                Cerrar
                                                                            </button> -->
                                                                            <!-- <button type="button" class="btn btn-primary">Listo</button> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="CajaNuevaNEmpresa" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="NuevaNEmpresa">Empresa <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" class="form-control" id="NuevaNEmpresa" placeholder="Ingrese nombre de la empresa" aria-label="Ingrese nombre de la empresa" aria-describedby="basic-icon-default-fullname2">
                                                                <span class="input-group-text"><i class="bx bxs-business"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="CajaEmpresaCosto" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="EmpresaCosto">Costo del plan (*)</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                                                                <input type="text" class="form-control" id="EmpresaCosto" name="EmpresaCosto" placeholder="Ingrese nuevo costo o confirme el costo de plan" aria-label="Ingrese nuevo costo o confirme el costo de plan" aria-describedby="IconDocumentoISR2">
                                                                <span class="input-group-text">Costo del actual plan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="EmpresaArchivoContrato">Archivo <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group ">
                                                                <input type="file" class="form-control" id="EmpresaArchivoContrato" name="EmpresaArchivoContrato">
                                                                <label class="input-group-text" for="EmpresaArchivoContrato">Seleccione archivo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="EmpresaDetalle">Detalle <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-detail"></i></span>
                                                                <textarea id="EmpresaDetalle" name="EmpresaDetalle" class="form-control" placeholder="Escriba alguna descripción si es el caso" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="m-0">
                                                    <hr class="m-0">
                                                    <div class="mb-3 col-12 mb-0">
                                                        <div class="alert alert-warning">
                                                            <h6 class="alert-heading fw-bold mb-1">Alerta</h6>
                                                            <p class="mb-0">Los campos con <strong>(*)</strong> son obligatorios.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-10">
                                                            <button type="submit" id="BTNCompletarRegistronNuevaEmpresa" class="btn btn-primary">Completar Registro</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-nuevo-admin-usuarios" role="tabpanel">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Alta / Baja de Usuarios</h5>
                                                <small class="text-muted float-end">Merged input group</small>
                                            </div>
                                            <div class="card-body">
                                                <form id="FormAltaBajaUsuarios" method="POST">
                                                    <div id="CajaUsuarioNCliente" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="UsuarioNCliente">Cliente <strong>(*)</strong></label>
                                                        <div class="col-sm-10" style="cursor: pointer;">
                                                            <div class="input-group input-group-merge" data-bs-toggle="modal" data-bs-target="#modalBCliente2">
                                                                <input type="text" class="form-control" style="cursor: pointer;" id="UsuarioNCliente2" placeholder="Seleccionar Cliente" aria-label="Seleccionar Cliente" aria-describedby="basic-icon-default-fullname2" readonly>
                                                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mt-3">
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modalBCliente2" tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalCenterTitle">Buscar Cliente</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3 row">
                                                                                <label for="html5-search-input" class="col-md-2 col-form-label">Ingrese CURP</label>
                                                                                <div class="col-md-10">
                                                                                    <input class="form-control" type="search" placeholder="Buscar Cliente ..." id="ModalBuscarCliente2" />
                                                                                    <input id="identificadorCliente2" type="hidden" class="input-group-text" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row g-2">
                                                                                <div class="card">
                                                                                    <h5 class="card-header">Seleccione el Cliente: </h5>
                                                                                    <div class="table-responsive text-nowrap">
                                                                                        <table class="table table-hover">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>N°</th>
                                                                                                    <th>Cliente</th>
                                                                                                    <th># de CRUP</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody id="tablaClientes2" class="table-border-bottom-0">

                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <!-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                                Cerrar
                                                                            </button> -->
                                                                            <!-- <button type="button" class="btn btn-primary">Listo</button> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="UsuarioEstado" class="col-sm-2 form-label">ESTADO <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="UsuarioEstado" name="UsuarioEstado" onchange="" class="form-select">
                                                                    <option value="0">Seleccione ESTADO</option>
                                                                    <option value="1">ACTIVO</option>
                                                                    <option value="2">INACTIVO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div id="CajaNuevaNEmpresa2" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="NuevaNEmpresa2">Empresa <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" class="form-control" id="NuevaNEmpresa2" placeholder="Ingrese nombre de la empresa" aria-label="Ingrese nombre de la empresa" aria-describedby="basic-icon-default-fullname2">
                                                                <span class="input-group-text"><i class="bx bxs-business"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="UsuariosDetalle">Detalle <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-detail"></i></span>
                                                                <textarea id="UsuariosDetalle" name="UsuariosDetalle" class="form-control" placeholder="Escriba alguna descripción si es el caso" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <hr class="m-0">
                                                    <hr class="m-0">
                                                    <div class="mb-3 col-12 mb-0">
                                                        <div class="alert alert-warning">
                                                            <h6 class="alert-heading fw-bold mb-1">Alerta</h6>
                                                            <p class="mb-0">Los campos con <strong>(*)</strong> son obligatorios.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-10">
                                                            <button type="submit" id="BTNCompletarRegistroAltaBaja" class="btn btn-primary">Guardar Cambios</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <!-- <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                            <p>
                                                Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                                                cupcake gummi bears cake chocolate.
                                            </p>
                                            <p class="mb-0">
                                                Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                                                roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                                                jelly-o tart brownie jelly.
                                            </p>
                                        </div> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- / Cartel de alerta general -->
                    <div id="mensajeCuenta">
                    </div>
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
    <script src="jvscons/funcionesjsAdmin.js"></script>
    <script type="text/javascript">
        buscarCliente();
        buscarCliente2Prueba();
        
        document.getElementById("ModalBuscarAsesor").addEventListener("keyup", buscarAsesor)
        document.getElementById("ModalBuscarCliente").addEventListener("keyup", buscarCliente)
        document.getElementById("ModalBuscarCliente2").addEventListener("keyup", buscarCliente2Prueba)
        $(document).ready(function() {
            $("#BTNCompletarRegistroCliente").on('click', function(e) {
                e.preventDefault();
                CrearNuevoCliente();
            });
        });
        $(document).ready(function() {
            $("#BTNCompletarRegistronNuevaEmpresa").on('click', function(e) {
                e.preventDefault();
                CrearNuevaEmpresa();
            });
        });
        $(document).ready(function() {
            $("#BTNCompletarRegistroAltaBaja").on('click', function(e) {
                e.preventDefault();
                CambiarEstadoUsuario();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#b").on('click', function(e) {
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
        $(document).on("click", "#SelectAsesor", function() {
            var id = $(this).data("id");
            var valor = $(this).data("valor-nombre");

            // document.getElementById("DocumentoNCliente").setAttribute("value", id);
            document.getElementById("ClienteAsesor").setAttribute("value", valor);            
            // document.getElementById("NombreAsesor").innerHTML = id;
            $("#NombreAsesor").text(id);
            

        })
        // pasar id
        $(document).on("click", "#SelectClienteDocumento", function() {
            var id = $(this).data("id");
            var valor = $(this).data("valor-nombre");

            // document.getElementById("DocumentoNCliente").setAttribute("value", id);
            document.getElementById("EmpresaNCliente").setAttribute("value", valor);
            document.getElementById("identificadorCliente").setAttribute("value", id);
            document.getElementById("UsuarioNCliente2").setAttribute("value", valor);
            document.getElementById("identificadorCliente2").setAttribute("value", id);

        })
    </script>

    <?php
    include  "reciclables/scripts2.php";
    ?>
</body>

</html>