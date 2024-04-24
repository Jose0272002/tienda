<?php
session_start();
$response = new stdClass();

include_once('../conexion.php');
$codusu = $_SESSION['codusu'];
$dirusu = $_POST['dirusu'];
$telusu = $_POST['telusu'];
$sql = "update pedido set estado=2
    where estado=1";
$result = mysqli_query($con, $sql);
if ($result) {
    $response->state = true;
} else {
    $response->state = false;
    $response->details = 'No se pudo al actualizar el pedido';
}
mysqli_close($con);



header('Content-Type: application/json');
echo json_encode($response);
