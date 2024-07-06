<div id="auth">
    <div class="row h-100">
        <div class="col-lg-4 col-12">
            <div id="auth-left">
                <div class="auth-logo" style="margin: 0px 0px 0 -50px;">
                    <a href="<?php echo SERVERURL; ?>index.php">
                        <img src="<?php echo SERVERURL; ?>assets/compiled/svg/logoaki2.png" alt="Logo">
                    </a>
                </div>
                <h1 class="auth-title">Log in</h1>
                <p class="auth-subtitle mb-5">Introduce tus datos para iniciar sesión</p>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" id="UserName" name="usuario_log" pattern="[a-zA-Z0-9]{1,35}" maxlength="35" required="" placeholder="Usuario">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" id="UserPassword" name="clave_log" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" placeholder="Contraseña">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn-login text-center">LOG IN</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12 d-flex justify-content-center align-items-center">
            <img src="<?php echo SERVERURL; ?>vistas/assets/img/SP.png" alt="Préstamo" style="width: 92%; height: auto;">
        </div>
    </div>
</div>

<?php
if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
    require_once "./controladores/loginControlador.php";
    $ins_login = new loginControlador();
    $ins_login->iniciar_sesion_controlador();
}
?>
