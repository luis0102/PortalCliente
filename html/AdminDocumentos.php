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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> DOCUMENTOS</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link " href="AdminHome.php"><i class="bx bx-user me-1"></i> Gestión de Clientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bxs-file-doc"></i> Gestión de Documentos</a>
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
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-nuevo-documento" aria-controls="navs-nuevo-documento" aria-selected="false">
                                                <i class="tf-icons bx bxs-file-doc"></i> Añadir Nuevo Documento
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-cambiar-estado-doc" aria-controls="navs-cambiar-estado-doc" aria-selected="false">
                                                <i class="tf-icons bx bx-list-check"></i> Cambiar estado de Documento
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                                            <p>
                                                Bienvenido
                                            </p>

                                        </div>

                                        <div class="tab-pane fade" id="navs-nuevo-documento" role="tabpanel">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Agregar Nuevo Documento</h5>
                                                <small class="text-muted float-end">Merged input group</small>
                                            </div>
                                            <div class="card-body">
                                                <form id="FormNuevoDocumento" method="POST">
                                                    <div class="row mb-3">
                                                        <label for="DocumentoTipoPersona" class="col-sm-2 form-label">Tipo de Persona <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="DocumentoTipoPersona" name="DocumentoTipoPersona" onchange="selectorTipoPersona();" class="form-select">
                                                                    <option value="0">Seleccione un tipo</option>
                                                                    <option value="1">Persona Fisica</option>
                                                                    <option value="2">Persona Moral</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="DocumentoTipoDocumento" class="col-sm-2 form-label">Tipo de Documento <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="DocumentoTipoDocumento" name="DocumentoTipoDocumento" onchange="selectorTipoDocumento();" class="form-select">
                                                                    <option value="0">Seleccione un tipo</option>
                                                                    <option value="1">SAT</option>
                                                                    <option value="2">Cedular</option>
                                                                    <option value="3">DIOT</option>
                                                                    <option value="4">OTRO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="CajaDocumentoEstado" class="row mb-3">
                                                        <label for="DocumentoEstado" class="col-sm-2 form-label">Estado <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="DocumentoEstado" name="DocumentoEstado" class="form-select">
                                                                    <option value="0">Seleccione estado</option>
                                                                    <option value="1">Completado</option>
                                                                    <option value="2">Pendiente</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="CajaDocumentoNCliente" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="DocumentoNCliente">Cliente <strong>(*)</strong></label>
                                                        <div class="col-sm-10" style="cursor: pointer;">
                                                            <div class="input-group input-group-merge" data-bs-toggle="modal" data-bs-target="#modalBCliente">
                                                                <input type="text" class="form-control" style="cursor: pointer;" id="DocumentoNCliente" placeholder="Seleccionar Cliente" aria-label="Seleccionar Cliente" aria-describedby="basic-icon-default-fullname2" readonly>

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
                                                    <div id="CajaDocumentoNEmpresa" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="DocumentoNEmpresa">Empresa <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge" data-bs-toggle="modal" data-bs-target="#modalBEmpresa">
                                                                <input type="text" class="form-control" id="DocumentoNEmpresa" placeholder="Ingrese nombre de la empresa" aria-label="Ingrese nombre de la empresa" aria-describedby="basic-icon-default-fullname2">
                                                                <span class="input-group-text"><i class="bx bxs-business"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mt-3">
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modalBEmpresa" tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalCenterTitle2">Buscar Cliente</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3 row">
                                                                                <label for="html5-search-input" class="col-md-2 col-form-label">Ingrese nombre de la empresa</label>
                                                                                <div class="col-md-10">
                                                                                    <input class="form-control" type="search" placeholder="Buscar Empresa ..." id="ModalBuscarEmpresa" />
                                                                                    <input id="identificadorEmpresa" type="hidden" class="input-group-text" readonly>
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
                                                                                                    <th>Empresa</th>

                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody id="tablaEmpresa" class="table-border-bottom-0">

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
                                                        <label class="col-sm-2 col-form-label" for="DocumentoMes">Mes <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="month" value="" id="DocumentoMes" />
                                                        </div>
                                                    </div>
                                                    <div id="CajaDocumentoAnio" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="DocumentoAnio">Año <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" class="form-control" id="DocumentoAnio" placeholder="Ingrese año" aria-label="Ingrese año" aria-describedby="basic-icon-default-fullname2">
                                                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="CajaDocumentoISR" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="DocumentoISR">ISR</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                                                                <input type="text" class="form-control" id="DocumentoISR" name="DocumentoISR" placeholder="Ingrese ISR" aria-label="Ingrese año" aria-describedby="IconDocumentoISR2">
                                                                <span class="input-group-text">($)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="CajaDocumentoIVA" class="row mb-3">
                                                        <label class="col-sm-2 form-label" for="DocumentoIVA">IVA</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                                                                <input type="text" id="DocumentoIVA" name="DocumentoIVA" class="form-control phone-mask" placeholder="Ingrese Monto IVA " aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="DocumentoArchivo">Archivo <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group ">
                                                                <input type="file" class="form-control" id="DocumentoArchivo" name="DocumentoArchivo">
                                                                <label class="input-group-text" for="DocumentoArchivo">Seleccione archivo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="DocumentoDetalle">Detalle <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-detail"></i></span>
                                                                <textarea id="DocumentoDetalle" name="DocumentoDetalle" class="form-control" placeholder="Escriba alguna descripción si es el caso" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
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
                                                            <button type="submit" id="BTNCompletarRegistroDocumento" class="btn btn-primary">Completar Registro</button>
                                                        </div>
                                                    </div>

                                                </form>
                                                <div id="mensajeCuenta">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-cambiar-estado-doc" role="tabpanel">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Cambiar estado de Documento</h5>
                                                <small class="text-muted float-end">Merged input group</small>
                                            </div>
                                            <div class="card-body">
                                                <form id="FormEstadoDocumento" method="POST">
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
                                                        <label for="DocumentoUpdateTipoPersona" class="col-sm-2 form-label">Tipo de Persona <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="DocumentoUpdateTipoPersona" name="DocumentoUpdateTipoPersona" onchange="ConsultarDocumentosDeCliente();" class="form-select">
                                                                    <option value="0">Seleccione un tipo</option>
                                                                    <option value="1">Persona Fisica</option>
                                                                    <option value="2">Persona Moral</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="DocumentoUpdateTipoDocumento" class="col-sm-2 form-label">Tipo de Documento <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="DocumentoUpdateTipoDocumento" name="DocumentoUpdateTipoDocumento" onchange="ConsultarDocumentosDeCliente();" class="form-select">
                                                                    <option value="0">Seleccione un tipo</option>
                                                                    <option value="1">SAT</option>
                                                                    <option value="2">Cedular</option>
                                                                    <option value="3">DIOT</option>
                                                                    <option value="4">OTRO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="DocumentoNuevoEstado" class="col-sm-2 form-label">ESTADO <strong>(*)</strong></label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <select id="DocumentoNuevoEstado" name="DocumentoNuevoEstado" onchange="" class="form-select">
                                                                    <option value="0">Seleccione ESTADO</option>
                                                                    <option value="1">PENDIENTE</option>
                                                                    <option value="2">COMPLETADO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="CajaResultadoDocumentos" class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="NuevaNEmpresa2">Resultados <strong>:</strong></label>
                                                        <div class="table-responsive text-nowrap">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>N°</th>
                                                                        <!-- <th>Tipo Persona</th>
                                                                        <th>Tipo Documento</th> -->
                                                                        <th>ISR</th>
                                                                        <th>IVA</th>
                                                                        <th>Mes</th>
                                                                        <th>Estado</th>
                                                                        <th>Opción</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="TablaUpdateDocumentos" class="table-border-bottom-0">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="mt-3">
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="ModalEditarDocumento" tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="modalCenterTitle">Editar Documento</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <input type="hidden" name="IdentificadorForUdapteDocumento" id="IdentificadorForUdapteDocumento">
                                                                            <div id="FormularioUpdate" class="modal-body">

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                                    Cerrar
                                                                                </button>
                                                                                <button type="button" class="btn btn-primary">Guardar Cambio</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- <div class="row mb-3">
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
                                                            <button type="submit" id="BTNCompletarUpdateEstadoDocumento" class="btn btn-primary">Guardar Cambios</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
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
    <script src="jvscons/funcionesjsAdmin.js"></script>
    <script type="text/javascript">
        buscarCliente();
        document.getElementById("ModalBuscarCliente").addEventListener("keyup", buscarCliente)
        document.getElementById("ModalBuscarEmpresa").addEventListener("keyup", buscarEmpresa)
        document.getElementById("ModalBuscarCliente2").addEventListener("keyup", buscarCliente2Prueba)
        $(document).ready(function() {
            $("#BTNCompletarUpdateEstadoDocumento").on('click', function(e) {
                e.preventDefault();
                CambiarEstadoDocumento();
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
        // pasar datos seleccionados del cliente
        $(document).on("click", "#SelectClienteDocumento", function() {
            var id = $(this).data("id");
            var valor = $(this).data("valor-nombre");

            // document.getElementById("DocumentoNCliente").setAttribute("value", id);

            document.getElementById("UsuarioNCliente2").setAttribute("value", valor);
            document.getElementById("identificadorCliente2").setAttribute("value", id);

        })
        // pasar datos seleccionados de la empresa  
        $(document).on("click", "#SelectRegistroForUpdateDocumento", function() {
            var id = $(this).data("id");
            document.getElementById("IdentificadorForUdapteDocumento").setAttribute("value", id);
            FormularioEditarDocumento();
        })
    </script>

    <?php
    include  "reciclables/scripts2.php";
    ?>
</body>

</html>