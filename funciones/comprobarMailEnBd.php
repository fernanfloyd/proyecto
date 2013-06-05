<?
    include "funciones.php";
    $email=trim(strtoupper($_POST['email']));
	//echo $email;
    if(comproDatosUser($email)){
        echo "NO EXISTE";
    }
    else{
        echo "EXISTE";
    }
    
    function comproDatosUser($email){
		nuevaConexionBd();
		$todoCorrecto=true;
		$consultaUser=mysql_query("SELECT email FROM DATOS");
		while($fila=mysql_fetch_array($consultaUser)){
			if(strtoupper($fila['email'])==$email){
				$todoCorrecto=false;
			}
                        
		}
		return $todoCorrecto;
	}	
?>