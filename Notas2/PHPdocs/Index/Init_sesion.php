<?php
    session_start();
    $_SESSION['usuario'] = "";
    $_SESSION['contrasena'] = "";
    $_SESSION['user_db'] = "";
    $_SESSION['password_db'] = "";
    $_SESSION['Ruta'] = "";
    include('../Conexion/conexion.php');
    if(isset($_SESSION['autentificado'])){
        if($_SESSION['autentificado']=="1"){
        header("Location: ../Admin_user/admin_index.php");
        exit();
        }else if($_SESSION['autentificado']=="2"){
            echo "<script>"
            ."window.location=\"../Default_user/main_notes.php\"; </script>";
        }
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
                crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
                    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" 
                        crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
                    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" 
                        crossorigin="anonymous"></script>
                        <title>Mis notas.com</title>
    </head>
    <body>
    <script type="text/javascript">
            function valP(){
                var pass = document.getElementById('password');
                switch(pass.getAttribute('type')){
                    case "password":
                        pass.setAttribute('type','text');
                        break;
                    case "text":
                        pass.setAttribute('type','password');
                        break;
                    default:
                        window.alert("Error!!!!!");
                }
            }

        </script>
    <div>
    <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark"> 
                <div class="container-fluid m-auto">
                    <a class="navbar-brand" href="../Index/index.html">Mis notas.com</a>
                </div>
                <div class="container-fluid align-items-right">
                    <div class="row m-auto">
                        <div class="col m-auto">
                            <p class="text-white mb-0 ml- justify-content-end"></h5></p>
                        </div>
                    </div>
                </div>
                <div class="dropdown show">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                                aria-expanded="false" aria-label="Toggle navigation">Mas opciones</button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                            <a class="nav-link dropdown-toggle btn-lg" href="#" id="navbarDropdown" 
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Cuenta</a>
                            <!--<img src="foto-de-perfil" alt="perfil" width="30" height="24" class="d-inline-block align-text-top">-->
                                <ul class="dropdown-menu ml-5" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="../Admin_user/salir.php">Salir</a></li>
                                </ul>
                            </a>
                    </ul>
                </div>
        </nav>
        </div>
        <div class="container">
        <p>¿No tienes una cuenta? Presiona <a style="text-decoration:none" href="Create_user.php">Aqui</a></p>
            <form class="caja pb-2 w-25 bg-light" method="POST">
                <div class="row justify-content-center">
                    <div class="col-sm-auto col-md-offset-2">
                        <label class="form-label" for="nick_name">Usuario:</label>
                        <input class="form-control" type="text" name="usuario">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-auto col-md-offset-2">
                        <label class="form-label" for="Contrasena">Contraseña:</label>
                        <input class="form-control" type="password" id="password" name="Contrasena">
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row-auto">
                        <div class="col-auto">
                            <div class="form-check">
                                <input type="checkbox" onclick="valP()"  class="form-check-input" name="pass">
                                <label for="pass" class="form-check-label m-auto">Ver contraseña:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-auto p-2">
                        <input class="btn btn-primary"  value="Iniciar sesion" name="envio" type="submit">
                    </div>
                </div>
            </form>
        </div>
        </div>
    </body>
    <?php
        if(isset($_POST['envio'])){
            if(strlen($_POST['usuario'])>1 && strlen($_POST['Contrasena'])>1){
                $_nick_name = htmlspecialchars(addslashes(trim($_POST['usuario'])));
                $_password = htmlspecialchars(addslashes(trim($_POST['Contrasena'])));
                $consulta = "SELECT * FROM usuarios WHERE nombres=\"$_nick_name\"";
                $query = $conexion->query($consulta);
                //print_r(mysqli_error($conexion));
                //echo $consulta;
                if($query){
                    while($datos = $query->fetch_assoc()){
                        //print_r($datos);
                       $datosE['usuario'] = $datos['usuario'];
                       $datosE['Contrasena'] = trim($datos['Contrasena']);
                       $datosE['Nombre'] = $datos['Nombres'];
                       $datosE['Rol'] = $datos['Roles_id_roles'];
                       $datosE['id_user'] = $datos['id_usuario'];
                       $datosE['Ruta'] = $datos['Ruta'];
                    }
                    $crypt_pass = $_password;
                    //print_r("AQUI: ".password_verify($datosE['Contrasena'],$crypt_pass)." || ".$datosE['Nombre'] ."".);
                    //print_r($crypt_pass ." |||||| ".$datosE['Contrasena']);
                    //print_r($_nick_name);
                    switch (@$datosE['Rol']) {
                        case 1:
                            if($crypt_pass==$datosE['Contrasena']){
                                    $_SESSION['user_db'] = $datosE['usuario'];
                                    $_SESSION['password_db'] = $datosE['Contrasena'];
                                    $_SESSION['name_user'] = $datosE['Nombre'];
                                    $_SESSION['Roles'] = $datosE['Rol'];
                                    $_SESSION['id_user'] = $datosE['id_user'];
                                    $ruta = $datosE['Ruta'];
                                    $_SESSION['user'] = $_nick_name;
                                    $_SESSION['user_pass'] = $crypt_pass;
                                    $_SESSION['Ruta'] = $ruta;
                                 
                                    $_SESSION['autentificado'] = "1";
                                   echo "<script>"."
                                        window.location=\"../Admin_user/admin_index.php\"; </script>";
                                }else
                                    echo "<script>".
                                    "alert(\"Usuario o contraseña incorrectos\")</script>";
                            break;
                        case 2:
                            //print_r($crypt_pass ." == ".$datosE['Contrasena']);
                            if($datosE['Contrasena']==$crypt_pass){
                                    $_SESSION['user_db'] = $datosE['usuario'];
                                    $_SESSION['password_db'] = $datosE['Contrasena'];
                                    $_SESSION['name_user'] = $datosE['Nombre'];
                                    $_SESSION['Roles'] = $datosE['Rol'];
                                    $_SESSION['id_user'] = $datosE['id_user'];

                                    $_SESSION['user'] = $_nick_name;
                                    $_SESSION['user_pass'] = $crypt_pass;
                                    $_SESSION['autentificado'] = "2";
                                    echo "<script>"."
                                        window.location=\"../Default_user/main_notes.php\"; </script>";
                                }else
                                    echo "<script>".
                                    "alert(\"Usuario o contraseña incorrectos\")</script>";
                            break;
                        default:
                            echo "<script>".
                                "alert(\"Usuario no encontrado, asegurese de tener una cuenta en este sitio\")</script>";
                            break;
                    }
                    
                    }else{
                        echo "Error al ingresar la informacion a la base de datos";
                    }
                }else
                    echo "<script>".
                    "alert(\"Los datos no pueden estar vacios\")</script>";
            }
    ?>
</html>
