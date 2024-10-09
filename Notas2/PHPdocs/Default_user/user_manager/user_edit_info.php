<?php
session_start();
if(!isset($_SESSION['autentificado'])){
    header("Location: ../../Index/Init_sesion.php");
    exit();
}else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="1"){
    echo "<script>"
    ."window.location = \"../../Functions_and_secure/non_autorized.php\"</script>";
}
    include('../../Conexion/conexion.php');
    global $rol;
    global $acciones;
    global $objetivos;
    global $_ruta;

    print_r($_SESSION["user_db"]);

    $id = $_SESSION['id_user'];
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
    <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark"> 
                <div class="container-fluid m-auto">
                    <a class="navbar-brand" href="../../Index/index.html">Mis notas.com</a>
                </div>
                <div class="container-fluid m-auto">
                    <a class="navbar-brand" href="../main_notes.php">Mirar mis Notas</a>
                </div>
                <div class="container-fluid align-items-right">
                    <div class="row m-auto">
                        <div class="col m-auto">
                            <p class="text-white mb-0 ml- justify-content-end"><?=$_SESSION['name_user'];?></h5></p>
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
    <body><?php
        $_rol = $_SESSION['Roles'];
        $consulta = "SELECT Nombre  FROM roles WHERE id_roles =  $_rol ";
        $query = $conexion->query($consulta);
        while($datosE=$query->fetch_assoc()){
            $GLOBALS['rol'] = $datosE['Nombre'];
        }
        $consulta = "SELECT * FROM acciones WHERE id_acciones = $_rol ";
        $query = $conexion->query($consulta);
        if($query){
            while($datosE2=$query->fetch_assoc()){
                $GLOBALS['acciones'] = $datosE2['url'];
                $GLOBALS['objetivos'] = $datosE2['nombre'];
            }
        }else
            echo "Error desconocido";
            $consulta = "SELECT Ruta FROM usuarios WHERE id_usuario = $id ";
            $query = $conexion->query($consulta);
            if($query){
                while($datosE3=$query->fetch_assoc()){
                    $GLOBALS['_ruta'] = $datosE3['Ruta'];
                }
            }else
                echo "Error desconocido";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2 class="h4 display-4 m-4">Mi Perfil</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid m-2">
                <div class="row-auto">
                        <div class="col-auto">
                                <a href="delete_account.php" class="btn btn-danger" style="text-decoration:none" role="button" 
                                        onclick="return confirm('¿Esta seguro que desea elimina su cuenta?'+
                                            ' , Tenga en cuenta que una vez eliminada NO podra recuperar sus datos y debera crear una nueva cuenta')">Eliminar Cuenta</a>
                                    </div>
                            </div>
                        </div>
    <div class="container bg-light m-5 border rounded-top">
                        <div class="row justify-content-center">
                            <div class="caja m-5 pb-2 w-75 bg-light">
                                <div class="col justify-align-center">
                                <img class='rounded mx-auto d-block float-start'src=<?="../../../Base_de_datos/images-icons/Usuarios/".$_ruta.""?> alt='user_log' width='200'/>  
                                    <table class=" m-2 table table-responsive w-75 float-end">
                                       <tr>
                                           <th>Nombre:</th>
                                           <td><?=$_SESSION['name_user'];?></td>
                                       </tr>
                                       <tr>
                                           <th>Usuario:</th>
                                           <td><?=$_SESSION['user_db']?></td>
                                       </tr>
                                        <tr>
                                           <th>Nivel de Accesso:</th>
                                           <td><?=$rol;?></td>
                                       </tr>
                                       <tr>
                                           <th>Acciones:</th>
                                           <td><?=$objetivos?></td>
                                        </tr>
                                        <tr>
                                            <th>Acciones-objetos:</th>
                                            <td><?=$acciones?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid m-2">
                            <div class="row-auto">
                                <div class="col-auto m-4">
                                        <a style="text-decoration: none;" class="btn btn-info" role="button"  href="edit_info.php?nombre=<?=$_SESSION['name_user']?>&user=<?=$_SESSION['user_db']?>">Editar Perfil</a>
                                </div>
                            </div>
                        </div>
            <div class="container bg-light m-5 border rounded-top">
                <div class="justify-content-center">
                    <div class="caja m-5 pb-2 w-75 bg-light">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="col">
                                <label for="formFile" class="form-label">Sube tu foto de perfil</label>
                                <input class="form-control" type="file" id="formFile" name="foto" accept = 'image/*'>
                            </div>
                            <input type="submit" class="btn btn-dark m-2 is-valid" value="subir foto" name="InputF">
                            <div class="invalid-feedback">El archivo debe ser una imagen</div>
                        </form>
                        <?php
                            if(!empty($_FILES['foto']['name'])){
                                $foto = $_FILES['foto']['name'];
                                $foto = str_replace(" ","_",$foto);
                                $ruta = "../../../Base_de_datos/images-icons/usuarios/".$foto;
                                if(move_uploaded_file($_FILES['foto']['tmp_name'],$ruta)){
                                    $id_user = $_SESSION['id_user'];
                                    $consulta = "UPDATE  usuarios SET Ruta = '$foto' WHERE id_usuario = $id_user";
                                    $query = $conexion->query($consulta);
                                    if(!$query){
                                        echo "<script>".
                                        "alert(\"Error al registrar la imagen el el servidor\")</script>";
                                            echo mysqli_error($conexion);
                                    }else{
                                        echo "<p>Imagen subida correctamente recargue la pagina para actualizar su foto<p>";
                                        $GLOBALS['_ruta'] = $foto; 
                                    }

                                }else
                                    echo "<script>".
                                        "alert(\"No se pudo mover la ruta temporal de la imagen\")</script>";
                            }
                            ?>
                    </div>
                </div>
            </div>
    </body>
</html>
