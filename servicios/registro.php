<?php
//1:error de conexión
//2:email invalido
//3:contraseña incorrecta
include('conexion.php');
$emausu = $_POST['emausur'];
$nomusu = $_POST['nomusur'];
$apusur = $_POST['apusur'];

$sql = "SElECT * FROM USUARIO WHERE emausu='$emausu'";
$result = mysqli_query($con, $sql);
if (empty($emausu) || empty($nomusu) || empty($apusur)) {
    header('Location:../registro.php?er=1');exit(); 
} else if ($result) {
    $row = mysqli_fetch_array($result);
    $cont = mysqli_num_rows($result);
    if ($cont == 0) {
        $pasusu = $_POST['pasusur'];
        $pasusu2 = $_POST['pasusur2'];


        $pattern = '/^[a-zA-Z0-9]+$/';

        if (!preg_match($pattern, $pasusu) || strlen($pasusu) < 8) {
            header('Location:../registro.php?er=4');
            exit(); 
        }
        else {
            $sql = "insert into usuario (codusu,nomusu,apeusu,emausu,pasusu,estado)
            values ('','$nomusu','$apusur','$emausu','$pasusu',1)";

                $result = mysqli_query($con, $sql);
                $codusu = mysqli_insert_id($con);
                session_start();
                $_SESSION['codusu'] = $codusu;
                $_SESSION['emausu'] = $emausu;
                $_SESSION['nomusu'] = $row['nomusu'];
                header('Location:../');exit(); 
                if ($pasusu2 != $pasusu) {
                header('Location:../registro.php?er=5');exit(); 
            } else {
                
            }
                
        }
    } else {

        header('Location:../registro.php?er=3');exit(); 
    }
} else {

    header('Location:../registro.php?er=2');exit(); 
}
