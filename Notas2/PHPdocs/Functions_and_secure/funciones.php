<?php
    @include('../Conexion/conexion.php');
    //Esta funcion borra los datos
    function resetValues($value){
        $len = count($value);
        for($i=0;$i<$len;$i++){
            unset($value[$len]);
        }
    }
    //valido contraseñas
    function valPass($param){
        global $cNumeros;
        global $cLetrasMinus;
        global $cLetrasMayus;
        if(ctype_alnum($param)){
            for($i=0;$i<strlen($param);$i++){
                $aux = substr($param,$i,1);
                if(is_numeric($aux))
                    $GLOBALS['cNumeros'] +=1;
                else if(ctype_lower($aux))
                    $GLOBALS['cLetrasMinus'] += 1; 
                else if(ctype_upper($aux))
                    $GLOBALS['cLetrasMayus'] += 1;
                else 
                    return "tipo_nulo"; 
            }if($cNumeros<3 || $cLetrasMayus<2 || $cLetrasMayus<2) 
                return "conteo_de_digitos_bajo";
            else if($cNumeros>=3 && $cLetrasMayus>=2 && $cLetrasMayus>=2) 
                return "contraseña_segura";
            else
                return "error_desconocido";                             

        }else if(!ctype_alnum($param)) 
            return "non_alnum";
    }
    function valNom($param){
        if(is_string($param)){
            $aux = strlen($param);
            if($aux>0&& $aux<25)
                return true;
            else if($aux<1)
                return false;
        }
    }
    //aqui valido que al crear una cuenta con un correo , ya no se pueda crear otra con el mismo
function Validar($param,$param2,$param3){
    $var = "por defecto";
    $sqlC = "SELECT * FROM usuarios WHERE $param = \"$param2\" ;";
    $Ingreso = mysqli_query($param3,$sqlC) or die (mysqli_error($param3));
        if($Ingreso){
            while($emails= mysqli_fetch_assoc($Ingreso))
                $datosE = $emails['usuario'];
            if(isset($datosE)){
                if($datosE==$param2)
                    $var= true;
        }else
            $var = "aqui1";
    }else{
        $var = "aqui2";
    }return "$var";
}

function obtenerColumnas($param,$param2,$param3,$param4,$param5){
    $consulta = "SELECT $param FROM $param2";
    $query = mysqli_query($param3, $consulta) or die (mysqli_error($param3));
    while($dato=$query->fetch_assoc()){
        $aux = $dato[$param5];
        if($param4==$aux){
            return $param4;
            break;
        }
    }
}
function Num_cols($param,$param2,$param3){
    $consulta = "SELECT COUNT($param) FROM $param2";
    return $query = $param3->query($consulta);
}





