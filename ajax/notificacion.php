<?php
    const METHOD= "AES-256-CBC";
    const SECRET_KEY='$AKIKOS@N20224';
    const SECRET_IV= '037970';

		/*--------- Encriptar cadenas ---------*/
		function encryption($row){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($row, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
        
$conn = new mysqli("localhost","root","","prestamos");
$fecha_actual=date("Y-m-d");
$hora_actual=date("H:i");

$sql = "SELECT * FROM `prestamo` p join cliente c on (p.cliente_id=c.cliente_id) where prestamo_fecha_final >='$fecha_actual' AND prestamo_hora_final>='$hora_actual' OR `prestamo_estado`='Prestamo' OR `prestamo_estado`='Reservacion'  limit 5";
$result = mysqli_query($conn, $sql);

$response='';
$c=1;
while($row=mysqli_fetch_array($result)) {

	/* Formate fecha */
	$fechaOriginal = $row["prestamo_fecha_final"];
	$fechaFormateada = date("d-m-Y", strtotime($fechaOriginal));

	$response = $response . 
	"<div class='notification-dropdown-text'>" .
    
	"<div class='notification-dropdown-icon info'>
	<i class='bi bi-exclamation-circle' style='color: #007bff;'></i>
            </div>"."<a href='../reservation-update/".encryption($row['prestamo_id'])."' class='dropdown-item'>".
	"<span class='notification-dropdown__title'>". $c . "- " . $row["prestamo_estado"]  ." Finalizada de ". $row["cliente_nombre"] . " ". $row["cliente_apellido"] . ", ". $row["prestamo_total"] . " </span>" . 
	"<span class='notification-dropdown__subtitle'>". $row["prestamo_observacion"]." </span>" .
	"</a>".
    "</div>";
     
	$c++;
}
if(!empty($response)) {
	print $response;
}
    

?>