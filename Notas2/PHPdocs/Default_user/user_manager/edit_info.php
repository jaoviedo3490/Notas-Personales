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

    $id = $_SESSION['id_user'];
    global $id_edit_user;
?>
<!DOCTYPE html>
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
                    <a class="navbar-brand" href="../../Index/index.html">Mis notas.com</a>
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
                                    <li><a class="dropdown-item" href="../../Functions_and_secure/salir.php">Salir</a></li>
                                </ul>
                            </a>
                    </ul>
                </div>
        </nav>
        </div>
    <div class="container m-5">
    <form method="POST" class="caja pb-2 w-50 bg-light">
            <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-auto col-md-offset-2">
                            <label class="form-label m-auto pt-4" for="Nombre">Nombre:</label>
                            <input type="text" class="form-control" value="<?=$_REQUEST['nombre']?>"name="nombre_user">
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-auto col-md-offset-2">
                            <label class="form-label m-auto pt-4" for="Nombre">Usuario:</label>
                            <input type="text" class="form-control" value="<?=$_REQUEST['user']?>"name="nombre_user2">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                        <div class="col-sm-auto col-md-offset-2">
                            <label class="form-label m-auto pt-4" for="Nombre">Contraseña:</label>
                            <input type="password" id="password" class="form-control" name="pass">
                        </div>
                    </div>
                <div class="container-fluid">
                    <div class="row-auto">
                        <div class="col-auto">
                            <div class="form-check">
                                <input type="checkbox" onclick="valP()"  class="form-check-input">
                                <label for="pass" class="form-check-label m-auto">Ver contraseña:</label>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-auto col-md-offset-2">
                            <label class="form-label m-auto pt-4" for="Nombre">Confirmar:</label>
                            <input type="password" class="form-control" name="pass_conf">
                        </div>
                    </div>
                <div class="row justify-content-center">
                    <div class="col-sm-auto p-2">
                        <input class="btn btn-primary" name="actualizar" value="Actualizar Perfil" type="submit">
                    </div>
                </div>
            </form>
            <div class="container-fluid m-3">
                <div class="row-auto">
                    <div class="col-auto">
                        <a href="user_edit_info.php" role="button" class="btn btn-warning">Atras</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
      require_once('../../Functions_and_secure/funciones.php');
      if(isset($_POST['actualizar'])){     
        if(strlen($_POST['nombre_user'])>=1 && strlen($_POST['nombre_user2'])>=1
                && strlen($_POST['pass'])>=1 && strlen($_POST['pass_conf'])>=1){                   
                    $nombre = htmlspecialchars(addslashes(trim($_POST['nombre_user'])));
                    $user_nick = htmlspecialchars(addslashes($_POST['nombre_user2']));
                    $contraseña = htmlspecialchars(addslashes($_POST['pass']));
                    $passTest = htmlspecialchars(addslashes($_POST['pass_conf']));
                    $validarP = valPass($contraseña);
                    if(!Validar('usuarios','usuario',$user_nick,$conexion) 
                        && $validarP == "contraseña_segura"){
                            $contrasena = md5($contrasena);
                            $consulta = "SELECT id_usuario FROM usuarios  WHERE usuario = $user_nick";
                            $query = $conexion->query($consulta);
                            if($query){
                                    while($dato=$query->fetch_assoc()){
                                    $GLOBALS['id_edit_user'] = $dato['id_usuario'];
                                    }
                                    if($id_edit_user==$id){
                                        $crypt_pass = md5($contrasena);
                                        $update = "UPDATE usuarios SET usuario = $user_nick , Nombres = $nombre , Contrasena = ".md5($contrasena)."";
                                        $query = $conexion->query($consulta);
                                        if($query){
                                            echo "<script>".
                                                "alert(\"Perfil actualizado correctamente!\")"
                                                    ."location = \"user_edit_info.php\"</script>";
                                        }else{
                                            echo "<script>".
                                                "alert(\"Error al acualizar su perfil, contacte con el administrador del sitio para mas informacion!\")"
                                                    ."location = \"user_edit_info.php\"</script>";
                                        }
                                    }else{
                                echo "<script>".
                                    "alert(\"El usuario ya se encuentra registrado!\")</script>";
                            }
                        }else{
                            echo "<script>".
                                    "alert(\"Error al acceder a la base de datos, contacte con el administrador para mas informacion!\")"
                                            ."location = \"user_edit_info.php\"</script>";
                        }
                    }
            }else{
                echo "<script>".
                                "alert(\"Los datos no pueden estar vacios!\")"
                                            ."location = \"user_edit_info.php\"</script>";
            }
        }
            ?>