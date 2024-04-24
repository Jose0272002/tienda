<?php
include('../conexion.php');
$response=new stdClass();

function state2text($id){
    switch ($id){
        case 1: return "Pendiente de pago"; break;
        case 2: return "Pedido completado"; break;
        default : return "";break;
    }
}

$datos=[];
$i=0;
$sql='select *,ped.estado estadoped from pedido ped
inner join producto pro
on ped.codpro=pro.codpro
where ped.estado=1';
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
    $obj=new stdClass();
    $obj->codped=$row['codped'];
    $obj->codpro=$row['codpro'];
    $obj->nompro=$row['nompro'];
    $obj->prepro=$row['prepro'];
    $obj->Img_prod=$row['Img_prod'];
    $obj->fecped=$row['fecped'];
    $obj->dirusuped=$row['dirusuped'];
    $obj->telusuped=$row['telusuped'];
    $obj->estado=$row['estadoped'];
    $obj->estadotext=state2text($row['estadoped']);
    $datos[$i]=$obj;
    $i++;
}
$response->datos=$datos;
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);