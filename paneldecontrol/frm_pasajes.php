<?php
require_once("header.php");
?>
<?php
$IsPasaje = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_pasaje = new cls_tbl_pasajes($IsPasaje);

$IsActionG = "";
if($do=='create') {

if($IsPasaje>0 && !$cls_pasaje->IsExistPasaje())
$IsPasaje = 0 ;

$IsActionG = 1;

}else{
if($cls_pasaje->IsExistPasaje())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Boleto Aereo";
else
$MessageForm = "Crear Boleto Aereo";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_pasaje';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_pasajes.php';
</script>

<script type="text/javascript" src="js/jquery.jqEasyCharCounter.min.js"></script>

<script type="text/javascript">
var $bb = jQuery.noConflict();
	$bb(document).ready(function(){
		$bb('#get_metadescription').jqEasyCounter({
			'maxChars': 156,
			'maxCharsWarning': 156
		});
});
</script>

<script type="text/javascript">
var $mm = jQuery.noConflict();
	$mm(document).ready(function(){
		$mm('#get_metatitle').jqEasyCounter({
			'maxChars': 69,
			'maxCharsWarning': 69
		});
});
</script>


<script type="text/javascript" src="../include/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="../include/colorpicker/js/eye.js"></script>
<script type="text/javascript" src="../include/colorpicker/js/utils.js"></script>
<script type="text/javascript" src="../include/colorpicker/js/layout.js?ver=1.0.2"></script>
<link rel="stylesheet" href="../include/colorpicker/css/colorpicker.css" type="text/css" />

<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL?>paneldecontrol/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL?>paneldecontrol/calendar_picker/calendar.js"  charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL?>paneldecontrol/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL?>paneldecontrol/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL?>paneldecontrol/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<div class="container_16">
	<div class="grid_10">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">
        


<form method="post" enctype="multipart/form-data" name="frm_pasaje" id="frm_pasaje" >
<div>
		<span class="notification n-success">Registros Obligatorios.</span>
</div>

<?php
for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
$data_title = $cls_pasaje->get_pasajes_detalles($IsPasaje,$languages[$i]['id']);
?>

<p>
<label>
<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
<?php if ($i == 0) print 'Destino'." :"; ?></label>
<?php print tep_draw_input_field('get_titlepasaje[' . $languages[$i]['id'] . ']',$data_title[0]['destino'],'class="input-medium"',TRUE);?> 
	<span id="msg_descripcion" class="notification-input ni-correct"></span>
</p>

<?php
  }
?>


<?php
for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
$data_detalle = $cls_pasaje->get_pasajes_detalles($IsPasaje,$languages[$i]['id']);
?>
<p>
	<label>
	<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
	<?php if ($i == 0) print 'Detalle del Pasaje: '." :"; ?>&nbsp;</label>
	<?php
	$oFCKeditor = new FCKeditor('get_detallepasaje[' . $languages[$i]['id'] . ']') ;
	$oFCKeditor->BasePath = '../adapter/fckeditor/';
	$oFCKeditor->ToolbarSet = 'ISC_NOTICE' ;
	$oFCKeditor->Value = $data_detalle[0]['detalle'];
	$oFCKeditor->Config['SkinPath'] = _URL."/adapter/fckeditor/editor/skins/silver/";
	$oFCKeditor->Height = 250;
	$oFCKeditor->Width =  620;
	$oFCKeditor->Create() ;
 ?>
</p>
<?php
  }
?>

 <p>
      <label>Meta Titulo:</label>
      <input name="get_metatitle" type="text"  class="input-long" id="get_metatitle" value="<?php echo ($IsActionG==0)?$cls_pasaje->gettxt_metatitle():'';?>" title="Ingrese el meta title"/>
    
</p>

 <p>
      <label>Meta Description:</label>
      <textarea rows="4" cols="40" class="input-long" id="get_metadescription" name="get_metadescription"><?php echo ($IsActionG==0)?$cls_pasaje->gettxt_metadescription():'';?></textarea>
    
</p>

<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
	$data_title = $cls_pasaje->get_pasajes_detalles($IsPasaje,$languages[$i]['id']);
?>
<p>
<label>
<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
<?php if ($i == 0) print 'Precio'." :"; ?></label>
<?php print tep_draw_input_field('get_preciopasaje[' . $languages[$i]['id'] . ']',$data_title[0]['precio'],'class="input-short"',TRUE);?> 

</p>

<?php
  }
?>


<?php
for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
$data_title = $cls_pasaje->get_pasajes_detalles($IsPasaje,$languages[$i]['id']);
?>
<p>
<label>
<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
<?php if ($i == 0) print 'Incluye'." :"; ?></label>
</label>
 <?php print tep_draw_input_field('get_incluyepasaje[' . $languages[$i]['id'] . ']',$data_title[0]['incluye'],'class="input-medium"',TRUE);?> 
 
</p>
<?php
  }
?>

<p>
		<label>Cobertura:</label>
		 <select name="get_cobertura"  class="input-short" id="get_cobertura" title="Seleccione la cobertura">
         <option value=""> Seleccione</option>       
		 <option value="Nacional"   <?php echo $select=($cls_pasaje->gettxt_cobertura()=="Nacional")?"selected":"";?>>Nacional</option>
		 <option value="Internacional"   <?php echo $select=($cls_pasaje->gettxt_cobertura()=="Internacional")?"selected":"";?>>Internacional</option>
        </select>
</p>

<p>
<label>Fecha de Publicaci&oacute;n:</label>
 <input name="get_datepasaje" type="text" class="input-short" id="get_datepasaje" value="<?php echo $cls_pasaje->getdate_pasaje()?>" size="11" maxlength="10" readonly="true" title="Ingrese una fecha para su Publicacion" />
          <img src="calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />
          <span class="required">*</span>
          <span id="msg_datepasaje"></span> 
</p>

<p>
<label>Imagen de Referencia</label>
<input name="file_pasaje" type="file" class="input-medium" id="file_pasaje" size="40" title="Extensiones permitidas: .jpg |.jpeg" />
        <input type="hidden" name="hidden_pasaje" id="hidden_pasaje" value="<?php print $cls_pasaje->gettxt_imagen()?>" />
        <span id="msg_fileupload"></span>
</p>

<p>
<label>Publicar:</label>
 <input name="chk_publicpasaje" type="checkbox" id="chk_publicpasaje" value="1" <?php print ($cls_pasaje->gettxt_status()==1)?'checked':'';?>/>
        <input type="hidden" name="id" id="id"  value="<?php print $IsPasaje?>"/> 
</p>

<fieldset>
	<?php if($IsActionG==0) { ?>
	  <input type="Button" value="Actualizar"  class='submit-green' id="btn_save"/>
	<?php 	}
	else{?>
	<input type="Button" value="Guardar" class='submit-green' id="btn_save"/>
	 <?php }?>
	&nbsp;&nbsp;
	<input type="Button" value="Regresar" onclick="javascript:window.location='inf_pasajes.php'" class='submit-gray' />  
</fieldset>

</form>

</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<script  language="javascript" type="text/javascript" src="js/jform_pasajes.js"></script>
<script language="javascript" type="text/javascript">

/*  CALENDAR  */
var cal = new Zapatec.Calendar.setup({
		
inputField     :    "get_datepasaje",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>



<?php
require_once("footer.php");
?>