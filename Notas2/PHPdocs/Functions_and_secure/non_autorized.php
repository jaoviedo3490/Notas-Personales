<?php
    session_start();
    include('../Functions_and_secure/funciones.php');
    $_SESSION['usuario'] = "";
    $_SESSION['contrasena'] = "";
    $_SESSION['user_db'] = "";
    $_SESSION['password_db'] = "";
    include('../Conexion/conexion.php');
    if(!isset($_SESSION['autentificado'])){
        header("Location: ../Index/Init_sesion.php");
        exit();
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
            <title>Mis notas.com</title>
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
        <div class="container-fluid m-5">
            <div class="row-auto">
                <div class="col-auto">
                    <h1 class="h1 display-1">Acceso no autorizado</div>
                    <h2 class="h2 display 2">No posee los permisos para acceder al recurso solicitado</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid m-5">
            <div class="row-auto">
                <div class="col-auto">
                    <a href="../Index/index.html" class="display-5" style="text-decoration: none">Inicio</a>
                </div>
            </div>
        </div>
    </body>
</html>