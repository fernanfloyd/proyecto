/*AJAX*/
	var xhr;
	var usuario=document.getElementById("usuario");
	if (window.XMLHttpRequest){
		xhr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		xhr= new ActiveXObject("Microsoft.XMLHTTP");
        }	
	function comprobarNickEnBD() {
		if (usuario.value !=''){
			xhr.onreadystatechange=gestionarRespuesta;
			xhr.open('POST', 'funciones/comprobarNickEnBd.php', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send('usuario='+usuario.value);
		}				
	}
	function gestionarRespuesta() {
		
		if (xhr.readyState == 4 && xhr.status == 200) {
			respuesta = xhr.responseText;
			if(respuesta=="EXISTE"){
				alert("Nick no disponible");
			}
			else{
				alert("Nick disponible");
				habilitarCampos();
			}
		}
	}
/*FIN AJAX*/
/*AJAX2*/
	var xhr2;
	var email=document.getElementById("txtmail");
	if (window.XMLHttpRequest){
		xhr2 = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		xhr2= new ActiveXObject("Microsoft.XMLHTTP");
        }	
	function comprobarMailEnBD() {
		if (email.value !=''){
			xhr2.onreadystatechange=gestionarRespuestaMail;
			xhr2.open('POST', 'funciones/comprobarMailEnBd.php', true);
			xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr2.send('email='+email.value);
		}				
	}
	function gestionarRespuestaMail() {
		
		if (xhr2.readyState == 4 && xhr2.status == 200) {
			respuesta = xhr2.responseText;
			if(respuesta=="EXISTE"){
				alert("Email no disponible");
				email.value="";
				email.focus();
			}
		}
	}
/*FIN AJAX2*/

//VALIDAR FORMULARIO
function validar(formulario){
	if(valPass()&&valNomApe()&&valTel()&&valMail()&&valCod()&&valTar()){
		formulario.submit();
	}
}

function valPass(){
	var pwd=document.getElementById('pwd').value;
	var cpwd=document.getElementById('conpwd').value;
	opc=false;
	if(pwd!=""&&pwd==cpwd){
		opc=true;
	}else{
		alert("Los campos de contraseña deben ser iguales");
		document.getElementById('pwd').focus();
	}
	return opc;
}
function valNomApe(){
	opc=false;
	var nom=document.getElementById('txtnombre').value;
	var ape=document.getElementById('txtapellidos').value;
	if(nom!=""&&ape!=""){
		opc=true;
	}else{
		alert("Deben estar rellenos los campos de Nombre y Apellido");
		document.getElementById('txtnombre').focus();
	}
	return opc;
}
function valTel(){
	var tel=document.getElementById('txttelefono').value;
	opc=false;
	expreT=/^[9|6]{1}[0-9]{8}$/;
	if(expreT.test(tel)){
		opc=true;
	}else{
		alert("El numero de telefono debe empezar por 9 o 6, y tener 9 cifras");
		document.getElementById('txttelefono').focus();
	}
	return opc;
}
function valMail(){
	opc=false;
	var mail=document.getElementById('txtmail').value;
	expreMa=/^[A-Za-z]{1}.+\@.+\.[a-zA-Z]{2,3}$/;
	if(expreMa.test(mail)){
		opc=true;
	}else{
		alert("Por favor, inserte un correo electronico valido");
		document.getElementById('txtmail').focus();
	}
	return opc;
}

function valCod(){
	opc=false;
	var codP=document.getElementById('codPos').value;
	expreC=/^[0-9]{5}$/;
	if(expreC.test(codP) || codP==""){
		opc=true;
	}else{
		alert("Por favor, rellene correntamente el codigo postal");
		document.getElementById('codPos').focus();
	}	
	return opc;
}
function valTar(){
	opc=false;
	var tar=document.getElementById('nTarj').value;
	expreTa=/^[0-9]{16}$/;
	if((expreTa.test(tar)) || tar==""){
		opc=true;
	}else{
		alert("Por favor, rellene correntamente el numero de Tarjeta o dejelo vacio");
		document.getElementById('nTarj').focus();
	}	
	return opc;
}

//OTRAS FUNCIONES
function advertencia(formulario){
	if(confirm('¿Seguro que quieres limpiar el formulario?'))
		formulario.reset();
	}


//VISIBILIDAD DE BOTONES
function habilitarCampos(){
	document.getElementById('pwd').disabled=false;
	document.getElementById('conpwd').disabled=false;
	document.getElementById('txtnombre').disabled=false;
	document.getElementById('txtapellidos').disabled=false;
	document.getElementById('txttelefono').disabled=false;
	document.getElementById('dias').disabled=false;
	document.getElementById('mes').disabled=false;
	document.getElementById('ano').disabled=false;
	document.getElementById('pais').disabled=false;
	document.getElementById('txtmail').disabled=false;
	document.formulario.sexo[0].disabled=false;
	document.formulario.sexo[1].disabled=false;
	document.getElementById('dire').disabled=false;
	document.getElementById('ciudad').disabled=false;
	document.getElementById('codPos').disabled=false;
	document.getElementById('nTarj').disabled=false;
	document.getElementById('pwd').focus();
}

function deshabilitarCampos(){
	document.getElementById('pwd').disabled=true;
	document.getElementById('conpwd').disabled=true;
	document.getElementById('txtnombre').disabled=true;
	document.getElementById('txtapellidos').disabled=true;
	document.getElementById('txttelefono').disabled=true;
	document.getElementById('dias').disabled=true;
	document.getElementById('mes').disabled=true;
	document.getElementById('ano').disabled=true;
	document.getElementById('pais').disabled=true;
	document.getElementById('txtmail').disabled=true;
	document.formulario.sexo[0].disabled=true;
	document.formulario.sexo[1].disabled=true;
	document.getElementById('dire').disabled=true;
	document.getElementById('ciudad').disabled=true;
	document.getElementById('codPos').disabled=true;
	document.getElementById('nTarj').disabled=true;
	document.getElementById('usuario').focus();
}

function habilita(formulario){
	if(formulario.chkacepto.checked == true)
		formulario.btnenviar.disabled = false;
	else	
		formulario.btnenviar.disabled = true;
	}
//CARGA PAISES PARA EDITAR
function carga_inicial_pais(){
	s1=document.getElementById('pais');	
	s1.options[0]=new Option("España","España");
	s1.options[1]=new Option("Francia","Francia");
	s1.options[2]=new Option("Italia","Italia");
	s1.options[3]=new Option("Alemania","Alemania");
	s1.options[4]=new Option("Inglaterra","Inglaterra");
	s1.options[5]=new Option("Portugal","Portugal");
	s1.options[6]=new Option("Suecia","Suecia");
	s1.options[7]=new Option("Escocia","Escocia");
	s1.options[8]=new Option("Irlanda","Irlanda");
	s1.options[9]=new Option("Rusia","Rusia");
	}

	
//CARGA INICIAL	
function carga_inicial(){
	/*s1=document.getElementById('pais');	
	s1.options[0]=new Option("España","España");
	s1.options[1]=new Option("Francia","Francia");
	s1.options[2]=new Option("Italia","Italia");
	s1.options[3]=new Option("Alemania","Alemania");
	s1.options[4]=new Option("Inglaterra","Inglaterra");
	s1.options[5]=new Option("Portugal","Portugal");
	s1.options[6]=new Option("Suecia","Suecia");
	s1.options[7]=new Option("Escocia","Escocia");
	s1.options[8]=new Option("Irlanda","Irlanda");
	s1.options[9]=new Option("Rusia","Rusia");
	*/
	s2=document.getElementById('dias');
	s2.options[0]=new Option("1","01");
	s2.options[1]=new Option("2","02");
	s2.options[2]=new Option("3","03");
	s2.options[3]=new Option("4","04");
	s2.options[4]=new Option("5","05");
	s2.options[5]=new Option("6","06");
	s2.options[6]=new Option("7","07");
	s2.options[7]=new Option("8","08");
	s2.options[8]=new Option("9","09");
	s2.options[9]=new Option("10","10");
	s2.options[10]=new Option("11","11");
	s2.options[11]=new Option("12","12");
	s2.options[12]=new Option("13","13");
	s2.options[13]=new Option("14","14");
	s2.options[14]=new Option("15","15");
	s2.options[15]=new Option("16","16");
	s2.options[16]=new Option("17","17");
	s2.options[17]=new Option("18","18");
	s2.options[18]=new Option("19","19");
	s2.options[19]=new Option("20","20");
	s2.options[20]=new Option("21","21");
	s2.options[21]=new Option("22","22");
	s2.options[22]=new Option("23","23");
	s2.options[23]=new Option("24","24");
	s2.options[24]=new Option("25","25");
	s2.options[25]=new Option("26","26");
	s2.options[26]=new Option("27","27");
	s2.options[27]=new Option("28","28");
	s2.options[28]=new Option("29","29");
	s2.options[29]=new Option("30","30");
	s2.options[30]=new Option("31","31");
	
	s3=document.getElementById('mes');
	s3.options[0]=new Option("Enero","01");
	s3.options[1]=new Option("Febrero","02");
	s3.options[2]=new Option("Marzo","03");
	s3.options[3]=new Option("Abril","04");
	s3.options[4]=new Option("Mayo","05");
	s3.options[5]=new Option("Junio","06");
	s3.options[6]=new Option("Julio","07");
	s3.options[7]=new Option("Agosto","08");
	s3.options[8]=new Option("Septiembre","09");
	s3.options[9]=new Option("Octubre","10");
	s3.options[10]=new Option("Noviembre","11");
	s3.options[11]=new Option("Diciembre","12");	
	
	s4=document.getElementById('ano');
	s4.options[0]=new Option("1994","1994");
	s4.options[1]=new Option("1993","1993");
	s4.options[2]=new Option("1992","1992");
	s4.options[3]=new Option("1991","1991");
	s4.options[4]=new Option("1990","1990");
	s4.options[5]=new Option("1989","1989");
	s4.options[6]=new Option("1988","1988");
	s4.options[7]=new Option("1987","1987");
	s4.options[8]=new Option("1986","1986");
	s4.options[9]=new Option("1985","1985");
	s4.options[10]=new Option("1984","1984");
	s4.options[11]=new Option("1983","1983");
	s4.options[12]=new Option("1982","1982");
	s4.options[13]=new Option("1981","1981");
	s4.options[14]=new Option("1980","1980");
	s4.options[15]=new Option("1979","1979");
	s4.options[16]=new Option("1978","1978");
	s4.options[17]=new Option("1977","1977");
	s4.options[18]=new Option("1976","1976");
	s4.options[19]=new Option("1975","1975");
	s4.options[20]=new Option("1974","1974");
	s4.options[21]=new Option("1973","1973");
	s4.options[22]=new Option("1972","1972");
	s4.options[23]=new Option("1971","1971");
	s4.options[24]=new Option("1970","1970");
	s4.options[25]=new Option("1969","1969");
	s4.options[26]=new Option("1968","1968");
	s4.options[27]=new Option("1967","1967");
	s4.options[28]=new Option("1966","1966");
	s4.options[29]=new Option("1965","1965");
	s4.options[30]=new Option("1964","1964");
		
	} 
	
