<?php
session_start();
include('../../Conexion/conexion.php');
if(!isset($_SESSION['autentificado'])){
    header("Location: ../../Index/Init_sesion.php");
    exit();
}else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="1"){
    echo "<script>"
    ."window.location = \"../../Functions_and_secure/non_autorized.php\"</script>";
}
    if(!$_GET){
        header("Location: ../main_notes.php");
        exit();
    }else{
        $msg = "";
        $_id_nd = $_GET['id'];
        $consulta = "DELETE FROM notas WHERE id_notas = '$_id_nd'";
        $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
        if(!$query){
            $msg = false;
            header("Location: ../main_notes.php?$msg");
            exit();
        }else{
            $msg = true;
            header("Location: ../main_notes.php?$msg");
            exit();
        }
    }

?>  