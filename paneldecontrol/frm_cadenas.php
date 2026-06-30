<?php
require_once("header.php");
?>
<?php
$Iscadena = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_cadena = new cls_tbl_cadena($Iscadena);

$IsActionG = "";
if($do=='create') {

if($Iscadena>0 && !$cls_cadena->IsExistCadena())
$Iscadena = 0 ;

$IsActionG = 1;

}else{
if($cls_cadena->IsExistCadena())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Cadena de Hoteles";
else
$MessageForm = "Crear Cadena de Hoteles";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_cadena';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_cadena.php';
</script>

<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL?>admin/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar.js"  charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL?>admin/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL?>admin/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<script type="text/javascript" src="<?php print _URL?>admin/js/jquery.MultiFile.js" ></script>

<div class="container_16">
	<div class="grid_10">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">
		
<form method="post" enctype="multipart/form-data" name="frm_cadena" id="frm_cadena" >

 <div>
		<span class="notification n-success">Registros Obligatorios.</span>
</div>
			
 <p>
	<label>Nombre de Cadena de Hoteles:</label>
	 <input type="text" id="get_txtnombre" name="get_txtnombre" title="Por favor ingrese el nombre" value="<?php echo $cls_cadena->gettxt_nombre()?>" class="input-medium" /> 
	<span id="msg_descripcion" class="notification-input ni-correct"></span>
</p>

 <p>
	<label>Imagen:</label>
	<input name="fileup_cadena" id="fileup_cadena" type="file" title="Ingrese la Imagen" class="MultiFile input-medium" size="50" accept="jpeg|jpg" />
	<input type="hidden" name="h_thumbcadena" id="h_thumbcadena" value="<?php print $cls_cadena->gettxt_imagen();?>"/>
	<span id="msg_imagen" class="notification-input ni-correct"></span>
</p>
		
		
<p>
	<label>Fecha:</label>
	 <input name="getdate_creacion" title="por favor ingrese la fecha" type="text" class="input-short" id="getdate_creacion" value="<?php
        if(tep_not_null($cls_cadena->gettxt_creacion()) && $cls_cadena->gettxt_creacion()!='0000-00-00')
		echo Date::convert($cls_cadena->gettxt_creacion(),'Y-m-d','d-m-Y');?>" size="20" maxlength="10" />
        <img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />(dia/mes/año)
	<span id="msg_datecreacion" class="notification-input ni-correct"></span>
</p>	


	 <fieldset>
		<legend>Publicar:</legend>
		<ul>
			<li><label>
			 <input name="chkcadena" type="checkbox" id="chkcadena" value="1"  <?php echo ($cls_cadena->gettxt_status()==1)?'checked':''?>/>
			 <input type="hidden" name="id" id="id"  value="<?php print $Iscadena?>"/>
			</label>
			</li>
		</ul>
	</fieldset>		
	
	<fieldset>

		
		<?php if($IsActionG==0) { ?>
          <input type="Button" value="Actualizar Ubicacion"  class='submit-green' id="btn_save"/>
        <?php 	}
		else{?>
        <input type="Button" value="Guardar Ubicacion" class='submit-green' id="btn_save"/>
         <?php }?>
        &nbsp;&nbsp;
        <input type="Button" value="Regresar" onclick="javascript:window.location='inf_cadena.php'" class='submit-gray' />  
		
		
	</fieldset>		

</form>
</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<script  language="javascript" type="text/javascript" src="js/jform_cadenas.js"></script>

<script language="javascript" type="text/javascript">
$(function(){ 
$('#file_cadena').MultiFile({ 
accept:'jpg|jpeg', max:1, STRING: { 
remove:'Quitar', 
selected:'Selecionado: $file', 
denied:'Tipo de archivo no válido: $ext!', 
duplicate:'Archivo ya seleccionado:\n$file!' 
} 
}); 
});
</script>
<script language="javascript" type="text/javascript">

/*  CALENDAR  */
var cal = new Zapatec.Calendar.setup({
		
inputField     :    "getdate_creacion",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>
<?php
require_once("footer.php");
?>