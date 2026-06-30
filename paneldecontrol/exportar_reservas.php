<?php		 
require_once("../init.php"); # inicio la conexion con la BD
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    	        // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  	        // HTTP/1.1
header ("Pragma: no-cache");                          	        // HTTP/1.0
header("Content-type: application/vnd-ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=reservas_".date('Y-m-d').".xls");
?>
<style>
.tdrow1 {
	font-family:Verdana, Arial;
	color:#000000;
	font-size:11px;
	font-weight:normal;
}
.cabecera
{	background-color:#CCCCCC;
	font-weight:bold;
	font-size:11px;

}
.info
{	
	font-weight:bold;
	font-size:11px;
	font-family:Verdana;

}
.titulo
{	font-weight:bold;
	font-family:Verdana,Arial;
	font-size:18px;
	font-weight:bold;
	color:#993300;

}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>

<?php	$reservas = new cls_tbl_reservas();
		$SQL="SELECT pk_reserva, txt_name, txt_ape, txt_email, txt_direccion, pais, fk_destino, txt_telefono, txt_cantidad_adultos, txt_fecha_salida, txt_ingreso, txt_comentario, date_fecha, tbl_paquete_details.txt_title as paquete, txt_fecha_salida, pais, tbl_estado.pk_estado as estado FROM tbl_reservas 
	LEFT JOIN tbl_paquete_details ON tbl_reservas.fk_destino = tbl_paquete_details.fk_paquete 
	LEFT JOIN tbl_estado ON tbl_reservas.fk_estado = tbl_estado.pk_estado ORDER BY pk_reserva DESC";
		$resultado = $reservas->lista($sql);	  
		$num	= count($resultado);
?>

<table width="100%" align="center" cellpadding="1" cellspacing="1" border="0">
<tr><td colspan="12">&nbsp;</td></tr>
<tr><td class="titulo" colspan="12">Reporte de Solicitud de Cotizaciones</td></tr>
<tr><td class="info"  colspan="12">Total de Cotizaciones: <?php echo $num?></td></tr>
</table>

<table width="100%" align="center" cellpadding="1" cellspacing="1" border="1">
<tr class="cabecera">
	 <TD width="26%" height="25" align="left" valign="middle" class="tdrow1">FECHA</TD>
	 <TD width="8%" align="left" valign="middle" class="tdrow1">NOMBRE</TD>
     <TD width="8%" align="left" valign="middle" class="tdrow1">APELLIDOS</TD>
	 <TD width="8%" align="left" valign="middle" class="tdrow1">EMAIL</TD>
     <TD width="13%" align="left" valign="middle" class="tdrow1">PAIS</TD>
     <TD width="15%" align="left" valign="middle" class="tdrow1">TELEFONO</TD>
     <TD width="23%" align="left" valign="middle" class="tdrow1">DESTINO</TD>
     <TD width="15%" align="left" valign="middle" class="tdrow1">CANTIDAD</TD>	 
	 <TD width="15%" align="left" valign="middle" class="tdrow1">FECHA DE VIAJE</TD>	
	 <TD width="15%" align="left" valign="middle" class="tdrow1">NOTA</TD
</tr>

<?php for($i=0;$i<=count($resultado);++$i) { ?>
<tr>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['date_fecha'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['txt_name'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['txt_ape'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['txt_email'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['pais'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['txt_telefono'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['paquete'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['txt_cantidad'])?></td>
	<td valign="top"><?php echo utf8_decode($resultado[$i]['txt_fecha_viaje'])?></td>	
	<td valign="top"><?php echo utf8_decode($resultado[$i]['txt_comentario'])?></td>
</tr>
<?php } ?>
</table>
