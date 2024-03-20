function acceso() {
    var datos = $("#formAuthentication").serialize();
    let content = $("#mensajeLogin");
    $.ajax({
        method: "POST",
        url: "ajxcons/acceso.php",
        data: datos,
        success: function (data) {
            // M.toast({html: data});
            console.log(data);
            if (data.trim() == "correcto") {
                window.location.href = "home.php";

            } else {
                if (data.trim() == "void") {
                    console.log(data);
                    content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar iniciar sesión</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Hay campos vacíos .</div></div>');
                }
                else {
                    console.log(data);
                    content.html('<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Error al intentar iniciar sesión</div><small>Hace 1 seg</small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">Revise su email y contraseña .</div></div>');
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

