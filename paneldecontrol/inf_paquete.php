<?php
require_once("header.php");
?>

<script language="javascript">
	var MyForm = 'frmpaquete';
	var urlProcess = 'proc_paquete.php';
	var IsRowSlow = 'rowpaquete_';

	function ActualizarTipoCambioDolares() {
		var entrar = confirm("¿Esta seguro de actualizar el tipo de cambio del dia?")
		if (entrar) {
			var TipoCambio2 = document.getElementById('tipoCambio2').value;
			document.frmpaquete.action = "proc_paquete.php?tipoCambio2=" + TipoCambio2 + "&op=11";
			document.frmpaquete.submit();
		}
	}
</script>
<?php
$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
$page = $_GET['page'];

if (empty($page) || !is_numeric($page) || $page < 0)
	$page = 1;

$limit = 30;

$total_itemsprod = count_entries('paquete', '', '', '');

$total_pages = ceil($total_itemsprod / $limit);
$set_limit = $page * $limit - ($limit);
if ($total_itemsprod - $set_limit == 1)
	$page--;

if ($_GET['Buscar']) {
	$sqlBuscar = "";
	if ($_GET['sle_categoria']) $sqlBuscar .= " AND fk_categoria='" . $_GET['sle_categoria'] . "'";
}

$SQL = "SELECT DISTINCT(pk_paquete), txt_datepaquete, fk_categoria, txt_youtube, int_status, txt_dateadd, txt_dateupdate, txt_date_from, txt_date_to, int_dias, int_noches, txt_precio, int_ishome, [|PREFIX|]paquete_details.txt_pdf, fk_destino, txt_precio_soles, int_isdestacado, LENGTH(txt_meta_description) as caracteres, int_visto FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete WHERE int_status = 1 AND [|PREFIX|]paquete.pk_paquete <> '' " . $sqlBuscar . " ORDER BY  int_status DESC, pk_paquete DESC LIMIT $set_limit,$limit";

/*$SQL = "SELECT DISTINCT(pk_paquete), txt_datepaquete, fk_categoria, txt_youtube, int_status, txt_dateadd, txt_dateupdate, txt_date_from, txt_date_to, int_dias, int_noches, txt_precio, int_ishome, [|PREFIX|]paquete_details.txt_pdf, fk_destino, txt_precio_soles, int_isdestacado, LENGTH(txt_meta_description) as caracteres FROM [|PREFIX|]paquete LEFT JOIN [|PREFIX|]paquete_details ON [|PREFIX|]paquete.pk_paquete = [|PREFIX|]paquete_details.fk_paquete WHERE [|PREFIX|]paquete.pk_paquete <> '' ".$sqlBuscar." ORDER BY  int_status DESC, pk_paquete DESC LIMIT $set_limit,$limit";*/

$paquete = new cls_tbl_paquete();
$resultado = $paquete->lista($SQL);
$contador = $set_limit;
$sw = 0;

$numFilas =  count($resultado);
?>


<div class="container_12">
	<div style="clear: both"></div>
	<div class="bottom-spacing">
		<!-- Button -->
		<div class="float-right">
			<a href="frm_paquete.php?do=create" class="button">
				<span>Nuevo Paquete<img src="images/plus-small.gif" width="12" height="9" alt="Nuevo Paquete" /></span>
			</a>&nbsp;&nbsp;
			Tipo Cambio del dia: S/. :
			<input type="text" id="tipoCambio2" name="tipoCambio2" class="input-short" value="<?php echo _TIPOCAMBIO_DOL ?>" />
			<input type="Button" value="Actualizar" class='submit-green' onclick="ActualizarTipoCambioDolares()" name="Actualizar" id="Actualizar" />



		</div>

		<form id="frm_buscar" name="frm_buscar" action="inf_paquete.php" method="get">
			Categoria
			<select name="sle_categoria" class="input-short" id="sle_categoria" title="Seleccione una categoría">
				<option value="0"> Seleccione una categoria</option>
				<?php
				$cls_categoria = new cls_tbl_categoria();
				$cls_paquete = new cls_tbl_paquete();
				print $cls_categoria->getCategory_Mnu($cls_paquete->getfk_categoria());
				?>
			</select>

			<input type="submit" value="Buscar" class='submit-green' name="Buscar" id="Buscar" />
		</form>





	</div>

	<div class="module">
		<h2><span>Gesti&oacute;n de Paquetes | Total de registros: <?php print $total_itemsprod ?></span></h2>
		<div class="module-table-body">
			<form action="" method="POST" name="frmpaquete" id="frmpaquete">
				<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
					<thead>
						<tr>
							<th width="4%" height="25" align="center"> <input name="chkallregister" type="checkbox" onclick="checkAll(this)" />
							</th>
							<th width="3%">#</th>
							<th width="37%">PAQUETE TURÍSTICO</th>
							<th width="7%">PRECIO $</th>
							<th width="7%">PRECIO S/.</th>
							<th width="4%">FORMS</th>
							<th width="5%">DESTINO</th>
							<th width="4%">VIDEO</th>
							<th width="9%">REGISTRO</th>
							<th width="9%">FOTO</th>
							<th width="9%">VISTO</th>
							<th width="5%">PUBLICAR</th>
							<th width="6%">OPCIONES </th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($numFilas == 0) {
						?>
							<tr bgcolor="#FFFFFF" height="30">
								<td colspan="12" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">No hay resultado de paquetes turísticos</td>
							</tr>
							<?php } // if
						else {

							$cint = 1;
							foreach ($resultado  as $array) {
								//$color = inc_color($sw); 
								$color = ($cint % 2 == 0) ? '#FEFEFE' : '#F7F7F7';
								$icono = "ico_estado" . $array['int_status'] . ".gif";
								$destacado = $array['int_isdestacado'];

								$language_id = $languages[0]['id'];
								$details_paquete = cls_tbl_paquete::get_paquete_detail($array['pk_paquete'], $language_id);
								$title_paquete = secure_sql($details_paquete[0]['title']);

								$language_dir = "espanol";
								$folder_complete = DIR_WS_LANGUAGES . $language_dir . '/' . _PAQUETES;
								$ImgPaq = $details_paquete[0]['image'];

								$cls_categoria_nombre = new cls_tbl_categoria($array['fk_categoria']);
								$categoria = $cls_categoria_nombre->gettxt_nombre();

								if ($ImgPaq == '' || !file_exists($folder_complete . $ImgPaq))
									$img_thumb = base64_encode($folder_complete . $ImgPaq);
								else
									$img_thumb = base64_encode($folder_complete . $ImgPaq);

							?>
								<tr style="background-color:<?php print $color ?>" id="rowpaquete_<?php print $array['pk_paquete'] ?>">
									<td align="center" valign="middle" style="background-color:<?php print $color ?>; vertical-align:middle;" class="td_list">
										<?php print $array['caracteres'] ?><br />
										<input name="chkpaquete[]" type="checkbox" value="<?php print $array['pk_paquete'] ?>" id="chkpaquete[]" />
									</td>
									<td height="20" align="center" valign="middle" style="background-color:<?php print $color ?>;" class="tdrows">
										<?php
										print $cint;
										?>
									</td>

									<td height="20" align="left" valign="middle" style="background-color:<?php print $color ?>;" class="tdrows">
										<a target="_blank" href="../paquete_detalle.php?pid=<?php print $array['pk_paquete']; ?>">
											<?php echo  $title_paquete; ?>
										</a>

										<?php
										if ($array['int_isdestacado'] == 1) {
											print "<img src=\"images/notification-tick.gif\" align=\"middle\" title=\"Paquete en Portada\" />";
										}
										?>
										<br />
										<?php echo  $categoria; ?>
										<br />
										<strong>Ultima Actualizaci&oacute;n: <?php echo Date::convert($array['txt_dateupdate'], 'Y-m-d', 'd-m-Y') ?></strong>
									</td>

									<td height="20" align="left" valign="middle" style="background-color:<?php print $color ?>;" class="tdrows"><span class="tdrows" style="background-color:<?php print $color ?>;"><?php echo  $array['txt_precio'] ?></span> </td>
									<td height="20" align="left" valign="middle" style="background-color:<?php print $color ?>;" class="tdrows"><span class="tdrows" style="background-color:<?php print $color ?>;"><?php echo  $array['txt_precio_soles'] ?></span> </td>
									<td align="center" valign="middle" style="background-color: #e6eeee; font-weight:bold;" class="tdrows">
										<?php
										$paquetecls_create = new cls_tbl_paquete($array['pk_paquete']);
										$countimg = (int)$paquetecls_create->countgallerypaquetes_list();
										print $countimg;
										?>
									</td>
									<td align="center" valign="middle" style="background-color:<?php print $color ?>;padding:0;" class="tdrows"><?php print $array['fk_destino']; ?>
									</td>
									<td align="center" valign="middle" style="background-color:<?php print $color ?>;padding:0;" class="tdrows"><?php print (tep_not_null($array['txt_youtube'])) ? "<img src=\"images/icons/ico_youtube.gif\" />" : "&nbsp;"; ?> </td>
									<td align="center" valign="middle" style="background-color:<?php print $color ?>;padding:0;" class="tdrows">
										<?php echo Date::convert($array['txt_datepaquete'], 'Y-m-d', 'd-m-Y') ?>
									</td>
									<td height="20" align="center" valign="middle" style="background-color:<?php print $color ?>" class="tdrows"><?php print tep_image(_URL . 'resize.php?image=' . $img_thumb . '&w=95&h=70&IsCrop=0', $Title, '', '', 'class="imagen_cuadro"'); ?> </td>

									<td height="20" align="center" valign="middle" style="background-color:<?php print $color ?>;" class="tdrows"><span class="tdrows" style="background-color:<?php print $color ?>;"><?php echo  $array['int_visto'] ?></span> </td>

									<td height="20" align="center" valign="middle" style="background-color:<?php print $color ?>;" class="tdrows" id="idEstado<?php print $array['pk_paquete'] ?>"><a href="javascript:UpdateStatus(<?php echo  $array['pk_paquete'] ?>)"> <img src="images/icons/<?php echo  $icono ?>" border="0" /> </a> </td>
									<td height="20" align="center" valign="middle" style="background-color:<?php print $color ?>;" class="tdrows"><a href="upload_imgprod.php?id=<?php echo $array['pk_paquete'] ?>" title="Haga click para añadir imagenes al paquete"> <img src="images/icons/icon_upload.gif" width="16" height="16" border="0" /></a> <a href="frm_paquete.php?id=<?php print $array['pk_paquete'] ?>" title="Haga click para actualizar la información del paquete"> <img src="images/icons/ico_edit.gif" width="16" height="16" border="0" /> </a> <a href="javascript:eliminar(<?php print $array['pk_paquete'] ?>,'<?php print $title_paquete ?>');" title="Haga click para remover el paquete"> <img src="images/icons/ico_remove.gif" width="16" height="16" border="0" /> </a> </td>
								</tr>
						<?php
								$cint++;
							}
						} //else
						?>
					</tbody>
				</table>
			</form>

			<?php
			#Paginacion

			$filename = basename($_SERVER['PHP_SELF']);
			$pagination = '';

			if ($total_itemsprod - $set_limit == 1)
				$page++;
			$pagination = generate_smart_pagination($page, $total_itemsprod, $limit, 1, $filename, $params_pag);
			if (tep_not_null($pagination)) {
				echo "<div id=\"pagination\">";
				echo $pagination;
				echo "</div>";
			}
			?>
			<div style="clear:both;"></div>
			<br />
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