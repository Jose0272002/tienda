<?php
session_start();
$response=new stdClass();
if(!isset($_SESSION['codusu'])){
    $response->state=false;
    $response->details='no ha iniciado sesión';
    $response->open_login=true;
}   

 else{
    include_once('../conexion.php');
    $codusu=$_SESSION['codusu'];
    $codpro=$_POST['codpro'];
    $sql="insert into pedido
    (codusu,codpro,fecped,estado,dirusuped,telusuped)
     values
     ($codusu,$codpro,now(),1,'','')";
    $result=mysqli_query($con,$sql);
    if($result){
        $response->state=true;
        $response->details='Producto agregado con exito';
    }
    else {
        $response->state=false;
        $response->details='Error al agregar el producto';
    }
    mysqli_close($con);
}
    

header('Content-Type: application/json');
echo json_encode($response);

?>