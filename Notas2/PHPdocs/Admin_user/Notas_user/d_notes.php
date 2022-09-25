<?php
session_start();
include('../../Conexion/conexion.php');
if(!isset($_SESSION['autentificado'])){
    header("Location: ../../Index/Init_sesion.php");
    exit();
}else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="2"){
    echo "<script>"
    ."window.location = \"../../Functions_and_secure/non_autorized.php\"</script>";
}
    if(!$_GET){
        header("Location: main_notes.php");
        exit();
    }else{
        $msg = "";
        $_id_nd = $_GET['id'];
        $consulta = "DELETE FROM notas WHERE id_notas = '$_id_nd'";
        $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
        if(!$query){
            echo "<script>".
                "alert(\"No se ha podido completar la accion, contacte con el administrador del sitio para mas informacion\")</script>";
            header("Location: main_notes.php");
            exit();
        }else{
            echo "<script>".
                "alert(\"Nota borrada con exito\");</script>";
            header("Location: main_notes.php");
            exit();
        }
    }

?>  
<!--<!DOCTYPE html>
<html>
<head>
        <title>Mis_notas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
                crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
                    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" 
                        crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
                    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" 
                        crossorigin="anonymous"></script>
    </head>
    <body>

    </body>
</html>-->