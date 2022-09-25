<?php
    if(!isset($_SESSION['autentificado'])){
        header("Location: ../../Index/Init_sesion.php");
        exit();
    }else if(isset($_SESSION['autentificado']) && $_SESSION['Roles']=="2"){
        echo "<script>"
        ."window.location = \"../../Functions_and_secure/non_autorized.php\"</script>";
    }
    include('../../Conexion/conexion.php');
    if(isset($_GET['id'])){
        $_id_usuario_l = htmlspecialchars(addslashes(trim($_GET['id'])));
        $consulta = "DELETE FROM usuarios WHERE id_usuario = $_id_usuario_l";
        $query = $conexion -> query($consulta);
        if($query){
            echo "<script>".
                "alert(\"Usuario eliminado!!\");"
                    ."location = \"../../Funcions_and_secure/salir.php\";</script>";
        }else{
            echo "<script>".
                "alert(\"El usuario no pudo ser eliminado, ".
                    "contacte con el daministrador para mas informacion!!\");"
                        ."location = \"../admin_index.php\";</script>";
        }
    }
    
?>