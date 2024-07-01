<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Sistema de Gestión de Préstamos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .page-header {
            margin-bottom: 20px;
        }

        .page-header h3 {
            display: flex;
            align-items: center;
            font-size: 24px;
            color: #007bff;
        }

        .page-header p {
            color: #6c757d;
            font-size: 16px;
        }

        .tile-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-decoration: none;
            color: #333;
            transition: transform 0.3s;
            text-align: center;
        }

        .tile:hover {
            transform: translateY(-5px);
        }

        .tile-icon i {
            font-size: 48px;
            color: #007bff;
        }

        .tile-tittle {
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold;
        }

        .tile-icon p {
            margin-top: 5px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="material-icons">home</i> &nbsp; INICIO
    </h3>
    <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
    </p>
</div>

<!-- Content -->
<div class="full-box tile-container">
    <?php
    require_once "./controladores/clienteControlador.php";
    $ins_cliente = new clienteControlador();

    $total_clientes = $ins_cliente->datos_cliente_controlador("Conteo",0);    
    ?>
    <a href="<?php echo SERVERURL; ?>client-new/" class="tile">
        <div class="tile-icon">
            <i class="material-icons">group</i>
            <p><?php echo $total_clientes->rowCount(); ?> Registrados</p>
        </div>
        <div class="tile-tittle">Clientes</div>
    </a>

    <?php
    require_once "./controladores/itemControlador.php";
    $ins_item = new itemControlador();

    $total_items= $ins_item->datos_item_controlador("Conteo",0);    
    ?>
    <a href="<?php echo SERVERURL; ?>item-list/" class="tile">
        <div class="tile-icon">
            <i class="material-icons">inventory</i>
            <p><?php echo $total_items->rowCount(); ?> Registrados</p>
        </div>
        <div class="tile-tittle">Items</div>
    </a>

    <?php
    require_once "./controladores/prestamoControlador.php";
    $ins_prestamo = new prestamoControlador();

    $total_prestamo= $ins_prestamo->datos_prestamo_controlador("Conteo_Prestamos",0);
    $total_reservaciones= $ins_prestamo->datos_prestamo_controlador("Conteo_Reservacion",0);    
    $total_finalizado= $ins_prestamo->datos_prestamo_controlador("Conteo_Finalizado",0);    
    ?>
    <a href="<?php echo SERVERURL; ?>reservation-reservation/" class="tile">
        <div class="tile-icon">
            <i class="material-icons">event</i>
            <p><?php echo $total_reservaciones->rowCount(); ?></p>
        </div>
        <div class="tile-tittle">Reservaciones</div>
    </a>

    <a href="<?php echo SERVERURL; ?>reservation-pending/" class="tile">
        <div class="tile-icon">
            <i class="material-icons">monetization_on</i>
            <p><?php echo $total_prestamo->rowCount(); ?></p>
        </div>
        <div class="tile-tittle">Préstamos</div>
    </a>
                
    <a href="<?php echo SERVERURL; ?>reservation-list/" class="tile">
        <div class="tile-icon">
            <i class="material-icons">check_circle</i>
            <p><?php echo $total_finalizado->rowCount(); ?></p>
        </div>
        <div class="tile-tittle">Finalizados</div>
    </a>
    
    <?php if($_SESSION['privilegio_spm']==1){
        require_once("./controladores/usuarioControlador.php");
        $ins_usuario = new usuarioControlador();
        $total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
    ?>
    <a href="<?php echo SERVERURL; ?>user-list/" class="tile">
        <div class="tile-icon">
            <i class="material-icons">person</i>
            <p><?php echo $total_usuarios->rowCount();?> Registrados</p>
        </div>
        <div class="tile-tittle">Usuarios</div>
    </a>
    <?php }?>

    <a href="<?php echo SERVERURL; ?>company/" class="tile">
        <div class="tile-icon">
            <i class="material-icons">business</i>
            <p>1 Registrada</p>
        </div>
        <div class="tile-tittle">Empresa</div>
    </a>
</div>

</body>
</html>
