<?php
include('../conexion.php');
$response = new stdClass();

session_start();
$codusu = $_SESSION["codusu"];
$datos = [];
$i = 0;
$sql = "select ped.*,pro.*, 
case  when ped.estado='2' then 
    'Completado'
else
    'Pendiente de pago'

end estadotxt
from pedido ped
inner join producto pro
on ped.codpro=pro.codpro 
where ped.codusu=$codusu";

$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $obj = new stdClass();
    $obj->codpro = $row['codpro'];
    $obj->nompro = $row['nompro'];
    $obj->despro = $row['despro'];
    $obj->fecped = $row['fecped'];
    $obj->catpro = $row['catpro'];
    $obj->dirusuped = $row['dirusuped'];
    $obj->telusuped = $row['telusuped'];
    $obj->prepro = $row['prepro'];
    $obj->estado = $row['estadotxt'];
    $obj->Img_prod = $row['Img_prod'];
    $datos[$i] = $obj;
    $i++;
}
$response->datos = $datos;
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
