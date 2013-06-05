var o=new Object();
var objeto= new Object();
var aux="";
function anadirPro(titulo,imagen,precio,id){
	o.titulo=titulo;
	o.imagen=imagen;
	o.precio=precio;
	o.cantidad=1;
	o.id=id;
	if(!localStorage.COT_history){
		localStorage.COT_history = "[" + JSON.stringify( o ) + "]";
	}else{
		aux = JSON.parse(localStorage.COT_history);
		id=comprobarPeli(aux,titulo);
		if(comprobarPeli(aux,titulo)){
			for(var j = 0; j < aux.length; j++ ){
				if(aux[j].titulo==titulo){
					aux[j].cantidad++;
					aux[j].precio=num(parseFloat(aux[j].precio)+parseFloat(precio));
				}
			}
		}else{
			aux.push(o);
		}
		localStorage.COT_history = JSON.stringify(aux);
	}
	document.location.href='tienda.php';
}
function comprobarPeli(aux,titulo){
	for(var j = 0; j < aux.length; j++ ){
		if(aux[j].titulo==titulo){
			return true;
		}
	}
	return false;
}

function comprobarPeliID(aux,titulo){
	for(var j = 0; j < aux.length; j++ ){
		if(aux[j].titulo==titulo){
			return j;
		}
	}
	return false;
}
function elimLista(){
	localStorage.COT_uses = 1;
	localStorage.removeItem("COT_history");
	document.location.href='index.php';		
}

jQuery(function($){
	if ($('.cesta').length){
		if(!localStorage.COT_history){
			$('.cesta').html("");
			$('.cesta').append("<p>Cesta Vacia</p><p>Ir a <a href='tienda.php'>Tienda</a></p>");
		}else{
			total=0;
			$('.cesta').html("");
			$('.cesta').append("<p>Tus productos:</p>");
			objeto=JSON.parse(localStorage.COT_history);
			for(var j = 0; j < objeto.length; j++ ){
				$('.cesta').append("<div class='cestaInfo'><div class='cestaFoto' style='width:71px;float:left;text-align:center;'><img src='imagenes/caratulas/"+objeto[j].imagen+".png' style='width:56px;heigth:56px'/></div><div class='cestaTexto' style='width:120px;float:left;text-align:center;'>"+objeto[j].titulo+"</div><div class='cestaPrecio' style='width:70px;float:left;text-align:center;'>"+objeto[j].precio+"€</div><p style='width:120px;float:right;'>Cantidad: "+objeto[j].cantidad+"</p><p style='width:120px;float:right;'><input type='button' value='Quitar' class='del botonCompra' /></p></div>");
				total=total+parseFloat(objeto[j].precio);
			}
			$('.cesta').append("<div class='cestaTotal'><p>Total:........"+num(total)+"€</p><input type='button' value='finalizar compra' class='botonCompra' /></div>");
		}
	}
	
	$(".cestaInfo").on("click",".del", function(){
		titulo=$(".cestaInfo").has(this).find(".cestaTexto").text();
		quitar(titulo);
		document.location.reload();	
	});
	
	$(".botonCompra").on("click", function(){
		document.location.href="confirmarCompra.php";
	});
});
function quitar(titulo){
	aux = JSON.parse(localStorage.COT_history);
	id=comprobarPeliID(aux,titulo);
	if(aux[id].cantidad>1){
		aux[id].precio=num(parseFloat(aux[id].precio)-(aux[id].precio/aux[id].cantidad));
		aux[id].cantidad--;
	}else{
		aux.splice(id,1);
	}
	localStorage.COT_history = JSON.stringify(aux);
	if(aux==""){
		localStorage.COT_uses = 1;
		localStorage.removeItem("COT_history");
		document.location.reload();
	}
}

function num(n){
	if(!isNaN(n)&&n!=""){
		n=n.toFixed(2);
	}
	return n;
}