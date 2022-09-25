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
    }else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="2"){
        echo "<script>"
        ."window.location = \"../Functions_and_secure/non_autorized.php\"</script>";
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
    <div>
          <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark"> 
            <div class="container-fluid m-auto">
                <a class="navbar-brand" href="../Index/index.html">Mis notas.com</a>
            </div>
            <div class="container justify-content-left" >
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link mb-0" href="Notas_user/main_notes.php">Mirar mis notas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-0" href="Notas_user/n_notes.php">Nueva nota</a>
                  </li>
                  <li class="nav-item dropdown">
                  </li>
                  <li class="nav-item">
                  </li>
                </ul>
              </div>
            </div>
            <div class="dropdown show">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                            aria-expanded="false" aria-label="Toggle navigation">Mas opciones</button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                        <a class="nav-link dropdown-toggle btn-lg" id="navbarDropdown" 
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">Cuenta</a>
                        <!--<img src="foto-de-perfil" alt="perfil" width="30" height="24" class="d-inline-block align-text-top">-->
                            <ul class="dropdown-menu ml-5" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="user_manager/user_edit_info.php">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="../Functions_and_secure/salir.php">Salir</a></li>
                            </ul>
                        </a>
                </ul>
            </div>
    </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Bienvenido: <?=$_SESSION['name_user']?></h2>
                </div>
            </div>
        </div>
        <?php 
            $consulta = "SELECT * FROM usuarios WHERE Roles_id_roles = 2";
            $query = $conexion->query($consulta);
            if($query){
                if(mysqli_num_rows($query)>0){
        ?>
        <div class="container-fluid">
            <div class="row-auto">
                <div class="col-auto">
                    <table class="table">
                    <tr>
                            <th>Id</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Mirar las notas</th>
                        </tr><?php
                $consulta = "SELECT * FROM usuarios WHERE Roles_id_roles = 2";
                $query =  $conexion->query($consulta);
                $num_res = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
                    if($query){    
                        while($datos = $query->fetch_assoc()){
                        $datosE['usuario'] = $datos['usuario'];
                        $datosE['Contrasena'] = $datos['Contrasena'];
                        $datosE['Nombre'] = $datos['Nombres'];
                        $datosE['Rol'] = $datos['Roles_id_roles'];
                        $datosE['id_user'] = $datos['id_usuario'];
                        ?><tr>
                        <td><?=$datosE['id_user']?></td>
                            <td><?=$datosE['usuario']?></td>
                            <td><?=$datosE['Nombre']?></td>
                            <td>
                                <a href="Actions_admin/visual_users_notes.php?id=<?=$datosE['id_user']?>&name=<?=$datosE['Nombre']?>">
                                <img src="../../Base_de_datos/images-icons/mirar.png" width="25" alt="edit_note"></a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                    }
                }else{?>
                    <div class="container bg-light m-5 border rounded-top">
                        <div class="row justify-content-center">
                            <div class="caja m-5 w-75 bg-light">
                                <div class="col">
                                    <h1 class="h1 display-1" align="center">¡Sin usuarios registrados!</h1>
                                </div>
                            </div>
                        </div>
                    </div><?php
                }
                    ?>
            </div>
        </div>
    </body>
</html>