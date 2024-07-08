
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script
	  src="https://code.jquery.com/jquery-3.3.1.min.js"
	  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	  crossorigin="anonymous">
	</script>


    <!-- Icon Cards-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prestamos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT Count(cliente_id) from cliente  ";
if (mysqli_query($conn, $sqll))
{
echo "";
}
else
{
echo "Error: " . $sqll . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, $sqll);
if (mysqli_num_rows($result) > 0)
{
// output data of each row
while($row = mysqli_fetch_assoc($result))
{
?>
<section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="<?php echo SERVERURL; ?>client-list/">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Clientes</h6>
                                    <h6 class="font-extrabold mb-0"><?php echo $row['Count(cliente_id)']; ?></h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                    </a>
                </div>
			
                <div class="col-6 col-lg-3 col-md-6">
                <a href="<?php echo SERVERURL; ?>user-list/">
                    <div class="card"> 
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">

<?php
}
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prestamos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT Count(usuario_id) from usuario  ";
if (mysqli_query($conn, $sqll))
{
echo "";
}
else
{
echo "Error: " . $sqll . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, $sqll);
if (mysqli_num_rows($result) > 0)
{
// output data of each row
while($row = mysqli_fetch_assoc($result))
{
?>
<h6 class="text-muted font-semibold">Usuarios</h6>
<h6 class="font-extrabold mb-0"><?php echo $row['Count(usuario_id)'];?></h6>


<?php
}
}
else
{
echo '0 results';
}
?>
                                </div>
                            </div>
                        </div>
                    </div>
</a>
                </div>
          <div class="col-6 col-lg-3 col-md-6">
          <a  href="<?php echo SERVERURL; ?>item-list/">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prestamos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT Count(item_id) from item  ";
if (mysqli_query($conn, $sqll))
{
echo "";
}
else
{
echo "Error: " . $sqll . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, $sqll);
if (mysqli_num_rows($result) > 0)
{
// output data of each row
while($row = mysqli_fetch_assoc($result))
{
?>
  <h6 class="text-muted font-semibold">Items</h6>
  <h6 class="font-extrabold mb-0"><?php echo $row['Count(item_id)'];?></h6>

<?php
}
}
else
{
echo '0 results';
}
?>

             </div>
                        </div>
                    </div>
                </div>
</a>
</div>

            <div class="col-6 col-lg-3 col-md-6">
            <a href="<?php echo SERVERURL; ?>reservation-reservation/">
         
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prestamos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqlll = "SELECT Count(prestamo_id) from prestamo ";
if (mysqli_query($conn, $sqlll))
{
echo "";
}
else
{
echo "Error: " . $sqlll . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, $sqlll);
if (mysqli_num_rows($result) > 0)
{
// output data of each row
while($row = mysqli_fetch_assoc($result))
{
?>
   <h6 class="text-muted font-semibold">Cant de prestamos</h6>
   <h6 class="font-extrabold mb-0"><?php echo $row['Count(prestamo_id)'];?></h6>
<?php
}
}
else
{
echo '0 results';
}
?>
 
                            </div>
                        </div>
                    </div>
                </div>
</a>
            </div>

            <div class="row">
                
                <div class="col-12">
                    
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafica</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body" id="container" style="width:100%; height:400px;"></div>
	                        <br><br>
                        </div>
                    </div>
                </div>
            </div> </div> </div>
            <div class="col-12 col-lg-3">
           
            <div class="card">
                <div class="card-header">
                    <h4>Total de Prestamos</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
  <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
</svg>
                        </div>
                        <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prestamos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT Count(prestamo_id), sum(prestamo_pagado) from prestamo where prestamo_estado= 'Reservacion'  ";
if (mysqli_query($conn, $sqll))
{
echo "";
}
else
{
echo "Error: " . $sqll . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, $sqll);
if (mysqli_num_rows($result) > 0)
{
// output data of each row
while($row = mysqli_fetch_assoc($result))
{
?>                       <a href="<?php echo SERVERURL; ?>reservation-reservation/">
                        <div class="name ms-4">
                            <h5 class="mb-1">Reservaciones</h5>
                            <h6 class="text-muted mb-0">Cantidad de Reservaciones <span class="badge badge-info"><?php echo $row['Count(prestamo_id)'];?></span></h6>
                            <h6 class="text-muted mb-0">Pagos de Reservaciones <span class="badge badge-success">$ <?php echo $row['sum(prestamo_pagado)'];?></span></h6>
                        </div>
</a>
                    </div>
                    <?php
}
}
else
{
echo '0 results';
}
?>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
  <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
</svg>
                        </div>
                        <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prestamos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT Count(prestamo_id), sum(prestamo_pagado) from prestamo where prestamo_estado= 'Prestamo'  ";
if (mysqli_query($conn, $sqll))
{
echo "";
}
else
{
echo "Error: " . $sqll . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, $sqll);
if (mysqli_num_rows($result) > 0)
{
// output data of each row
while($row = mysqli_fetch_assoc($result))
{
?>                        <a href="<?php echo SERVERURL; ?>reservation-pending/">
                        <div class="name ms-4">
                            <h5 class="mb-1">Prestamos Activo</h5>
                            <h6 class="text-muted mb-0">Cantidad de Prestamos <span class="badge badge-info"><?php echo $row['Count(prestamo_id)'];?></span></h6>
                            <h6 class="text-muted mb-0">Pagos de Prestamos <span class="badge badge-success">$ <?php echo $row['sum(prestamo_pagado)'];?></span></h6>
                        </div></a>
                    </div>
                    <?php
}
}
else
{
echo '0 results';
}
?>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
  <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
</svg>
                        </div>
                        <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prestamos";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT Count(prestamo_id), sum(prestamo_total) from prestamo where prestamo_estado= 'Finalizado'  ";
if (mysqli_query($conn, $sqll))
{
echo "";
}
else
{
echo "Error: " . $sqll . "<br>" . mysqli_error($conn);
}
$result = mysqli_query($conn, $sqll);
if (mysqli_num_rows($result) > 0)
{
// output data of each row
while($row = mysqli_fetch_assoc($result))
{
?>                       <a href="<?php echo SERVERURL; ?>reservation-list/">
                        <div class="name ms-4">
                            <h5 class="mb-1">Prestamo Finalizados</h5>
                            <h6 class="text-muted mb-0">Cantidad de Finalizado <span class="badge badge-info"><?php echo $row['Count(prestamo_id)'];?></span></h6>
                            <h6 class="text-muted mb-0">Pagos total <span class="badge badge-success">$ <?php echo $row['sum(prestamo_total)'];?></span></h6>
                        </div></a>
                    </div>
                    <?php
}
}
else
{
echo '0 results';
}
?>
                </div>
            </div> 
           
        </div>
            
            
            </section>
	<script type="text/javascript">
		$(function () {
		    var myChart = Highcharts.chart('container',{
		        chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie'
					},
                    title: {
						text: 'Prestamos'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								format: '<b>{point.name}</b>: {point.percentage:.1f} %',
								style: {
									color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
								}
							}
						}
					},
       
                    series: [{
                    type: 'pie',
                    name: 'Hay un',
                    data: [
                    <?php
                        include "connection.php";
                        $query = mysqli_query($con,"SELECT * from prestamo group by prestamo_estado");
                     
                        while ($row = mysqli_fetch_array($query)) {
                          $idciudad= $row['prestamo_id'];
                            $browsername = $row['prestamo_estado'];
                         
                            $data = mysqli_fetch_array(mysqli_query($con,"SELECT count(prestamo_id) from prestamo where prestamo_id='$idciudad'"));
                            $jumlah = $data['count(prestamo_id)'];
                            ?>
                            [ 
                                '<?php echo $browsername ?>', <?php echo $jumlah; ?>
                            ],
                            <?php
                        }
                        ?>
             
                    ]
                }]
		    });
		});
	</script>
	