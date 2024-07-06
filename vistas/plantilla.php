<?php
  session_start(['name'=>'SPM']);
?>
<!DOCTYPE html>
<html lang="es"


<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo COMPANY?></title>
    <?php include "./vistas/inc/Link.php"; ?>
    <meta name="description" content="" />

<!-- Favicon -->
   <link rel="shortcut icon" href="<?php echo SERVERURL; ?>assets/compiled/svg/akikoicon.png" type="image/x-icon">
  

<link rel="stylesheet" href="<?php echo SERVERURL; ?>assets/compiled/css/auth.css">
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>assets/compiled/css/app.css">
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>assets/compiled/css/app-dark.css">
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>assets/compiled/css/iconly.css">
</head>
<body>



<?php

$peticionAjax=false;
require_once "./controladores/vistasControlador.php";
$IV = new vistasControlador();

 $vistas = $IV-> obtener_vistas_controlador();
 //condicional para detectar login
 if ($vistas=="login" || $vistas=="404"){
    require_once "./vistas/contenidos/".$vistas."-view.php";

 }else{

$pagina=explode("/", $_GET['views']);

    require_once"./controladores/loginControlador.php";
    $lc = new loginControlador();

    if(!isset($_SESSION['token_spm']) || !isset($_SESSION['usuario_spm']) ||
    !isset($_SESSION['privilegio_spm']) || !isset($_SESSION['id_spm']) ){
    $lc->forzar_cierre_sesion_controlador() ;
exit();
    }
?>


    <?php include "./vistas/inc/NavLateral.php"; ?>
    
     
    <!-- Page content -->
    <section >         <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

        <?php 
        include  "./vistas/inc/Navbar.php"; 
        
        include "$vistas";
        ?>
                      
        <!-- / Content -->
    </section>

<?php 
include  "./vistas/inc/LogOut.php";
 } 
 include  "./vistas/inc/piepag.php";
include  "./vistas/inc/Script.php"; ?>
</body>
  


</html>