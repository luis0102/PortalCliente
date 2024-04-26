<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo" style="background-color: #D0D3D4;">
    <a href="home.php" class="app-brand-link gap-2">
      <span class="app-brand-logo demo">
        <img src="img/icons.png" height="60px" alt="Company Logo">

      </span>
      <!-- <span class="app-brand-text demo text-body fw-bolder">Consultancy</span> -->
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="home.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Inicio</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Layouts</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="layouts-without-menu.html" class="menu-link">
            <div data-i18n="Without menu">Without menu</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-without-navbar.html" class="menu-link">
            <div data-i18n="Without navbar">Without navbar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-container.html" class="menu-link">
            <div data-i18n="Container">Container</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-fluid.html" class="menu-link">
            <div data-i18n="Fluid">Fluid</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-blank.html" class="menu-link">
            <div data-i18n="Blank">Blank</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">MENU</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">Mi Perfil</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="cuenta.php" class="menu-link">
            <div data-i18n="Account">Cuenta</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="datosEmpresariales.php" class="menu-link">
            <div data-i18n="Notifications">Información empresarial</div>
          </a>
        </li>
        <!-- <li class="menu-item">
          <a href="pages-account-settings-connections.html" class="menu-link">
            <div data-i18n="Connections"></div>
          </a>
        </li> -->
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-pie-chart-alt-2"></i>
        <div data-i18n="Misc">Información Tributaria</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="PersonaFisica.php" class="menu-link">
            <div data-i18n="Error">Persona Física</div>
          </a>
        </li>
        <?php if ($contExistEmpresas>0) {
          echo '<li class="menu-item">
          <a href="PersonaMoral.php" class="menu-link">
            <div data-i18n="Under Maintenance">Persona Moral</div>
          </a>
        </li>';
        }?>
      </ul>
    </li>    
    <!-- Misc -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Consultancy</span></li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-dollar-circle"></i>
        <div data-i18n="Misc">Servicios</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="MisPagos.php" class="menu-link">
            <div data-i18n="Error">Mis pagos</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="documentacion.php" class="menu-link">
            <div data-i18n="Under Maintenance">Documentación</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="MiSoporte.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-support"></i>
        <div data-i18n="Support">Soporte</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->