<?php
$titular = $_SESSION['nus_PORTALCONSULTANCY'];

$dataBarra = mysqli_query($con, "select a.idasesor as dat1, p.idpersona as dat2, p.nombre as dat3, p.apellido as dat4, u.email as dat5, p.telefono as dat6
from usuario u,persona p, asesor a where u.idusuario=p.idusuario and p.idpersona=a.idpersona and u.email='$titular';");
while ($ArrayMiAdmin_Home = mysqli_fetch_array($dataBarra)) {
    $IdAsesor = $ArrayMiAdmin_Home['dat1'];
    $IdPersona = $ArrayMiAdmin_Home['dat2'];
    $AdminNombre=$ArrayMiAdmin_Home['dat3'];
    $AdminApellido=$ArrayMiAdmin_Home['dat4'];
    $AdminEmail=$ArrayMiAdmin_Home['dat5'];
    $AdminTelef=$ArrayMiAdmin_Home['dat6'];
}

// if ($contExistEmpresas == 0) {
//     $ConsultaDatoEmpresas = mysqli_query($con, "select  concat(p.apellido,' ',p.nombre) as dat2, p.telefono as dat3, a.detalle_horario as dat4 
//     from persona p, cliente c, info i , asesor a  
//     where c.idcliente=i.idcliente and i.idasesor=a.idasesor and a.idpersona=p.idpersona and c.idcliente=$Hidcliente ;");

//     while ($ArrayEmpresas_Home = mysqli_fetch_array($ConsultaDatoEmpresas)) {

//         $Hcliente = $ArrayEmpresas_Home['dat2'];
//         $Htelefono = $ArrayEmpresas_Home['dat3'];
//         $HHorario = $ArrayEmpresas_Home['dat4'];
//     }
// } else {
//     $ConsultaDatoEmpresas = mysqli_query($con, "select e.dato as dat1, concat(p.apellido,' ',p.nombre) as dat2, p.telefono as dat3, a.detalle_horario as dat4 
//     from persona p, cliente c, info i , asesor a, empresa e 
//     where c.idcliente=i.idcliente and c.idcliente=e.idcliente and i.idasesor=a.idasesor and a.idpersona=p.idpersona and c.idcliente=$Hidcliente ;");

//     while ($ArrayEmpresas_Home = mysqli_fetch_array($ConsultaDatoEmpresas)) {
//         $Hempresa = $ArrayEmpresas_Home['dat1'];
//         $Hcliente = $ArrayEmpresas_Home['dat2'];
//         $Htelefono = $ArrayEmpresas_Home['dat3'];
//         $HHorario = $ArrayEmpresas_Home['dat4'];
//     }
// }
?>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Buscar..." aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <li class="nav-item lh-1 me-3">
                <div class="btn-group" role="group" aria-label="First group">
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="tf-icons bx bx-time"></i>
                    </button>
                    <button id="hora-mexico" type="button" style="width: 100px; height: 40px;  overflow: hidden;" class="btn btn-outline-secondary">
                    </button>

                </div>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="<?php if ($HFotoUsuario == "") {
                                        echo "../assets/img/avatars/8.png";
                                    } else {
                                        echo "./fotosPerfil/" . $HFotoUsuario;
                                    } ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                    <!-- -- ../assets/img/avatars/8.png -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="cuenta.php">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="<?php if ($HFotoUsuario == "") {
                                                        echo "../assets/img/avatars/8.png";
                                                    } else {
                                                        echo "./fotosPerfil/" . $HFotoUsuario;
                                                    } ?>" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block"><?php echo $_SESSION['cliente_PORTALCONSULTANCY']; ?></span>
                                    <small class="text-muted">En Línea</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <!-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Mi Perfil</span>
                        </a>
                    </li> -->
                    <!-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Configuraciones</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                <span class="flex-grow-1 align-middle">Billing</span>
                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                            </span>
                        </a>
                    </li> -->
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="BD/cerrar_sesion.php">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Cerrar Sesión</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>