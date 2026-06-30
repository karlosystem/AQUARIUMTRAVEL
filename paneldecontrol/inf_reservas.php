<?php
require_once("header.php");
?>
<script language="javascript" src="js/jquery.js" type="text/javascript"></script>
<script language="javascript" src="js/jquery.pop.js" type="text/javascript"></script>
<link href="css/pop.css" media="all" rel="stylesheet" type="text/css" />

<script type='text/javascript'>
	$(document).ready(function() {
		$.pop();
	});
</script>

<script language="javascript">
	var MyForm = 'frm_listreservas';
	var urlProcess = 'inf_reservas.php';
	var IsRowSlow = 'rowreservas_';
</script>


<script language="javascript">
	function hide() {
		var earrings = document.getElementById('getfk_estado');
		earrings.style.visibility = 'hidden';
		var dato = document.getElementById('dato');
		dato.style.visibility = 'visible';
		dato.style.position = 'absolute';
	}

	function show() {
		var earrings = document.getElementById('getfk_estado');
		earrings.style.visibility = 'visible';
		earrings.style.position = 'relative';
		var dato = document.getElementById('dato');
		dato.value = '';
		dato.style.visibility = 'hidden';
		dato.style.position = 'absolute';
	}


	function genderSelectHandler(select) {
		if (select.value == 'txt_estado') {
			show();
		} else if (select.value == 'txt_name') {
			hide();
		} else if (select.value == 'txt_ape') {
			hide();
		} else if (select.value == 'txt_email') {
			hide();
		} else if (select.value == 'txt_telefono') {
			hide();
		}
	}
</script>

<?php

$op = (int) (tep_not_null($_GET['op']) ? $_GET['op'] : $_POST['op']);
$IsReferrer = $_SERVER['HTTP_REFERER'];
if ($op > 0) {
	switch ($op) {
		case 5:  #Remover locales-videos sólo los seleccioandos

			if (!empty($_POST["chkreservas"])) {
				foreach ($_POST["chkreservas"] as $valor) {
					if ($valor) {
						(int)$valor;
						$SQL = "DELETE FROM [|PREFIX|]reservas WHERE pk_reserva='" . $valor . "' ";
						$GLOBALS['CONNECT_DB']->Query($SQL);
					}
				}		// foreach
			}
			break;
	}
	header("Location:$IsReferrer");
}

$filename = basename($_SERVER['PHP_SELF']);
$limit = 30;
$page = $_GET['page'];
if (empty($page) || !is_numeric($page) || $page < 0)
	$page = 1;

$total_itemsreservas = count_entries('reservas', '', '', '');

if ($_GET['Buscar']) {
	$sqlBuscar = "";
	if (tep_not_null($_GET['dato'])) {
		$sqlBuscar = " AND " . $_GET['campo'] . " like '%" . $_GET['dato'] . "%'";
	}
	$limit = 30;
}

if ($_GET['Ver']) {
	$sqlBuscar = "";
	if ($_GET['getfk_estado']) {
		$sqlBuscar .= " AND tbl_estado.pk_estado='" . $_GET['getfk_estado'] . "'";
	}
	$total_itemsreservas = count_entries('reservas', 'fk_estado', (int)$_GET['getfk_estado'], '');
	$limit = 30;
	$filename = "";
	$filename = "inf_reservas.php?getfk_estado=" . (int)$_GET['getfk_estado'] . "&Ver=Buscar";
}

$total_pages = ceil($total_itemsreservas / $limit);
$set_limit = $page * $limit - ($limit);
if ($total_itemsreservas - $set_limit == 1)
	$page--;

$SQL = "Select 	pk_reserva, LOWER(txt_name) as txt_name, 
	LOWER(txt_ape) as txt_ape, 
	LOWER(txt_email) as txt_email, 
	txt_direccion, 
	pais, fk_destino, 
	txt_telefono, txt_fecha_salida, 
	txt_ingreso, 
	txt_comentario, date_fecha, 
	tbl_paquete_details.txt_title as paquete, 
	txt_cantidad_adultos, pais, 
	tbl_estado.pk_estado as estado, 
	txt_vendedor, txt_tipo, 
       (select count(*) from tbl_reservas c2 where (c2.fk_destino = c.fk_destino and c2.pk_reserva <= c.pk_reserva)) as counter
from tbl_reservas c 
	LEFT JOIN tbl_paquete_details ON c.fk_destino = tbl_paquete_details.fk_paquete 
	LEFT JOIN tbl_estado ON c.fk_estado = tbl_estado.pk_estado
	where (year(c.date_fecha) in (2021, 2022, 2023, 2024) and (c.pk_reserva <> '' " . $sqlBuscar . "))
ORDER BY c.pk_reserva DESC LIMIT $set_limit,$limit";

$reservas = new cls_tbl_reservas();
$resultado = $reservas->lista($SQL);

$contador = $set_limit;
$numFilas =  count($resultado);
?>

<!--  Content  -->
<div class="container_12">
	<div class="bottom-spacing">
		<!-- Button -->
		<div class="float-right">
			<a href="frm_reservas.php?do=create" class="button">
				<span>Crear Cotizacion <img src="images/plus-small.gif" width="12" height="9" alt="Nueva Cotizacion" /></span>
			</a>

			<a href="exportar_reservas.php" class="button">
				<span>Exportar Reservas <img src="images/plus-small.gif" width="12" height="9" alt="Exportar a Excel" /></span>
			</a>


			<a class="button" href="#" onclick="javascript:eliminar_todos();">
				<span>Eliminar</span>
			</a>


		</div>



		<table align="center" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="30%" valign="top">
					<form id="frm_buscar" name="frm_buscar" action="inf_reservas.php" method="get">
						<table width="100%">
							<tr>
								<td width="31%" height="40" align="left">Buscar Por:
									<select name="campo" id="campo" class="input-medium">
										<option value="txt_name">Nombre</option>
										<option value="txt_ape">Apellidos</option>
										<option value="txt_email">Email</option>
										<option value="txt_telefono">Tel&eacute;fono</option>
									</select>
								</td>
								<td width="33%" align="left">
									<input type="text" title="Ingrese las primeras letras" style="padding:3px; border: 1px solid #cccccc; background: url(images/input-bg.gif) top left repeat-x #f6f6f6;" id="dato" name="dato" value="<?php echo $_GET['dato'] ?>" />
								</td>
								<td width="36%" align="left">
									<input type="submit" value="Buscar" class="submit-green" title="Buscar Ahora" name="Buscar" id="Buscar" />
									<input type="button" value="Todo" class="submit-gray" onclick="window.location.href='inf_reservas.php'" title="Todos" name="Todo" id="Todo" />
								</td>
							</tr>
						</table>
					</form>
				</td>
				<td valign="top" width="70%">
					<table width="100%">
						<tr>
							<td width="75" align="right">Pendiente&nbsp;</td>
							<td width="15" align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_apedido.jpg\" title=\"Pendiente de atencion\" />"; ?></td>
							<td width="91" align="right">En Proceso&nbsp;</td>
							<td width="34" align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_agotado.jpg\" title=\"En Proceso\" />"; ?></td>
							<td width="41" align="right">Enitido&nbsp;</td>
							<td width="22" align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_pronto.jpg\" title=\"Emitido\" />"; ?></td>
							<td width="70" align="right">No Compro&nbsp;</td>
							<td width="11" align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_stock.jpg\" title=\"No Compro\" />"; ?></td>
							<td width="81" align="right">Venta Futura&nbsp;</td>
							<td width="22" align="left"><?php print "<img align=\"left\" src=\"images/icons/ico_stock.gif\" title=\"Venta Futura\" />"; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top" align="center" width="50%" colspan="1" style="margin:0px;">
					<form id="frm_ver" name="frm_ver" action="inf_reservas.php" method="get" style="margin-top:0px; padding-top:0px; position: relative;">
						<table width="100%" style="margin-top:0px;">
							<tr>
								<td width="43%" height="40" align="left">Estado:
									<select name="getfk_estado" style="margin-top:0px;" id="getfk_estado" title="Seleccione el estado">
										<?php print cls_tbl_estado::ListaEstado(); ?>
									</select>
								</td>
								<td width="57%" align="left">
									<input type="submit" value="Buscar" class="submit-green" title="Buscar Ahora" name="Ver" id="Ver" />
								</td>
							</tr>
						</table>
					</form>
				</td>
				<td align="center" width="50%" valign="top" colspan="1">
					<table width="100%" style="border:1px solid #000000;">
						<?php
						#Paginacion
						$pagination = '';

						if ($total_itemsreservas - $set_limit == 1)
							$page++;
						$pagination = generate_smart_pagination($page, $total_itemsreservas, $limit, 1, $filename, $params_pag);
						if (tep_not_null($pagination)) {
							echo "<div id=\"div-group-pagination\">";
							echo $pagination;
							echo "</div>";
						}
						?>
					</table>
				</td>

			</tr>
		</table>

		<div class="module">
			<h2><span>Gesti&oacute;n de Cotizaciones | Total de registros: <?php print $total_itemsreservas ?></span></h2>
			<div class="module-table-body">
				<form action="" method="POST" name="frm_listreservas" id="frm_listreservas">

					<table id="myTable" class="tablesorter">
						<thead>
							<tr>
								<!-- <th width="4%" height="25" align="center" >
              <input name="chkallregister" type="checkbox" onclick="checkAll(this)"/>              </th> -->
								<th width="4%" align="center">#</th>
								<th width="15%" align="left">INTERESADO(A) </th>
								<th width="24%" align="left">PAQUETE INTERESADO </th>
								<th width="3%" align="center">VECES</th>
								<th width="10%" align="left">SALIDA </th>
								<th width="15%" align="left">E-MAIL</th>
								<th width="9%" align="left">TELEFONO</th>
								<th width="12%" align="center">REGISTRO</th>
								<th width="6%" align="center">EST</th>
								<th width="5%" align="center">ATE</th>
								<th width="6%" align="center">VER</th>

							</tr>
						</thead>
						<tbody>
							<?php
							if ($numFilas == 0) {
							?>
								<tr>
									<td colspan="10" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de Cotizaciones</td>
								</tr>
								<?php } // if
							else {

								$cint = 1;
								$sw = 0;
								foreach ($resultado  as $array) {
									if ($sw == 0) {
										$sw = 1;
									} else {
										$sw = 0;
									}
									$id = $resultado[$contador - 1]['pk_reserva'];
									$color = inc_color($sw);
									$name_add = secure_sql($array['txt_name']);
								?>
									<tr onMouseOver="this.className='On'" onMouseOut="this.className=''" height="20">
										<!-- <td  style="background-color:<?php echo  $color ?>" align="center"><input name="chkreservas[]" type="checkbox" value="<?php print $array['pk_reserva'] ?>" id="chkreservas[]" /></td> -->
										<td style="background-color:<?php echo  $color ?>" align="center">
											<?php
											print $cint;
											?>
										</td>


										<td align="left" style="background-color:<?php echo  $color ?>">


											<?php echo  $array['txt_name'] . " " . $array['txt_ape'] ?>
											<div class='pop'>
												<?php echo  $array['txt_comentario'] ?>
											</div>


											<?php
											switch ($array['txt_tipo']) {
												case "Llamada Telefonica":
													print "<img src=\"images/phone.png\" align=\"middle\" title=\"Llamada Telefonica\" />";
													break;
												case "Formulario Web":
													print "<img src=\"images/email.png\" align=\"middle\" title=\"Formulario Web\"/>";
													break;
												case "Facebook":
													print "<img src=\"images/facebook.png\" align=\"middle\" title=\"Facebook\"/>";
													break;
												case "Correo":
													print "<img src=\"images/american.png\" align=\"middle\" title=\"Correo American\"/>";
													break;
												case "Contactenos":
													print "<img src=\"images/contactenos.png\" align=\"middle\" title=\"Contactenos\"/>";
													break;
												default:
													print "&nbsp;";
													break;
											}
											?>


										</td>
										<td style="background-color:<?php echo  $color ?>" align="left">
											<?php echo  $array['paquete'] ?> </td>

										<td align="center" valign="middle" style="background-color: #e6eeee; font-weight:bold; color: #6666cc" class="tdrows">
											<?php echo  $array['counter'] ?> </td>


										<td style="background-color:<?php echo  $color ?>" align="left">
											<?php
											$fecha_salida = Date::convert($array['txt_fecha_salida'], 'Y-m-d', 'd-m-Y');

											/*if(tep_not_null($array['txt_fecha_salida'])){
			  	echo $fecha_salida;
			  }elseif($fecha_salida == "30-11-1999"){
				echo "";  
			  }*/

											if ($fecha_salida == "30-11-1999") {
												echo "-";
											} else {
												echo $fecha_salida;
											}


											?>
										</td>


										<td style="background-color:<?php echo  $color ?>" align="left">
											<?php echo  $array['txt_email'] ?> </td>
										<td style="background-color:<?php echo  $color ?>" align="left">
											<?php echo  $array['txt_telefono'] ?> </td>
										<td style="background-color:<?php echo  $color ?>" align="center">
											<?php echo Date::convert($array['date_fecha'], 'Y-m-d H:i:s', 'd-m-Y H:i:s') ?>
										</td>

										<td style="background-color:<?php echo  $color ?>" align="center">

											<?php
											switch ((int)$array['estado']) {
												case 1:
													print "<img src=\"images/icons/ico_apedido.jpg\" title=\"Pendiente de atencion\" />";
													break;
												case 2:
													print "<img src=\"images/icons/ico_agotado.jpg\" title=\"En Proceso\"/>";
													break;
												case 3:
													print "<img src=\"images/icons/ico_pronto.jpg\" title=\"Emitido\"/>";
													break;
												case 4:
													print "<img src=\"images/icons/ico_stock.jpg\" title=\"No Compro\"/>";
													break;
												case 5:
													print "<img src=\"images/icons/ico_stock.gif\" title=\"Venta Futura\"/>";
													break;
												case 7:
													print "<img src=\"images/icons/icono-ayuda.png\" title=\"Venta Futura\"/>";
													break;
												case 8:
													print "<img src=\"images/icons/asterisk.gif\" title=\"Urgente\"/>";
													break;
												case 9:
													print "<img src=\"images/icons/fecha.png\" title=\"Fuera de Fecha\"/>";
													break;
												default:
													print "&nbsp;";
													break;
											}
											?>


										</td>
										<td style="background-color:<?php echo  $color ?>" align="left">
											<?php echo  substr($array['txt_vendedor'], 0, 3) ?>
										</td>

										<td style="background-color:<?php echo  $color ?>" align="center">
											<a href="frm_reservas.php?id=<?php print $array['pk_reserva'] ?>" title="Haga click para ver el detalle del contacto">
												<img src="images/icons/ico_preview.gif" width="17" height="16" border="0" /> </a>
										</td>
									</tr>
							<?php
									$cint++;
								}
							} //else
							?>

						</tbody>
					</table>
				</form>
			</div>

		</div>
		<div style="clear:both;"></div>
	</div> <!-- End .grid_5 -->

	<div style="clear:both;"></div>

</div>
<!--  Footer  -->
<?php
require_once("footer.php");
?>