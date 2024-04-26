// SOLO PROCEDIMIENTOS QUE PUEDA REALIZAR EL ADMIN NIVEL 2-3 
function CrearNuevaEmpresa() {
    var formData = new FormData();
    var identificadorCliente = $("#identificadorCliente").val();
    var NuevaNEmpresa = $("#NuevaNEmpresa").val();
    var EmpresaCosto = $("#EmpresaCosto").val();
    var EmpresaArchivoContrato = $("#EmpresaArchivoContrato")[0].files[0];
    var EmpresaDetalle = $("#EmpresaDetalle").val();
    let content = $("#mensajeCuenta");
    let FormNuevoDocumento = $("#FormNuevaEmpresa");

    formData.append('identificadorCliente', identificadorCliente);
    formData.append('NuevaNEmpresa', NuevaNEmpresa);
    formData.append('EmpresaCosto', EmpresaCosto);
    formData.append('EmpresaArchivoContrato', EmpresaArchivoContrato);
    formData.append('EmpresaDetalle', EmpresaDetalle);

    $.ajax({
        method: "POST",
        url: "ajxcons/CrearNuevaEmpresa.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            // console.log(data);
            if (data.trim() == "void") {
                //     window.location.href = "./";
                console.log(data);
                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar registrar un nuevo cliente</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hay campos obligatorios que han sido omitidos</div></div>');
            } else {
                if (data.trim() == "error") {
                    console.log(data);
                    content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar fotografía</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hubo un error al intentar actualizar datos.</div></div>');
                } else {
                    if (data.trim() == "correcto") {
                        console.log(data);
                        FormNuevoDocumento[0].reset();
                        $("#identificadorCliente").val("");
                        $("#identificadorEmpresa").val("");
                        $("#DocumentoNCliente").val("");
                        $("#DocumentoNEmpresa").val("");
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Documento publicado correctamente.</div></div>');
                    } else {
                        if (data.trim() == "errorfotoformato") {
                            console.log(data);
                            content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar fotografía</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">El archivo tiene un formato no permitido.</div></div>');
                        } else {
                            if (data.trim() == "correctoFoto") {
                                console.log(data);
                                $("#EnviarFoto").val("");
                                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Fotografía actualizada correctamente.</div></div>');
                            } else {
                                console.log(data);
                            }
                        }
                    }
                }
            }
        }
    });
}

function buscarCliente2Prueba() {
    let ModalBuscarCliente = document.getElementById("ModalBuscarCliente2").value
    let content = document.getElementById("tablaClientes2")

    let url = "ajxcons/buscarCliente.php"
    let formData = new FormData()
    formData.append('ModalBuscarCliente', ModalBuscarCliente)
    fetch(url, {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            content.innerHTML = data
        }).catch(err => console.log(err))
}

function CambiarEstadoUsuario() {
    var formData = new FormData();
    var identificadorCliente2 = $("#identificadorCliente2").val();
    var UsuarioEstado = $("#UsuarioEstado").val();
    let content = $("#mensajeCuenta");
    let FormAltaBajaUsuarios = $("#FormAltaBajaUsuarios");

    formData.append('identificadorCliente2', identificadorCliente2);
    formData.append('UsuarioEstado', UsuarioEstado);


    $.ajax({
        method: "POST",
        url: "ajxcons/CambiarEstadoUsuario.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            // console.log(data);
            if (data.trim() == "void") {
                //     window.location.href = "./";
                console.log(data);
                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar registrar un nuevo cliente</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hay campos obligatorios que han sido omitidos</div></div>');
            } else {
                if (data.trim() == "error") {
                    console.log(data);
                    content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar fotografía</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hubo un error al intentar actualizar datos.</div></div>');
                } else {
                    if (data.trim() == "correcto") {
                        console.log(data);
                        FormAltaBajaUsuarios[0].reset();
                        $("#identificadorCliente2").val("");
                        $("#UsuarioNCliente2").val("");
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Actualizacion Completada Correctamente.</div></div>');
                    } else {
                        if (data.trim() == "errorfotoformato") {
                            console.log(data);
                            content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar fotografía</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">El archivo tiene un formato no permitido.</div></div>');
                        } else {
                            if (data.trim() == "correctoFoto") {
                                console.log(data);
                                $("#EnviarFoto").val("");
                                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Fotografía actualizada correctamente.</div></div>');
                            } else {
                                console.log(data);
                            }
                        }
                    }
                }
            }
        }
    });
}

function buscarAsesor() {
    let ModalBuscarAsesor = document.getElementById("ModalBuscarAsesor").value
    let content = document.getElementById("tablaAsesores")

    let url = "ajxcons/buscarAsesor.php"
    let formData = new FormData()
    formData.append('ModalBuscarAsesor', ModalBuscarAsesor)
    fetch(url, {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            content.innerHTML = data
        }).catch(err => console.log(err))
}