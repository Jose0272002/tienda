<?php
include('../conexion.php');
$response = new stdClass();
$datos = [];
$i = 0;

$precio_maximo = $_POST["precio_maximo"];
$precio_minimo = $_POST["precio_minimo"];
$categoria = $_POST["categoria"];
if ($categoria != "") {
    $sql = "SELECT * FROM producto
WHERE prepro BETWEEN $precio_minimo AND $precio_maximo AND catpro='$categoria';";
}
else{
    $sql = "SELECT * FROM producto
WHERE prepro BETWEEN $precio_minimo AND $precio_maximo";
}

$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
    $obj = new stdClass();
    $obj->codpro = $row['codpro'];
    $obj->nompro = $row['nompro'];
    $obj->despro = $row['despro'];
    $obj->prepro = $row['prepro'];
    $obj->Img_prod = $row['Img_prod'];
    $datos[$i] = $obj;
    $i++;
}
$response->datos = $datos;
mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);
