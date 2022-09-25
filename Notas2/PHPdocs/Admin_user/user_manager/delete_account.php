<?php
session_start();
if(!isset($_SESSION['autentificado'])){
    header("Location: ../../Index/Init_sesion.php");
    exit();
}else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="2"){
    echo "<script>"
    ."window.location = \"../../Functions_and_secure/non_autorized.php\"</script>";
}
    include('../Conexion/conexion.php');
    $_id_deleted = $_SESSION['id_user'];
    $consulta = "DELETE FROM notas WHERE Usuarios_id_usuario = $_id_deleted ";
    $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
    $consulta = "DELETE FROM usuarios WHERE id_usuario = $_id_deleted ";
    $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
    if(!$query){
        $msg = false;
        header("Location: main_notes.php?$msg");
        exit();
    }else{
        session_destroy();
        header("Location: ../Index/index.html");
        exit();
    }
?>  

