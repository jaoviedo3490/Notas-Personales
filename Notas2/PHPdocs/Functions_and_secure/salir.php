<?php
session_start();
    if(!isset($_SESSION['autentificado'])){//redirigimos si alguien intenta acceder a esta pagina al login
        header("Location: ../Index/Init_sesion.php");
        exit();
    }else{
        session_destroy();
        header("Location: ../Index/index.html");
        exit();
    }