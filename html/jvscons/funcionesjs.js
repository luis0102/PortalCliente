function acceso() {
    var datos = $("#formAuthentication").serialize();
    let content = $("#mensajeLogin");
    $.ajax({
        method: "POST",
        url: "ajxcons/acceso.php",
        cache: false,
        data: datos,
        success: function (data) {
            // M.toast({html: data});
             console.log(data);
            if (data.trim() == '1') {
                window.location.href = "home.php";

            } else {
                if (data.trim() == '2') {
                    window.location.href = "AdminHome.php";
                } else {
                    if (data.trim() == "void") {
                        // console.log(data);
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar iniciar sesión</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hay campos vacíos .</div></div>');
                    }
                    else {
                        // console.log(data);
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar iniciar sesión</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Revise su email y contraseña .</div></div>');
                    }
                }
            }

        }
    });
}
function actualizarUsuario() {
    var formData = new FormData();
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var phoneNumber = $("#phoneNumber").val();

    let content = $("#mensajeCuenta");

    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('phoneNumber', phoneNumber);

    $.ajax({
        method: "POST",
        url: "ajxcons/actualizarUsuario.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            // console.log(data);
            if (data.trim() == "void") {
                //     window.location.href = "./";
                console.log(data);
                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar Datos</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hay campos vacíos .</div></div>');
            } else {
                if (data.trim() == "error") {
                    console.log(data);
                    content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar Datos</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hubo un error al intentar actualizar datos.</div></div>');
                } else {
                    if (data.trim() == "correcto") {
                        console.log(data);
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Datos actualizados correctamente.</div></div>');
                    } else {
                        if (data.trim() == "desigual") {
                            console.log(data);
                            content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar Datos</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Las dos nuevas contraseñas son distintas.</div></div>');
                        } else {
                            if (data.trim() == "correctoFoto") {
                                console.log(data);
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
function actualizarFoto() {

    var formData = new FormData();
    var upload = $("#upload")[0].files[0];
    let content = $("#mensajeCuenta");
    formData.append('upload', upload);
    $.ajax({
        method: "POST",
        url: "ajxcons/actualizarFoto.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            // console.log(data);
            if (data.trim() == "void") {
                //     window.location.href = "./";
                console.log(data);
                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar fotografía</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Seleccione una imagen...</div></div>');
            } else {
                if (data.trim() == "error") {
                    console.log(data);
                    content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar fotografía</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hubo un error al intentar actualizar datos.</div></div>');
                } else {
                    if (data.trim() == "correcto") {
                        console.log(data);
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Datos actualizados correctamente.</div></div>');
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
function actualizarPassword() {
    var formData = new FormData();
    var clave_actual = $("#clave_actual").val();
    var clave = $("#clave").val();
    var clave2 = $("#clave2").val();
    let content = $("#mensajeCuenta");

    formData.append('clave_actual', clave_actual);
    formData.append('clave', clave);
    formData.append('clave2', clave2);

    $.ajax({
        method: "POST",
        url: "ajxcons/actualizarPassword.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            // console.log(data);
            if (data.trim() == "void") {
                //     window.location.href = "./";
                console.log(data);
                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar contraseña</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hay campos vacíos .</div></div>');
            } else {
                if (data.trim() == "error") {
                    console.log(data);
                    content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar contraseña</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hubo un error al intentar actualizar datos.</div></div>');
                } else {
                    if (data.trim() == "correcto") {
                        console.log(data);
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Datos actualizados correctamente.</div></div>');
                    } else {
                        if (data.trim() == "desigual") {
                            console.log(data);
                            content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar contraseña</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">La contraseña y su confirmación no coinciden</div></div>');
                        } else {
                            if (data.trim() == "no") {
                                console.log(data);
                                content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar actualizar contraseña</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">La contraseña ingresada no coincide con la actual</div></div>');
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

function CrearNuevoCliente() {
    var formData = new FormData();
    var ClienteNombres = $("#ClienteNombres").val();
    var ClienteApellidos = $("#ClienteApellidos").val();
    var ClienteTelef = $("#ClienteTelef").val();
    var ClientePlanServicio = $("#ClientePlanServicio").val();
    var ClienteServicioContratado = $("#ClienteServicioContratado").val();
    var ClienteFecha_af = $("#ClienteFecha_af").val();
    var ClienteCosto = $("#ClienteCosto").val();
    var ClienteAsesor = $("#ClienteAsesor").val();
    var ClienteEmpresa = $("#ClienteEmpresa").val();
    var ClienteContrato = $("#ClienteContrato")[0].files[0];
    var ClienteDetalleContrato = $("#ClienteDetalleContrato").val();
    var ClienteEmail = $("#ClienteEmail").val();
    var ClientePassword = $("#ClientePassword").val();
    let content = $("#mensajeCuenta");
    let FormNuevoCliente = $("#FormNuevoCliente");

    formData.append('ClienteNombres', ClienteNombres);
    formData.append('ClienteApellidos', ClienteApellidos);
    formData.append('ClienteTelef', ClienteTelef);
    formData.append('ClientePlanServicio', ClientePlanServicio);
    formData.append('ClienteServicioContratado', ClienteServicioContratado);
    formData.append('ClienteFecha_af', ClienteFecha_af);
    formData.append('ClienteCosto', ClienteCosto);
    formData.append('ClienteAsesor', ClienteAsesor);
    formData.append('ClienteEmpresa', ClienteEmpresa);
    formData.append('ClienteContrato', ClienteContrato);
    formData.append('ClienteDetalleContrato', ClienteDetalleContrato);
    formData.append('ClienteEmail', ClienteEmail);
    formData.append('ClientePassword', ClientePassword);
    $.ajax({
        method: "POST",
        url: "ajxcons/CrearNuevoCliente.php",
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
                        FormNuevoCliente[0].reset();
                        content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Mensaje:</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Cliente Registrado correctamente.</div></div>');
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

function CrearNuevoDocumento() {
    var formData = new FormData();
    var DocumentoTipoPersona = $("#DocumentoTipoPersona").val();
    var DocumentoTipoDocumento = $("#DocumentoTipoDocumento").val();
    var DocumentoEstado = $("#DocumentoEstado").val();
    var identificadorCliente = $("#identificadorCliente").val();
    var identificadorEmpresa = $("#identificadorEmpresa").val();
    var DocumentoMes = $("#DocumentoMes").val();
    var DocumentoAnio = $("#DocumentoAnio").val();
    var DocumentoISR = $("#DocumentoISR").val();
    var DocumentoIVA = $("#DocumentoIVA").val();
    var DocumentoArchivo = $("#DocumentoArchivo")[0].files[0];
    var DocumentoDetalle = $("#DocumentoDetalle").val();
    let content = $("#mensajeCuenta");
    let FormNuevoDocumento = $("#FormNuevoDocumento");
    // var DocumentoNCliente = $("#DocumentoNCliente").val();
    // var DocumentoNEmpresa = $("#DocumentoNEmpresa").val();

    formData.append('DocumentoTipoPersona', DocumentoTipoPersona);
    formData.append('DocumentoTipoDocumento', DocumentoTipoDocumento);
    formData.append('DocumentoEstado', DocumentoEstado);
    formData.append('identificadorCliente', identificadorCliente);
    formData.append('identificadorEmpresa', identificadorEmpresa);
    formData.append('DocumentoMes', DocumentoMes);
    formData.append('DocumentoAnio', DocumentoAnio);
    formData.append('DocumentoISR', DocumentoISR);
    formData.append('DocumentoIVA', DocumentoIVA);
    formData.append('DocumentoArchivo', DocumentoArchivo);
    formData.append('DocumentoDetalle', DocumentoDetalle);

    $.ajax({
        method: "POST",
        url: "ajxcons/CrearNuevoDocumento.php",
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

function buscarCliente() {
    let ModalBuscarCliente = document.getElementById("ModalBuscarCliente").value
    let content = document.getElementById("tablaClientes")

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

function buscarEmpresa() {
    let ModalBuscarEmpresa = document.getElementById("ModalBuscarEmpresa").value
    let identificadorCliente = document.getElementById("identificadorCliente").value
    let content = document.getElementById("tablaEmpresa")

    let url = "ajxcons/buscarEmpresa.php"
    let formData = new FormData()
    formData.append('ModalBuscarEmpresa', ModalBuscarEmpresa)
    formData.append('identificadorCliente', identificadorCliente)
    fetch(url, {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            content.innerHTML = data
        }).catch(err => console.log(err))
}