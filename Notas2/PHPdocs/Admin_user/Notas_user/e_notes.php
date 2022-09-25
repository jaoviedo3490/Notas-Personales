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
    if(isset($_GET['id']))
        $id = htmlspecialchars(addslashes(trim($_GET['id'])));
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
    <div>
    <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark"> 
                <div class="container-fluid m-auto">
                    <a class="navbar-brand" href="../../Index/index.html">Mis notas.com</a>
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
                                    <li><a class="dropdown-item" href="../user_manager/user_edit_info.php">Mi perfil</a></li>
                                    <li><a class="dropdown-item" href="../../Functions_and_secure/salir.php">Salir</a></li>
                                </ul>
                            </a>
                    </ul>
                </div>
        </nav>
        </div>
    <div class="container m-5">
    <form method="POST" class="caja pb-2 w-25 bg-light">
            <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-auto col-md-offset-2">
                            <label class="form-label m-auto pt-4" for="Nombre">Nombre de la Nota:</label>
                            <input type="text" class="form-control" value="<?=$_REQUEST['name']?>"name="nombre_nota">
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-auto col-md-offset-2">
                            <label class="form-label m-auto" for="Nombre">Nueva Nota:</label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" name="Nota" 
                                value="<?=$_REQUEST['text']?>" col="10" row="15"></textarea>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row-auto">
                        <div class="col-auto">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="priority" value="<?=$_REQUEST['priority']?>">
                                <label for="priority" class="form-check-label m-auto">Prioritaria:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-auto p-2">
                        <input class="btn btn-primary" name="enviar" value="Actualizar Nota" type="submit">
                    </div>
                </div>
            </form>
            <div class="container-fluid m-3">
                <div class="row-auto">
                    <div class="col-auto">
                        <a href="main_notes.php" role="button" class="btn btn-warning">Atras</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
      require_once('../../Functions_and_secure/funciones.php');
      if(isset($_POST['enviar'])){
          date_default_timezone_set('America/Bogota');
          $fecha_act = date("Y/m/d h:i:s");
          if(strlen($_POST['Nota'])>0 && strlen($_POST['Nota'])<200 && strlen($_POST['nombre_nota'])>0){
                $_user_id = $_SESSION['id_user'];
                $_notas = htmlspecialchars(addslashes(trim($_POST['Nota'])));
                $_nombre_n = htmlspecialchars(addslashes(trim($_POST['nombre_nota'])));
                if(isset($_POST['priority'])){
                  $_prioridad = 1;
                  $consulta = "UPDATE  notas SET texto = '$_notas', nombre_n = '$_nombre_n' , Fecha_act = '$fecha_act'";
                  $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
                  if(!$query){
                      echo "<script>"
                        ."alert(\"Error al Ingresar los datos, comuniquese con el administrador del sitio para mas informacion\")</script>";
                  }else{ 
                  ?><div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-success" role="alert">Nota actualizada</div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }else if(!isset($_POST['priority'])){
              $_prioridad = 2;
              $consulta = "UPDATE notas SET texto= '$_notas', prioridad = '$_prioridad',Fecha_act = '$fecha_act' WHERE id_notas = '$id' ";
              $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
              if(!$query){
                  echo "<script>"
                    ."alert(\"Error al ingresar los datos: Comuniquese con el administrador del sitio: ERROR TIPO 1\");</script>";
              }else{ 
              ?><div class="container-fluid w-100">
                    <div class="row-auto">
                        <div class="col-auto">
                            <div class="alert alert-success" role="alert">Nota creada</div>
    
                        </div>
                    </div>
                </div>
            <?php
            }
          }
        }else if(strlen($_POST['Nota'])<1 || strlen($_POST['nombre_nota']==0) || !isset($_POST['priority'])){
            $consulta = "SELECT * FROM notas WHERE id_notas = $id";
            $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
            if(!$query){
                echo "<script>"
                  ."alert(\"Error al ingresar los datos: Comuniquese con el administrador del sitio: ERROR TIPO 1\");</script>";
            }else{
                while($notas = $query->fetch_assoc()){
                    $nombre = $notas['nombre_n'];
                    $fecha = $notas['fecha'];
                    $fecha_Act = $notas['Fecha_act'];
                    $texto = $notas['texto'];
                    $notas_id = $notas['id_notas'];
                    $prioridad = $notas['prioridad'];
                }
                    $consulta = "UPDATE notas SET nombre_n = '$nombre' , texto = '$texto', fecha = '$fecha' ".
                        ", Fecha_act = '$fecha_Act' , prioridad = '$prioridad' ";
                    $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
                    if(!$query){
                      echo "<script>"
                        ."alert(\"Error al Ingresar los datos, comuniquese con el administrador del sitio para mas informacion\")</script>";
                    }else{ 
                        ?><div class="container w-100">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-info" role="alert">Datos ingresados nulos, la nota coservara sus antiguos datos</div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
            }
        }
    ?>
    </body>
</html>
