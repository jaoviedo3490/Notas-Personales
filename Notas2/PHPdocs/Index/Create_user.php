<?php
session_start();
    require('../Conexion/conexion.php');
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
        <nav class="navbar navbar-expand-md navbar-dark bg-dark"> 
            <div class="container-fluid">
                <a class="navbar-brand" href="../Index/index.html">Mis notas.com</a>
            </div>
        </nav>
        <script src="funciones.js"></script>
        <p>Inicia sesion <a style="text-decoration:none" href="Init_sesion.php">Aqui</a></p>
        <div class="container">
            <form method="POST" class="caja pb-2 w-25 bg-light">
                <div class="row justify-content-center">
                    <div class="col-sm-auto col-md-offset-2">
                        <label class="form-label" for="Nombre">Nombre:</label>
                        <input class="form-control" type="text" name="Nombre">
                    </div>
                    
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-auto col-md-offset-2">
                        <label class="form-label" for="nick_name">Usuario:</label>
                        <input class="form-control" type="text" name="name_user">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-auto col-md-offset-2">
                        <label class="form-label" for="password">Contraseña:</label>
                        <input class="form-control" id="password" type="password" name="password">
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
                    <div class="col-sm-auto col-md-offset-2">
                        <label class="form-label" for="pass_conf">Confirmar:</label>
                        <input class="form-control" type="password" name="pass_conf">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-auto p-2">
                        <input class="btn btn-primary" name="enviar" type="submit">
                    </div>
                </div>
            </form>
        </div>
       <?php
       require('../Functions_and_secure/funciones.php');
    if(isset($_POST['enviar'])){     
        if(strlen($_POST['Nombre'])>=1 && strlen($_POST['name_user'])>=1
                && strlen($_POST['password'])>=1 && strlen($_POST['pass_conf'])>=1){                   
                    $nombre = $_POST['Nombre'];
                    $user_nick = $_POST['name_user'];
                    $contraseña = $_POST['password'];
                    $passTest = $_POST['pass_conf'];
                    $validarP = valPass($contraseña);
                    if($validarP=="contraseña_segura"){                     
                        if($contraseña == $_POST['pass_conf']){                     
                            if(!Validar('usuario',$user_nick,$conexion)){ 
                                    $_crypt_pass = md5($contraseña);                        
                                    $consulta = "INSERT INTO usuarios(Nombres,Contrasena,usuario,Roles_id_roles,Ruta)"
                                    ." VALUES('$nombre','$_crypt_pass','$user_nick','2','user_default.png')";
                                    $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
                                    if($query){
                                        unset($_POST['Nombre']);
                                        unset($_POST['name_user']);
                                        unset($_POST['password']);
                                        unset($_POST['pass_conf']);
                                        unset($_POST['t_user']);
                                        echo "<script>window.location = \"Init_sesion.php\"</script>";
                                    }else{
                                        echo "<script>".
                                        "alert(\"Error al registrar los datos, comuniquese con el administrador\")</script>";
                                    }
                                }else{
                                echo "<script>".
                                "alert(\"Nombre de usuario ya esta registrado!\")</script>";
                                }
                            }else{
                            echo "<script>".
                            "alert(\"Las contraseñas no coinciden!\")</script>";
                            }
                            
                        }else if($validarP=="tipo_nulo"){
                            echo "<script>".
                                    "alert(\"La contraseña ingresada, debe contener numeros y letras\")</script>";
                                    
                    }else if($validarP=="conteo_de_digitos_bajo"){
                        echo "<script>".
                        "alert(\"La contraseña debe tener 3 numeros, 3 letras minusculas y 3 letras mayusculas\")</script>";
                    }else{
                        echo "Error desconocido";
                    }
                }else{
                    echo "<script>".
                    "alert(\"Los datos no pueden estar vacios\")</script>";
                }
            }
    ?>
    </body>
</html>
