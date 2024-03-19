function acceso() {
    var datos = $("#formAuthentication").serialize();
    let content = $("#mensajeLogin");
    $.ajax({
        method: "POST",
        url: "ajxcons/acceso.php",
        data: datos,
        success: function(data) {
            // M.toast({html: data});
            console.log(data);
            if (data.trim()=="correcto") {
                window.location.href = "home.php";
                
            } else{ 
                if (data.trim()=="void") {
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
    var formData= new FormData();
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var phoneNumber = $("#phoneNumber").val();
    var upload = $("#upload")[0].files[0];
    // console.log(titulo);
    // console.log(foto);
    // alert(titulo);
    // alert(foto);
    formData.append('firstName',firstName);
    formData.append('lastName',lastName);
    formData.append('phoneNumber',phoneNumber);
    formData.append('upload',upload);
    $.ajax({
        method: "POST",
        url: "ajxcons/actualizarUsuario.php",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(data) {            
            // console.log(data);
            // if (data.trim()=="correcto") {
            //     window.location.href = "./";
            //     // M.toast({html: 'la condicion if en javascript esta funcionando'});
            // } else{  }
            // Si el código JavaScript funcionó, se mostrará el mensaje de confirmación            
            console.log(data);
        }
    });
}

