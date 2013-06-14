//$(document).ready(function(){
jQuery(function($){
	//Para que en el buscador, cuando pulsemos enter inicie la busqueda
	$('#search').keydown(function(e) {
		if (e.keyCode == 13) {
			 $('#search').submit();
		}
	});
	
});



//CONFIRMACIONES BORRADO Y MODIFICACION ACTORES
function deleteActorConfirm(){
	var respuesta=confirm("¿Esta seguro que desea eliminar este actor?");
	if (respuesta == false){
		return false;
	}
}

function modifyActorConfirm(){
	var respuesta=confirm("¿Esta seguro que desea modificar los datos de este actor?");
	if (respuesta == false){
		return false;
	}
	else{
		return true;
	}
}

//CONFIRMACIONES BORRADO Y MODIFICACION PELICULAS
function deletePeliculaConfirm(){
	var respuesta=confirm("¿Esta seguro que desea eliminar esta película?");
	if (respuesta == false){
		return false;
	}
}

function modifyPeliculaConfirm(){
	var respuesta=confirm("¿Esta seguro que desea modificar los datos de esta película?");
	if (respuesta == false){
		return false;
	}
	else{
		return true;
	}
}

//CONFIRMACIONES BORRADO Y MODIFICACION NOTICIAS
function deleteNoticiaConfirm(){
	var respuesta=confirm("¿Esta seguro que desea eliminar esta noticia?");
	if (respuesta == false){
		return false;
	}
}

function modifyNoticiaConfirm(){
	var respuesta=confirm("¿Esta seguro que desea modificar los datos de esta noticia?");
	if (respuesta == false){
		return false;
	}
	else{
		return true;
	}
}

//CONFIRMACIONES BORRADO Y CENSURA COMENTARIOS
function deleteComentarioConfirm(){
	var respuesta=confirm("¿Esta seguro que desea eliminar este comentario?");
	if (respuesta == false){
		return false;
	}
}

function censoreComentarioConfirm(){
	var respuesta=confirm("¿Esta seguro que desea censurar este comentario?");
	if (respuesta == false){
		return false;
	}
}

//CONFIRMACION BORRADO DE USUARIO
function deleteUsuarioConfirm(){
	var respuesta=confirm("¿Esta seguro que desea eliminar a este usuario?");
	if (respuesta == false){
		return false;
	}
}