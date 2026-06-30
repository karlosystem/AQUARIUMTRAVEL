<?php
require_once("header.php");
?>
<?php
$IdPaquete = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify
$cls_hoteles = new cls_tbl_hoteles();
$cls_paquete = new cls_tbl_paquete($IdPaquete);

$IsActionG = "";
if ($do == 'create') {

	if ($IdPaquete > 0 && !$cls_paquete->IsExistPaquete())
		$IdPaquete = 0;

	$IsActionG = 1;
} else {
	if ($cls_paquete->IsExistPaquete())
		$IsActionG = 0;
	else
		$IsActionG = 1;
}

if ($IsActionG == 0)
	$MessageForm = "Actualizar Paquete Turistico";
else
	$MessageForm = "Crear Paquete Turistico";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();

?>

<script type="text/javascript" src="js/iselector.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript" src="js/jquery.jqEasyCharCounter.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#testinput').jqEasyCounter({
			'maxChars': 156,
			'maxCharsWarning': 156
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#testmeta').jqEasyCounter({
			'maxChars': 156,
			'maxCharsWarning': 156
		});
	});
</script>

<link href="css/iselector.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
	var MyForm = 'frm_paquete';
	var IsAction = '<?php print $IsActionG ?>';
	var urlProcess = 'proc_paquete.php';


	function filterNonNumeric(field) {
		var result = new String();
		var numbers = "0123456789";
		var chars = field.value.split(""); // create array 
		for (i = 0; i < chars.length; i++) {
			if (numbers.indexOf(chars[i]) != -1) result += chars[i];
		}
		if (field.value != result) field.value = result;
	}

	function FormatNumber(num) {
		if (isNaN(num)) {
			num = "0";
		}
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num * 100 + 0.50000000001);
		cents = num % 100;
		num = Math.floor(num / 100).toString();
		if (cents < 10) {
			cents = "0" + cents;
		}
		for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++) {
			num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
		}
		return (((sign) ? '' : '-') + num + '.' + cents);
	}

	function printFloat() {
		var myFloatNumber1 = document.getElementById('txt_precio');
		var myFloatNumber2 = document.getElementById('txt_tipo_cambio');
		document.getElementById('txt_precio_soles').value = FormatNumber((parseFloat(myFloatNumber1.value) * parseFloat(myFloatNumber2.value)))
	}
</script>

<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL ?>paneldecontrol/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL ?>paneldecontrol/calendar_picker/calendar.js"></script>
<script type="text/javascript" src="<?php print _URL ?>paneldecontrol/calendar_picker/calendar-es.js"></script>
<link href="<?php print _URL ?>paneldecontrol/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL ?>paneldecontrol/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<div class="container_12">
	<div style="clear:both;"></div>

	<form method="post" enctype="multipart/form-data" name="frm_paquete" id="frm_paquete">

		<div class="grid_6">
			<div class="module">
				<h2><span><?php print $MessageForm; ?></span></h2>
				<div class="module-body">
					<p>
						<label>Categoria del Paquete Turistico:</label>
						<select name="sle_category" class="input-medium" id="sle_category" title="Seleccione una categoría">
							<option value=""> Seleccione una categoria</option>
							<?php
							$cls_categoria = new cls_tbl_categoria();
							print $cls_categoria->getCategory_Mnu($cls_paquete->getfk_categoria());
							?>
						</select>
						<span id="msg_category" class="notification-input ni-correct"></span>
					</p>
					<p>
						<label>Destino del Paquete Turistico</label>
						<select name="sle_destino" class="input-medium" id="sle_destino" title="Seleccione el destino">
							<option value=""> Seleccione el destino</option>
							<?php print cls_tbl_destino::ListaDestinos($cls_paquete->getfk_destino()); ?>
						</select>
						<span id="msg_destino" class="notification-input ni-correct"></span>
					</p>

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_title = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label>
								<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
								<?php if ($i == 0) print 'Titulo del paquete turistico' . " :"; ?>&nbsp;</label>
							<?php print tep_draw_input_field('name_paquete[' . $languages[$i]['id'] . ']', $data_title[0]['title'], 'class="input-long" title="Ingrese el nombre del paquete"', TRUE); ?>
							<span id="msg_paquete" class="notification-input ni-correct"></span>
						</p>
					<?php
					}
					?>

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_presentacion = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label>
								<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
								<?php if ($i == 0) print 'Presentaci&oacute;n &oacute; Prologo del destino' . " :"; ?>&nbsp;</label>
							<?php
							$oFCKeditor = new FCKeditor('presentacion_paquete[' . $languages[$i]['id'] . ']');
							$oFCKeditor->BasePath = '../adapter/fckeditor/';
							$oFCKeditor->ToolbarSet = 'Basic';
							$oFCKeditor->Value = $data_presentacion[0]['presentacion'];
							$oFCKeditor->Config['SkinPath'] = _URL . "/adapter/fckeditor/editor/skins/silver/";
							$oFCKeditor->Height = 190;
							$oFCKeditor->Width =  450;
							$oFCKeditor->Create();
							?>
						</p>
					<?php
					}
					?>

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_incluye = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label><?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
								<?php if ($i == 0) print 'Que Incluye el paquete turistico' . " :"; ?>&nbsp;</label>
							<?php print tep_draw_input_field('incluye_paquete[' . $languages[$i]['id'] . ']', $data_incluye[0]['incluye'], 'class="input-long"', TRUE); ?>
						</p>
					<?php
					}
					?>


					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_content = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label>
								<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
								<?php if ($i == 0) print 'Detalle del paquete' . " :"; ?></label>

							<?php
							$ckeditor = new CKEditor();
							$ckeditor->basePath = '../adapter/ckeditor/';
							$ckeditor->config['filebrowserBrowseUrl'] = '/ckfinder/ckfinder.html';
							$ckeditor->config['height'] = 500;
							$ckeditor->config['filebrowserImageBrowseUrl'] = '/ckfinder/ckfinder.html?type=Images';
							$ckeditor->config['filebrowserFlashBrowseUrl'] = '/ckfinder/ckfinder.html?type=Flash';
							$ckeditor->config['filebrowserUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
							$ckeditor->config['filebrowserImageUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
							$ckeditor->editor('content_paquete[' . $languages[$i]['id'] . ']', $data_content[0]['description']);
							?>

						</p>
					<?php
					}
					?>

					<div class="grid_12">
						<div class="grid_4">
							<p>
								<label>Publicacion:</label>

								<input name="txt_datepublicacion" type="text" class="input-long" id="txt_datepublicacion" value="<?php
																																																									if (tep_not_null($cls_paquete->gettxt_datepaquete()) && $cls_paquete->gettxt_datepaquete() != '30/11/1999')
																																																										echo Date::convert($cls_paquete->gettxt_datepaquete(), 'Y-m-d', 'd-m-Y'); ?>" size="20" maxlength="10" />



								<img src="calendar_picker/calendar_edit.png" name="cal_detapublicacion" width="16" height="16" id="cal_detapublicacion" />
							</p>
						</div>
						<div class="grid_4">
							<p>
								<label>Viaje desde:</label>
								<input name="txt_desde" type="text" class="input-long" id="txt_desde" value="<?php
																																															if (tep_not_null($cls_paquete->gettxt_datefrom()) && $cls_paquete->gettxt_datefrom() != '30/11/1999')
																																																echo Date::convert($cls_paquete->gettxt_datefrom(), 'Y-m-d', 'd-m-Y'); ?>" size="20" maxlength="10" />



								<img src="calendar_picker/calendar_edit.png" name="cal_desde" width="16" height="16" id="cal_desde" />
							</p>
						</div>
						<div class="grid_4">
							<p>
								<label>Hasta:</label>
								<input name="txt_hasta" type="text" class="input-long" id="txt_hasta" value="<?php
																																															if (tep_not_null($cls_paquete->gettxt_dateto()) && $cls_paquete->gettxt_dateto() != '30/11/1999')
																																																echo Date::convert($cls_paquete->gettxt_dateto(), 'Y-m-d', 'd-m-Y'); ?>" size="20" maxlength="10" />



								<img src="calendar_picker/calendar_edit.png" name="cal_hasta" width="16" height="16" id="cal_hasta" />
							</p>
						</div>
					</div>
					<div class="clear"></div>

					<div class="grid_12">
						<div class="grid_4">
							<p>
								<label>Cantidad de Dias:</label>
								<input name="txt_dias" type="text" class="input-long" id="txt_dias" value="<?php print $cls_paquete->getint_countdias(); ?>" />
								<span class="notification-input ni-correct"></span>
							</p>
						</div>
						<div class="grid_4">
							<p>
								<label>Cantidad de Noches:</label>
								<input name="txt_noches" type="text" class="input-long" id="txt_noches" value="<?php print $cls_paquete->getint_countnoches(); ?>" />
								<span class="notification-input ni-correct"></span>
							</p>

						</div>
					</div>
					<div class="clear"></div>

					<div class="grid_12">
						<div class="grid_4">
							<?php
							for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
								$data_traslado = $cls_paquete->get_infolang_pack($languages[$i]['id']);
							?>
								<p>
									<label>
										<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
										<?php if ($i == 0) print 'Tipo de Traslado' . " :"; ?>&nbsp;</label>
									<?php print tep_draw_input_field('traslado_paquete[' . $languages[$i]['id'] . ']', $data_traslado[0]['traslate'], 'class="input-long"', FALSE); ?>
								</p>
							<?php
							}
							?>
						</div>
						<div class="grid_4">
							<?php
							for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
								$data_boleto = $cls_paquete->get_infolang_pack($languages[$i]['id']);
							?>
								<p>
									<label>
										<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
										<?php if ($i == 0) print 'Boleto Aereo' . " :"; ?>&nbsp;</label>

									<?php print tep_draw_input_field('boleto_paquete[' . $languages[$i]['id'] . ']', $data_boleto[0]['boleto'], 'class="input-long"', FALSE);
									?>
								</p>
							<?php
							}
							?>
						</div>
						<div class="grid_4">
							<p>
								<label>Aeropuerto de Salida:</label>
								<select name="sle_aeropuerto" class="input-long" id="sle_aeropuerto" title="Seleccione el aeropuerto">
									<option value="0"> Aeropuerto:</option>
									<?php print cls_tbl_aeropuerto::ListaAeropuertos($cls_paquete->getfk_aeropuerto()); ?>
								</select>
							</p>

						</div>
					</div>
					<div class="clear"></div>

					<div class="grid_12">
						<div class="grid_4">
							<p>
								<label>Precio en Dolares: </label>
								<input name="txt_precio" onkeyup="return printFloat();filterNonNumeric(this);" type="text" class="input-long" id="txt_precio" value="<?php print $cls_paquete->gettxt_precio(); ?>" />
							</p>

						</div>
						<div class="grid_4">
							<p>
								<label>Tipo de Cambio: </label>
								<input name="txt_tipo_cambio" type="text" class="input-long" id="txt_tipo_cambio" value="<?php echo ToMoney(_TIPOCAMBIO_DOL, false) ?>" />
							</p>
						</div>
						<div class="grid_4">
							<p>
								<label>Precio en Soles: </label>
								<input name="txt_precio_soles" onkeyup="return filterNonNumeric(this);" type="text" class="input-long" id="txt_precio_soles" value="<?php print $cls_paquete->gettxt_precio_soles(); ?>" />
							</p>
						</div>
					</div>
					<div class="clear"></div>

					<fieldset>
						<legend>Opciones:</legend>
						<ul>
							<li>
								<label><input type="checkbox" name="chk_destacado" id="chk_destacado" value="1" <?php print ($cls_paquete->gettxt_isdestacado() == 1) ? 'checked' : ''; ?> /> Paquete Destacado en Portada</label>
							</li>

							<li>
								<label><input type="checkbox" name="chk_nuevo" id="chk_nuevo" value="1" <?php print ($cls_paquete->gettxt_isnuevo() == 1) ? 'checked' : ''; ?> /> Paquete Nuevo en Pie</label>
							</li>

							<li><label><input type="checkbox" name="chk_home" id="chk_home" value="1" <?php print ($cls_paquete->gettxt_ishome() == 1) ? 'checked' : ''; ?> /> Promoci&oacute;nes en Inicio</label></li>

							<li><label> <input type="checkbox" name="chk_agotado" id="chk_agotado" value="1" <?php print ($cls_paquete->gettxt_isagotado() == 1) ? 'checked' : ''; ?> /> Paquete Agotado</label></li>

							<li><label><input name="chk_status" type="checkbox" id="chk_status" value="1" <?php print ($cls_paquete->getint_status() == 1) ? 'checked' : ''; ?> /> Paquete Disponible</label></li>

							<li><label><input name="chk_ultimos" type="checkbox" id="chk_ultimos" value="1" <?php print ($cls_paquete->gettxt_isultimos() == 1) ? 'checked' : ''; ?> /> Ultimos Espacios</label></li>

						</ul>
						<input type="hidden" name="id" id="id" value="<?php print $IdPaquete ?>" />
					</fieldset>


					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_files_hidden = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label><?php if ($i == 0) print 'Subir imagen del paquete turistico' . " :"; ?>&nbsp;</label>
							<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
							<?php print tep_draw_input_field('file_uppaquete[' . $languages[$i]['id'] . ']', '', 'class="input-medium"', FALSE, 'file'); ?>
							<?php print tep_draw_input_field('file_updpack_hidden[' . $languages[$i]['id'] . ']', $data_files_hidden[0]['image'], '', false, 'hidden'); ?>
							<span class="notification-input ni-correct"></span>
						</p>
					<?php
					}
					?>


					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_meta_title = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label><?php if ($i == 0) print 'Meta Titulo (Ingresar: 65 - 69 Caracteres)' . " :"; ?>&nbsp;</label>
							<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
							<?php print tep_draw_input_field('meta_title_paquete[' . $languages[$i]['id'] . ']', $data_meta_title[0]['meta_title'], 'id="testmeta" class="input-long"', FALSE); ?>
						</p>
					<?php
					}
					?>

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_meta_keyword = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label><?php if ($i == 0) print 'Meta Keyword' . " :"; ?>&nbsp;</label>
							<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
							<?php print tep_draw_input_field('meta_keyword_paquete[' . $languages[$i]['id'] . ']', $data_meta_keyword[0]['meta_keyword'], 'class="input-long"', TRUE); ?>
						</p>
					<?php
					}
					?>

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_meta_description = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label><?php if ($i == 0) print 'Meta Description (Ingresar: 156 Caracteres)' . " :"; ?>&nbsp;</label>
							<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;

							<textarea name="<?php print 'meta_description_paquete[' . $languages[$i]['id'] . ']'; ?>" id="testinput" cols="10" rows="4" class="input-long"><?php print $data_meta_description[0]['meta_description']; ?></textarea>

						</p>
					<?php
					}
					?>

					<div style="clear:both;"></div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>

		<div class="grid_6">
			<div class="module">
				<h2><span><?php print $MessageForm; ?></span></h2>
				<div class="module-body">

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_contenido = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label>
								<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
								<?php if ($i == 0) print 'Texto informativo del destino de viaje' . " :"; ?>&nbsp;</label>
							<?php
							$oFCKeditor = new FCKeditor('contenido_paquete[' . $languages[$i]['id'] . ']');
							$oFCKeditor->BasePath = '../adapter/fckeditor/';
							$oFCKeditor->ToolbarSet = 'ISC_NOTICE';
							$oFCKeditor->Value = $data_contenido[0]['contenido'];
							$oFCKeditor->Config['SkinPath'] = _URL . "/adapter/fckeditor/editor/skins/silver/";
							$oFCKeditor->Height = 450;
							$oFCKeditor->Width =  500;
							$oFCKeditor->Create();
							?>
						</p>
					<?php
					}
					?>

					<p>
						<label>Enlace YouTube:</label>
						<input name="txt_youtube_link" type="text" class="input-medium" id="txt_youtube_link" value="<?php print $cls_paquete->gettxt_youtube() ?>" />
						<span class="notification-input ni-correct"></span>
					</p>

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_content_youtube = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label>
								<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
								<?php if ($i == 0) print 'Descripcion del video' . " :"; ?>&nbsp;</label>
							<?php print tep_draw_input_field('contentyoutbe_paquete[' . $languages[$i]['id'] . ']', $data_content_youtube[0]['desc_youtube'], 'class="input-medium"', FALSE); ?>
						</p>

					<?php
					}
					?>

					<?php
					for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
						$data_files_pdf = $cls_paquete->get_infolang_pack($languages[$i]['id']);
					?>
						<p>
							<label>
								<?php if ($i == 0) print 'Subir archivo PDF del paquete turistico' . " :"; ?>&nbsp;</label>
							<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
							<?php print tep_draw_input_field('file_uppaquete_pdf[' . $languages[$i]['id'] . ']', '', 'class="input-medium"', FALSE, 'file'); ?>
							<?php print tep_draw_input_field('file_updpack_hidden_pdf[' . $languages[$i]['id'] . ']', $data_files_hidden[0]['pdf'], '', false, 'hidden'); ?>
							<span class="notification-input ni-correct"></span>
						</p>
					<?php
					}
					?>


					<p>
						<label>Seleccione los Hoteles:</label>
						<select id="hoteles_opt" name="hoteles_opt[]" class="Field600 ISSelectReplacement" multiple="multiple" style="height: 400px;">
							<?php
							print $cls_hoteles->listpaquetes_hoteles($cls_paquete->gettxt_bhoteles());
							?>
						</select>
					</p>

				</div>
			</div>
		</div>

		<div style="clear:both;"></div>

		<div class="grid_12">
			<fieldset>
				<?php if ($IsActionG == 0) { ?>
					<input type="Button" value="Actualizar Paquete" class='submit-green' id="btn_save" />
				<?php 	} else { ?>
					<input type="Button" value="Guardar Paquete" class='submit-green' id="btn_save" />
				<?php } ?>
				&nbsp;&nbsp;
				<input type="Button" value="Regresar" onclick="javascript:window.location='inf_paquete.php'" class='submit-gray' />
			</fieldset>
		</div>
		<div class="clear"></div>

	</form>
	<div style="clear:both;"></div>

</div>


<script type="text/javascript" language="javascript">
	/*  CALENDAR  */

	jQuery(function($) {
		$("#txt_datepublicacion").mask("99/99/9999", {
			placeholder: "0"
		});
		$("#txt_desde").mask("99/99/9999", {
			placeholder: "0"
		});
		$("#txt_hasta").mask("99/99/9999", {
			placeholder: "0"
		});
	});

	new Zapatec.Calendar.setup({
		inputField: "txt_datepublicacion",
		ifFormat: "%d/%m/%Y",
		button: "cal_detapublicacion",
		showsTime: false
	});
	new Zapatec.Calendar.setup({
		inputField: "txt_desde",
		ifFormat: "%d/%m/%Y",
		button: "cal_desde",
		showsTime: false
	});
	new Zapatec.Calendar.setup({
		inputField: "txt_hasta",
		ifFormat: "%d/%m/%Y",
		button: "cal_hasta",
		showsTime: false
	});
</script>

<script language="javascript" type="text/javascript" src="js/jform_paquete.js"></script>

<?php
require_once("footer.php");
?>