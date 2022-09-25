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
    $id = htmlspecialchars(addslashes(trim($_GET['id'])));
    
   
    

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
        <?php
            include('../../Functions_and_secure/funciones.php');
            $n_id = obtenerColumnas('id_notas','notas',$conexion,$id,'id_notas');
            if($id>$n_id||$id<1){?>
                <div class="container ">
                    <div class="row justify-content-center">
                        <div class="caja m-5 pb-2 w-75 bg-light">
                            <div class="col justify-align-center">
                                <h1 class="h1 display-1" align="center">¡Sin notas!</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                <div class="row">
                    <div class="col">
                        <p><a style="text-decoration: none;" href="main_notes.php">Mis notas</a></p>
                    </div>
                </div>
            </div>
            <?php
            }else{
            $notasE = array(array());
            $consulta = "SELECT * FROM notas WHERE id_notas = '$id'";
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
                $notasE['texto'] = $notas['texto'];
                $notasE['fecha'] = $notas['fecha'];
                $notasE['prioridad'] = $notas['prioridad'];
                $notasE['Fecha_act'] = $notas['Fecha_act'];
                $notasE['nombre_n'] = $notas['nombre_n'];
            }
        ?>
        <div class="container-fuid m-5">
            <div class="row-auto">
                <div class="col-auto">
                    <legend>
                        <table class="table table-dark table-striped m-auto">
                            <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Fecha de creacion</th>
                                <th>Ultima Actualizacion</th>
                                <th><a href="e_notes.php?id=<?=$id?>&name=<?=$notasE['nombre_n']?>&text=<?=$notasE['texto']?>&priority=<?=$notasE['prioridad']?>" role="button">
                                    <img src="../../../Base_de_datos/images-icons/edit.png" width="50" 
                                        alt="edit_note">
                                </th>
                                <th><a href="d_notes.php?id=<?=$id?>" role="button" onclick="return confirm('¿Está seguro de eliminar el registro?')">
                                    <img src="../../../Base_de_datos/images-icons/deleted.png" 
                                    width="50" alt="edit_note"/></a></th>
                            </tr>
        </thead>
                                <tr>
                                    <td><?=$_SESSION['user']?></td>
                                    <td><?=$notasE['nombre_n']?></td>
                                    <td><?=$notasE['fecha']?></td>
                                    <td colspan="3"><?=$notasE['Fecha_act']?></td>
                                </tr>
                                <td colspan="6" align="center"><?=$notasE['texto']?></td>
                            </table>
                        </legend>
                    </div>
                </div>
            </div>
            <div class="container-fluid m-auto">
                <div class="row-auto">
                    <div class="col-auto">
                        <a style="text-decoration: none;" role="button" class="btn btn-info" href="main_notes.php">Mis notas</a>
                    </div>
                </div>
            </div>
            
        </body>
    </html>
    <?php
        }
    ?>
