<?php
function top(){
nuevaConexionBd();
						$top=array();
						$consulta="SELECT VE.PELICULA,SUM(VE.CANTIDAD) AS NVENDIDOS,VE.ID_PELICULA FROM VENTAS AS VE LEFT JOIN PELICULAS AS PE ON PE.TITULO = VE.PELICULA GROUP BY VE.PELICULA ORDER BY NVENDIDOS DESC LIMIT 10;";

						$resultado=mysql_query($consulta);
						$i=0;
						while($fila=mysql_fetch_array($resultado)){
							$top[$i]['id_pelicula']=$fila[2];
							$top[$i]['titulo']=$fila[0];
							$i +=1;
						}
	return $top;
}
?>	