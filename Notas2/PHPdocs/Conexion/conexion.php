<?php
    /*$conexiones = array(
        "Servidor"=>"localhost",
        "Usuario"=>"root",
        "Contraseña"=>"",
        "Base de datos"=>"notas"
    );*/

    $conexion = new MySQli("localhost","root","","notas");

        if(!$conexion)
            echo "ERROR: No se ha podido conectar a la base de datos";