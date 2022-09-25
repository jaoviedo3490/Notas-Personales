<?php
    include('../../Conexion/conexion.php');
    if(isset($_GET['id'])){
        $_id_notes_l = htmlspecialchars(addslashes(trim($_GET['id'])));
        $consulta = "DELETE FROM notas WHERE id_notas = $_id_notes_l";
        $id_notas = $_SESSION['id_notas_l'];
        $query = $conexion -> query($consulta);
        if($query){
            echo "<script>".
                "alert(\"Nota eliminada!!\");"
                    ."location = \"../admin_index.php\";</script>";
        }else{
            echo "<script>".
                "alert(\"La nota no pudo ser eliminada, contacte con el daministrador para mas informacion!!\");"
                    ."location = \"../admin_index.php\";</script>";
        }
    }
    
?>