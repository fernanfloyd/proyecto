jQuery(function($){
	if(!localStorage.COT_history){
		$('#pedido').html("");
		$('#pedido').append("<p>Cesta vacia</p>");
		$('#cliente').html("<p>Ir a <a href='tienda.php'>Tienda</a></p>");
	}else{
		$('#pedido').html("");
		$('#pedido').append("<p>Tus productos:</p>");
		objeto=JSON.parse(localStorage.COT_history);
		for(var j = 0; j < objeto.length; j++ ){
		$('#pedido').append("<a href='#'><div class='cajitasTienda'><div class='caja_foto_tienda'><img src='imagenes/caratulas/"+objeto[j].imagen+".png' height='150' width='100' /></div><div class='caja_texto_tienda'><h4>"+objeto[j].titulo+"</h4><p class='precio'><h4 class='azul'>"+objeto[j].precio+"€</h4></p></div><div class='caja_texto_duracion_tienda'><p class='precio'><h4>"+objeto[j].cantidad+" Unidad/Unidades</h4></p></div></div></div></a>");
			}
		$('#pedidoTotal').append("<p>Total:........"+num(total)+"€</p><input type='button' value='confirmar compra' class='botonVenta' />");
		if($("#nTarj").val()==""){
			$(".botonVenta").attr("disabled","disabled");
			}
		}
		
	$(".botonVenta").on("click", function(){
		jConfirm("Se va a realizar la compra\n¿Desea confirmar la compra?", "ImpactFilm", function(r) {  
			if(r) {  
				pedido=JSON.stringify(localStorage.COT_history);
				pedido=encodeURIComponent(pedido);
				document.location.href="venta.php?pedido="+pedido;
			}  
		});  
	});
	$("#botonTar").on("click", function(){
		tarjeta=$("#nTarj").val();
		document.location.href="insertarTarjeta.php?tar="+tarjeta;
	});
	
	$("#nTarj").on("keyup, change", function(){
		if(valTar()){
			$(".botonVenta").removeAttr("disabled");
			$("#botonTar").removeAttr("disabled");
		}else{
			$(".botonVenta").attr("disabled","disabled");
			$("#botonTar").attr("disabled","disabled");
		}
	});
});
function valTar(){
	opc=false;
	var tar=document.getElementById('nTarj').value;
	expreTa=/^[0-9]{16}$/;
	if((expreTa.test(tar))){
		opc=true;
	}	
	return opc;
}
