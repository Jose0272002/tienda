<?php
include('../conexion.php');
$response=new stdClass();
$datos=[];
$i=0;
$text=$_POST['text'];
$sql="SELECT * FROM producto WHERE estado=1 AND nompro LIKE '%$text%'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
    $obj=new stdClass();
    $obj->codpro=$row['codpro'];
    $obj->nompro=$row['nompro'];
    $obj->despro=$row['despro'];
    $obj->prepro=$row['prepro'];
    $obj->Img_prod=$row['Img_prod'];
    $datos[$i]=$obj;
    $i++;
}
$response->datos=$datos;
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);