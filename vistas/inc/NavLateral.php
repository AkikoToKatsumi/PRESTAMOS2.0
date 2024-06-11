<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      
          <div class="app-brand demo">

         

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
            
          </div>  
          <figure class="full-box nav-lateral-avatar">
            <img src="<?php echo SERVERURL; ?>vistas/assets/avatar/girlicon.png.png" class="img-fluid" alt="Avatar">
            <figcaption class="roboto-medium text-center" style="color: black;">
            <?php echo $_SESSION['nombre_spm']." ".$_SESSION['apellido_spm']; ?> 
            <br>
            <small class="roboto-condensed-light" style="color: black;">
              <?php echo $_SESSION['usuario_spm']; ?>
            </small>
          </figcaption>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="<?php echo SERVERURL; ?>home/"  class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">INICIO</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">CLIENTES</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>client-new/" class="menu-link">
                    <div data-i18n="Without menu">Agregar Clientes</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>client-list/" class="menu-link">
                    <div data-i18n="Without navbar">Lista de Clientes</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>client-search/" class="menu-link">
                    <div data-i18n="Container">Buscar Cliente</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">ITEMS</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>item-new/" class="menu-link">
                    <div data-i18n="Account">Agregar Items</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>item-list/" class="menu-link">
                    <div data-i18n="Notifications">Lista de Item</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>item-list" class="menu-link">
                    <div data-i18n="Connections">Buscar Item</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">PRESTAMOS</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>reservation-new/" class="menu-link">
                    <div data-i18n="Basic">Nuevo Prestamo</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>reservation-reservation/" class="menu-link" >
                    <div data-i18n="Basic">Reservaciones</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>reservation-pending/" class="menu-link" >
                    <div data-i18n="Basic">Prestamos</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>reservation-list/" class="menu-link" >
                    <div data-i18n="Basic"> Finalizados</div>
                  </a>
                </li>
				        <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>reservation-search/" class="menu-link">
                    <div data-i18n="Basic"> Buscar Por Fecha</div>
                  </a>
                </li>
              </ul>
            </li>
            <?php if($_SESSION['privilegio_spm']==1){ ?>
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">USUARIOS</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>user-new/" class="menu-link">
                    <div data-i18n="Error"> Nuevo usuario</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>user-list/" class="menu-link">
                    <div data-i18n="Under Maintenance"> Lista de usuarios </div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo SERVERURL; ?>user-search/" class="menu-link">
                    <div data-i18n="Under Maintenance"> Buscar Usuario </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="<?php echo SERVERURL; ?>company/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Empresa</div>
              </a>
            </li>

              <?php }?>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
     