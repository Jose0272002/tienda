<?php
session_start();
$response = new stdClass();

include_once('../conexion.php');
$codusu = (isset($_SESSION['codusu']))? $_SESSION['codusu']:0;
$dirusu = $_POST['dirusu'];
$telusu = $_POST['telusu'];
$codpro = $_POST['codpro'];
$fecped = date("Y-m-d H:i:s");
$sql = "INSERT INTO `pedido`(`codped`, `codusu`, `codpro`, `fecped`, `estado`,`dirusuped`, `telusuped`) 
VALUES ('','$codusu','$codpro','$fecped','2','','')";
$result = mysqli_query($con, $sql);
if ($result) {
    $response->state = true;
} else {
    $response->state = false;
    $response->details = 'No se pudo actualizar el pedido';
}
mysqli_close($con);



header('Content-Type: application/json');
echo json_encode($response);
