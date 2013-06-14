<?php
	include("funciones/funciones.php");
	include("funciones/top.php");
	
	if(isset($_POST['modificandoClave'])){ //SI LO QUE QUIERES MODIFICAR ES LA CLAVE
		$nickUsuario=$_POST['nickUsuario'];
		$idUsuario=$_POST['idUsuario'];
		$pwdActual=$_POST['pwdActual'];
		$pwdNueva=$_POST['pwdNueva'];
		$conPwdNueva=$_POST['conPwdNueva'];
		if(comprobarPassActual($idUsuario, $pwdActual, $nickUsuario)){
			if($pwdNueva!=$conPwdNueva){
				msj("<br/>Error al modificar la clave. La nueva clave debe ser la misma en los dos campos");
			}
			else{
				modificarPass($pwdNueva, $idUsuario, $nickUsuario);
			}	
		}
		else{
			msj("<br/>Error al modificar la clave. La clave actual es incorrecta");
		}
		
		
	}
	else{
		if(isset($_POST['modificandoDatosPersonales'])){ // SI LO QUE QUIERES MODIFICAR SON LOS DATOS PERSONALES
			$idUsuario=$_POST['idUsuario'];
			$telefono=$_POST['telefonoNuevo'];
			$email=$_POST['correo'];
			$pais=$_POST['pais'];
			$telefonoIntroducido=false;
			$emailIntroducido=false;
			$paisIntroducido=false;
			$esPrimero=true;
			$consulta="UPDATE DATOS SET";
			
			
			if(!empty($telefono)){
				if($esPrimero){
					$consulta=$consulta." TELEFONO='$telefono'";
					$telefonoIntroducido=true;
					$esPrimero=false;
				}
			}
			if(!empty($email)){
				if($esPrimero){
					$consulta=$consulta." EMAIL='$email'";
					$emailIntroducido=true;
					$esPrimero=false;
				}
				else{
					$consulta=$consulta.", EMAIL='$email'";
					$emailIntroducido=true;
				}
				
			}
			if(!empty($pais)){
				if($esPrimero){
					$consulta=$consulta." PAIS='$pais'";
					$paisIntroducido=true;
					$esPrimero=false;
				}
				else{
					$consulta=$consulta.", PAIS='$pais'";
					$paisIntroducido=true;
				}
				
			}
			
			
			if($telefonoIntroducido || $emailIntroducido || $paisIntroducido){
				$consulta=$consulta." WHERE ID_USUARIO='$idUsuario';";
				modificarDatosPersonales($consulta);
			}
			else{
				msj("<br/>No se ha modificado ningún dato personal");
			}
		}
		else{
			if(isset($_POST['modificandoDatosEnvio'])){ // SI LO QUE QUIERES MODIFICAR ES ALGUNOS DE LOS DATOS DE ENVIO Y PAGO
				$idUsuario=$_POST['idUsuario'];
				$direccion=$_POST['dir'];
				$ciudad=$_POST['ciu'];
				$codPos=$_POST['cod'];
				$tarjeta=$_POST['tar'];
				$direccionIntroducida=false;
				$ciudadIntroducida=false;
				$codPosIntroducido=false;
				$tajetaIntroducida=false;
				$esPrimero=true;
				$consulta="UPDATE DATOS SET";
				$finConsulta=" WHERE ID_USUARIO='$idUsuario';";
			
			
				if(!empty($direccion)){
					if($esPrimero){
						$consulta=$consulta." DIRECCION='$direccion'";
						$direccionIntroducida=true;
						$esPrimero=false;
					}
				}
				if(!empty($ciudad)){
					if($esPrimero){
						$consulta=$consulta." CIUDAD='$ciudad'";
						$ciudadIntroducida=true;
						$esPrimero=false;
					}
					else{
						$consulta=$consulta.", CIUDAD='$ciudad'";
						$ciudadIntroducida=true;
					}
					
				}
				if(!empty($codPos)){
					if($esPrimero){
						$consulta=$consulta." COD_POSTAL='$codPos'";
						$codPosIntroducido=true;
						$esPrimero=false;
					}
					else{
						$consulta=$consulta.", COD_POSTAL='$codPos'";
						$codPosIntroducido=true;
					}
					
				}
				if(!empty($tarjeta)){
					if($esPrimero){
						$consulta=$consulta." N_TARJETA='$tarjeta'";
						$tajetaIntroducida=true;
						$esPrimero=false;
					}
					else{
						$consulta=$consulta.", N_TARJETA='$tarjeta'";
						$tajetaIntroducida=true;
					}
					
				}
				
				
				if($direccionIntroducida || $ciudadIntroducida || $codPosIntroducido || $tajetaIntroducida){
					$consulta=$consulta." WHERE ID_USUARIO='$idUsuario';";
					modificarDatosEnvioPago($consulta);
				}
				else{
					msj("<br/>No se ha modificado ningún dato de envío y pago");
				}
			}
			else{
				if(isset($_POST['anadiendoDatosEnvio'])){ //SI LO QUE QUIERES ES AÑADIR DATOS DE ENVIO Y PAGO
					$idUsuario=$_POST['idUsuario'];
					$direccion=$_POST['dir'];
					$ciudad=$_POST['ciu'];
					$codPos=$_POST['cod'];
					$tarjeta=$_POST['tar'];
					$consulta="UPDATE DATOS SET DIRECCION='$direccion', CIUDAD='$ciudad', COD_POSTAL='$codPos', N_TARJETA='$tarjeta' WHERE ID_USUARIO='$idUsuario';";
					anadirDatosEnvioPago($consulta);
				}
			}
		}
	}
	
		
	
	
	//COMPROBAR PASSWORD ACTUAL DEL USUARIO
	function comprobarPassActual($idUsuario, $passActual, $user){
		$passCorrecta = false;
		$salt = substr ($user, 0, 2);
		$passwordC=crypt($passActual, $salt);
		nuevaConexionBd();
		$consulta="SELECT CLAVE FROM USUARIOS WHERE ID_USUARIO='$idUsuario';";
		$resultado=mysql_query($consulta) or die(msj("<br/>Ha fallado la consulta para comprobar la clave actual: ".mysql_error()));
		while($fila=mysql_fetch_array($resultado)){
			if($fila[0]==$passwordC){
			$passCorrecta = true;
			}
		}
		return $passCorrecta;
	}
	
	//MODIFICAR PASSWORD USUARIO
	function modificarPass($passNueva, $idUsuario, $nickUsuario){
		nuevaConexionBd();
		$salt = substr ($nickUsuario, 0, 2);
		$passwordC = crypt ($passNueva, $salt);
		$consulta="UPDATE USUARIOS
		SET CLAVE='$passwordC'
		WHERE ID_USUARIO='$idUsuario';";
		mysql_query($consulta) or die(msj("<br/>Error al modificar la clave del usuario: ".mysql_error()));
		msj("<br/>La clave del usuario ha sido modificada con éxito");
	}
	
	
	//Funcion que modifica los datos personales del usuario
	function modificarDatosPersonales($consulta){
		//msj("<br/>".$consulta."<br/><br/><br/>");
		nuevaConexionBd();
		$resultado=mysql_query($consulta) or die(msj("<br/>Error al modificar los datos personales del usuario: ".mysql_error()));
		msj("<br/>Se han modificado con éxito los datos personales del usuario");
	}
	
	//Funcion que modifica los datos de envio y pago del usuario
	function modificarDatosEnvioPago($consulta){
		//msj("<br/>".$consulta."<br/><br/><br/>");
		nuevaConexionBd();
		$resultado=mysql_query($consulta) or die(msj("<br/>Error al modificar los datos de envio y pago del usuario: ".mysql_error()));
		msj("<br/>Se han modificado con éxito los datos de envio y pago del usuario");
	}
	
	
	//Funcion que añade los datos de envio y pago del usuario mediante una modificacion
	function anadirDatosEnvioPago($consulta){
		nuevaConexionBd();
		$resultado=mysql_query($consulta) or die(msj("<br/>Error al añadir los datos de envio y pago del usuario: ".mysql_error()));
		msj("<br/>Se han añadido con éxito los datos de envio y pago del usuario");
	}
	
	
	function msj($texto){
		header("Location:respuesta.php?txt=$texto");
	}
	
	
?>