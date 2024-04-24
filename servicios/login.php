<?php
//1:error de conexión
//2:email invalido
//3:contraseña incorrecta
include('conexion.php');
$emausu=$_POST['emausu'];
$sql="SElECT * FROM USUARIO WHERE emausu='$emausu'";
$result=mysqli_query($con,$sql);
if($result){
    $row=mysqli_fetch_array($result);
    $cont=mysqli_num_rows($result);
    if($cont!=0){
        $pasusu=$_POST['pasusu'];
        if($row['pasusu']!=$pasusu){
            header('Location:../login.php?e=3');
        }
        else{
            session_start();
            $_SESSION['codusu']=$row['codusu'];
            $_SESSION['emausu']=$row['emausu'];
            $_SESSION['nomusu']=$row['nomusu'];
            header('Location:../');
        }
    }
    else{
        
        header('Location:../login.php?e=2');
    }
}
else{
    
    header('Location:../login.php?e=1');
}