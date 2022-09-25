<?php
session_start();
if(!isset($_SESSION['autentificado'])){
    header("Location: ../../Index/Init_sesion.php");
    exit();
}else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="2"){
    echo "<script>"
    ."window.location = \"../../Functions_and_secure/non_autorized.php\"</script>";
}
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
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
            crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <title>Mis notas.com</title>
</head>
    <body>
        <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark"> 
                <div class="container-fluid m-auto">
                    <a class="navbar-brand" href="../../Index/index.html">Mis notas.com</a>
                </div>
                <div class="container-fluid m-auto">
                    <a class="navbar-brand" href="../admin_index.php">Revisar Cuentas</a>
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
        include('../../Conexion/conexion.php');
            $_user_id = $_SESSION['id_user'];
            $consulta = "SELECT * FROM notas WHERE Usuarios_id_usuario = $_user_id ORDER BY prioridad ASC;";
            $query = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
            if($query){
                if(mysqli_num_rows($query)<1){?>
                    <div class="container bg-light m-5 border rounded-top">
                        <div class="row justify-content-center">
                            <div class="caja m-5 w-100 bg-light">
                                <div class="col">
                                    <h1 class="h1 display-1" align="center">¡Sin notas!</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }else if(mysqli_num_rows($query)>0){?>
                    <div class="container-lg w-50  m-5 bg-light float-start">
                        <div class="row m-auto">
                            <div class="col-auto justify-content-center"><?php
                $notasE = array(array());
                $i = 0;
                while($notas = $query->fetch_assoc()){
                    $notasE['nombre'] = $notas['nombre_n'];
                    $notasE['fecha'] = $notas['fecha'];
                    $notasE['fecha_act'] = $notas['Fecha_act'];
                    $notasE['texto'] = $notas['texto'];
                    $notas_id = $notas['id_notas'];
                    $notasE['Prioridad'] = $notas['prioridad'];?>
                    <div class="container-fluid m-5">
                        <div class="card" style="width:230px">
                            <div class="card-header"><h5 class="card-title">Nombre: <?=$notasE['nombre']?></h5></div>
                                <div class="card-body">
                                    <img src="../../../Base_de_datos/images-icons/notas.png" width="150px" 
                                        class="img-fluid">
                                        <h5>Prioridad: <?=$notasE['Prioridad']?></h5>
                                    <a href="v_notes.php?id=<?=$notas_id?>" class="btn btn-lg btn-outline-dark card-link">
                                    <p class="card-text " align="center">Mirar Nota</p>
                                </a>
                            </div>
                        </div>
                    </div><?php
                    }
                }
            }?></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row ">
            <div class="caja m-5 pb-2 w-50">
                <div class="col justify-content-center">
                        <button class="btn btn-success btn-lg m-2" onclick="window.location = 'n_notes.php' ">Nueva nota</button>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>