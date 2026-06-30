<?php
require_once("header.php");
?>
<?php
$Isdestino = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_destino = new cls_tbl_destino($Isdestino);

$IsActionG = "";
if($do=='create') {

if($Isdestino>0 && !$cls_destino->IsExistdestino())
$Isdestino = 0 ;

$IsActionG = 1;

}else{
if($cls_destino->IsExistdestino())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Destino";
else
$MessageForm = "Crear Destino";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_destino';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_destino.php';
</script>
<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL?>paneldecontrol/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL?>paneldecontrol/calendar_picker/calendar.js"  charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL?>paneldecontrol/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL?>paneldecontrol/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL?>paneldecontrol/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<script type="text/javascript" src="<?php print _URL?>paneldecontrol/js/jquery.MultiFile.js" ></script>

<div class="container_16">
	<div style="clear:both;"></div>
		<div class="grid_12">
			<div class="module">
				<h2><span><?php print $MessageForm ;?></span></h2>
					<div class="module-body">
					
					<form method="post" enctype="multipart/form-data" name="frm_destino" id="frm_destino" >
					 <div>
                                <span class="notification n-success">Registros Obligatorios </span>
                     </div>
					 
					 <p>
					<label>Destino:</label>
					<input type="text" id="get_txtnombre" name="get_txtnombre" title="Por favor ingrese el nombre del destino" value="<?php echo $cls_destino->gettxt_nombre()?>" class="input-medium" />
					<span id="msg_nombre" class="notification-input ni-correct"></span>
                    </p>
                    
                     <p>
					<label>MetaTitle:</label>
					<input type="text" id="get_txtmetatitle" name="get_txtmetatitle" title="Por favor ingrese el meta del destino" value="<?php echo $cls_destino->gettxt_metatitle()?>" class="input-long" />
					<span id="msg_metatitle" class="notification-input ni-correct"></span>
                    </p>
                    
                    <p>
					<label>MetaDescription:</label>
					<input type="text" id="get_txtmetadescription" name="get_txtmetadescription" title="Por favor ingrese el meta del destino" value="<?php echo $cls_destino->gettxt_metadescription()?>" class="input-long" />
					<span id="msg_metadescription" class="notification-input ni-correct"></span>
                    </p>
					
					<p>
						<label>Ubicacion:</label>
						<select name="sle_ubicacion" class="input-short" id="sle_ubicacion" title="Seleccione su ubicacion">
							<option value=""> Seleccione la ubicacion</option>
				  			<?php print cls_tbl_departamento::ListaDepartamentos($cls_destino->getfk_ubicacion());?>
						</select>
						<span id="msg_ubicacion" class="notification-input ni-correct"></span>
					</p>
					
					 <p>
						<label>Descripcion:</label>
						<?php
						/*$oFCKeditor = new FCKeditor('get_content') ;
						$oFCKeditor->BasePath = '../adapter/fckeditor/';
						$oFCKeditor->ToolbarSet = 'ISC_NOTICE' ;
						$oFCKeditor->Value = $cls_destino->gettxt_descripcion();
						$oFCKeditor->Config['SkinPath'] = _URL."/adapter/fckeditor/editor/skins/office2003/";
						$oFCKeditor->Height = 350;
						$oFCKeditor->Width =  550;
						$oFCKeditor->Create() ;*/
						
						$ckeditor = new CKEditor();
						$ckeditor->basePath = '/ckeditor/';
						$ckeditor->config['filebrowserBrowseUrl'] = '/ckfinder/ckfinder.html';
						$ckeditor->config['filebrowserImageBrowseUrl'] = '/ckfinder/ckfinder.html?type=Images';
						$ckeditor->config['filebrowserFlashBrowseUrl'] = '/ckfinder/ckfinder.html?type=Flash';
						$ckeditor->config['filebrowserUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
						$ckeditor->config['filebrowserImageUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
						$ckeditor->config['filebrowserFlashUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
						$ckeditor->editor('get_content', $cls_destino->gettxt_descripcion());

						?>
					</p>
					
					 <p>
						<label>Imagen:</label>
						<input name="fileup_destino" class="MultiFile input-medium" title="Ingrese la imagen" id="fileup_destino" type="file" accept="jpeg|jpg" />
						<input type="hidden" name="h_thumbdestino" id="h_thumbdestino" value="<?php print $cls_destino->gettxt_imagen();?>"/>
						<span id="msg_imagen" class="notification-input ni-correct"></span>
					</p>
					
					<p>
						<label>Fecha:</label>
						<input name="getdate_creacion" title="por favor ingrese la fecha" type="text" class="input-short" id="getdate_creacion" value="<?php
        if(tep_not_null($cls_destino->gettxt_creacion()) && $cls_destino->gettxt_creacion()!='0000-00-00')
		echo Date::convert($cls_destino->gettxt_creacion(),'Y-m-d','d-m-Y');?>"/>
						<img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />(dia/mes/año)
						<span id="msg_datecreacion" class="notification-input ni-correct"></span>
					</p>
                            
                    <fieldset>
						<legend>Publicar</legend>
						<ul>
							<li><label>
							 <input name="chkdestino" type="checkbox" id="chkdestino" value="1"  <?php echo ($cls_destino->gettxt_status()==1)?'checked':''?>/>      
							 <input type="hidden" name="id" id="id"  value="<?php print $Isdestino?>"/>
							</label></li>
						</ul>
					</fieldset>
					
					 <fieldset>
        
								
					 <?php if($IsActionG==0) { ?>
					  <input type="Button" value="Actualizar Destino"  class='submit-green' id="btn_save"/>
					<?php 	}
					else{?>
					<input type="Button" value="Guardar Destino" class='submit-green' id="btn_save"/>
					 <?php }?>
					&nbsp;&nbsp;
					<input type="Button" value="Regresar" onclick="javascript:window.location='inf_destino.php'" class='submit-gray' />
                      </fieldset>

</form>
		</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<script  language="javascript" type="text/javascript" src="js/jform_destino.js"></script>

<script language="javascript" type="text/javascript">
$(function(){ 
$('#file_destino').MultiFile({ 
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