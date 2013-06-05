<?
    include "funciones.php";
    $nick=strtoupper($_POST['usuario']);
	//echo $nick;
    if(comproDatosUser($nick)){
        echo "NO EXISTE";
    }
    else{
        echo "EXISTE";
    }
    
    function comproDatosUser($nick){
		nuevaConexionBd();
		$todoCorrecto=true;
		$consultaUser=mysql_query("SELECT NICK FROM USUARIOS");
		while($fila=mysql_fetch_array($consultaUser)){
			if(strtoupper($fila['NICK'])==$nick){
				$todoCorrecto=false;
			}
                        
		}
		return $todoCorrecto;
	}	
?>