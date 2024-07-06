
</div>
<nav class="navbar navbar-expand navbar-light px-4 py-0">

<ul class="navbar-nav flex-row align-items-center ms-auto">

              <script type="text/javascript">
                    function myFunction() {
                      $.ajax({
                        url: "../ajax/notificacion.php",
                        type: "POST",
                        processData:false,
                        success: function(data){
                          $("#notification-count").remove();                  
                          $("#notification-latest").show();$("#notification-latest").html(data);
                        },
                        error: function(){}           
                      });
                    }
                                              
                    $(document).ready(function() {
                      $('body').click(function(e){
                        if ( e.target.id != 'notificationDropdown'){
                          $("#notification-latest").hide();
                        }
                      });
                    });                                     
                  </script>
                    <?php
                    $fecha_actual=date("Y-m-d");
                    $hora_actual=date("H:i");
                  $conn = new mysqli("localhost","root","","prestamos");
                  $count = 0;
                  $sql2 = "SELECT * FROM `prestamo` p join cliente c on (p.cliente_id=c.cliente_id) where prestamo_fecha_final >='$fecha_actual' AND prestamo_hora_final >='$hora_actual' OR `prestamo_estado`='Prestamo' OR `prestamo_estado`='Reservacion'";
                  $result = mysqli_query($conn, $sql2);
                  $count = mysqli_num_rows($result);
                  ?>
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"  id="notificationDropdown" onclick="myFunction()"data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2" style='color: #007bff;'> <?php if ($count>0){?><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $count; }?> </span></i>
                            <span class="d-none d-lg-inline-flex">Notificaciones</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0" id="notification-latest" >
                           
                            
                        </div>
                    </div>
                    </li>
                <!-- Place this tag where you want the button to render. -->
                
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                    <img src="<?php echo SERVERURL;?>vistas/assets/avatar/girlicon.png.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                            <img src="<?php echo SERVERURL;?>vistas/assets/avatar/girlicon.png.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">GABRIELA GARCÍA</span>
                            <small class="text-muted">Admin DB</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo SERVERURL; ?>user-update/<?php echo $lc->encryption($_SESSION['id_spm']) ?>">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Usuario</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo SERVERURL; ?>login/" >
                        <i class="bx bx-power-off me-2"></i>
                        <span class="btn-exit-system">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>

                  </nav>

</div>


        <div id="main">
          
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> 
            
            
            
