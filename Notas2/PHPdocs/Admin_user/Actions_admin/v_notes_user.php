<?php
session_start();
if(!isset($_SESSION['autentificado'])){
    header("Location: ../../Index/Init_sesion.php");
    exit();
}else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="2"){
    echo "<script>"
    ."window.location = \"../../Functions_and_secure/non_autorized.php\"</script>";
}
    include_once('../../Conexion/conexion.php');
    $id_notas = htmlspecialchars(addslashes(trim($_GET['user'])));
    global $texto_n;
    global $fecha_n;
    global $fecha_act_n;
    global $nombre_n;
    global $prioridad_n;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis notas.com</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
            crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
            crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <title>Mis notas.com</title>
</head>
    <body class="fondo">
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
        <div class="container-fluid m-5">
                <div class="row-auto">
                    <div class="col-auto">
                        <a style="text-decoration: none;" role="button" class="btn btn-info" href="visual_users_notes.php?id=<?=$_SESSION['id_user_l']?>&name=<?=$_SESSION['user_l']?>">Mis notas</a>
                    </div>
                </div>
            </div>
        <?php
            $notasE;
            $consulta = "SELECT * FROM notas WHERE id_notas = $id_notas ";
            $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
            if(!$query){?>
                <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-sucess" role="alert">La nota no pudo ser accedida</div>
                                <a href="main_notes.php" style="text-decoration: none">Regresar a mis notas</a>
                            </div>
                        </div>
                    </div>
                <?php
            }while($notas=$query->fetch_assoc()){
               $GLOBLAS['texto_n'] = $notas['texto'];
               $GLOBALS['fecha_n'] = $notas['fecha'];
               $GLOBALS['prioridad_n'] = $notas['prioridad'];
               $GLOBALS['fecha_act_n'] = $notas['Fecha_act'];
               $GLOBALS['nombre_n'] = $notas['nombre_n'];
               $notasE = $notas['texto'];
            }
        ?>
        <div class="container-fuid m-5">
            <div class="row-auto">
                <div class="col-auto">
                    <legend>
                        <table class="table table-dark table-striped m-auto">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Prioridad</th>
                                <th>Fecha de creacion</th>
                                <th>Ultima Actualizacion</th>
                            </tr>
        </thead>
                                <tr>
                                    <td><?=$id_notas?></td>
                                    <td><?=$nombre_n?></td>
                                    <th><?=$prioridad_n?></th>
                                    <td><?=$fecha_n?></td>
                                    <td colspan="3"><?=$fecha_act_n?></td>
                                </tr>
                                <td colspan="6" align="center"><?=$notasE?></td>
                            </table>
                        </legend>
                    </div>
                </div>
            </div>
        </body>
    </html>