<?php
require_once("header.php");
?>
<?php
$IsDepartamento = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_departamento = new cls_tbl_departamento($IsDepartamento);

$IsActionG = "";
if($do=='create') {

if($IsDepartamento>0 && !$cls_departamento->IsExistDepartamento())
$IsDepartamento = 0 ;

$IsActionG = 1;

}else{
if($cls_departamento->IsExistDepartamento())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Ubicacion";
else
$MessageForm = "Crear Ubicacion";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_departamento';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_departamento.php';
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
            <!-- Account overview -->
            <div class="grid_10">
                <div class="module">
                        <h2><span><?php print $MessageForm ;?></span></h2>
                        
                        <div class="module-body">
                        <form method="post" enctype="multipart/form-data" name="frm_departamento" id="frm_departamento" >
						
                        	 <p>
                                <label>Ubicacion:</label>
								
								<input type="text" id="get_txtubicacion" name="get_txtubicacion" title="Por favor ingrese la ubicacion del hotel" value="<?php echo $cls_departamento->gettxt_descripcion()?>" class="input-medium" />
                                <span id="msg_descripcion" class="notification-input ni-correct"></span>
                            </p>
							
							
							<p>
								<label>Pais</label>
								<select name="sle_pais" class="input-medium" id="sle_pais" title="Seleccione el pais">
									  <option value=""> Seleccione el Pais</option>
									  <?php print cls_tbl_departamento::ListaPaises($cls_departamento->getfk_pais());?>
									</select>
								<span id="msg_destino" class="notification-input ni-correct"></span>
							</p>
							
							 <p>
                                <label>Imagen:</label>
								<input name="fileup_departamento" id="fileup_departamento" type="file" class="MultiFile input-medium" accept="jpeg|jpg" />
								<input type="hidden" name="h_thumbdepartamento" id="h_thumbdepartamento" value="<?php print $cls_departamento->gettxt_imagen();?>"/>
                                <span class="notification-input ni-correct"></span>
                            </p>
							
							 <p>
                                <label>Fecha de Agregado:</label>
								<input name="getdate_creacion" title="por favor ingrese la fecha" type="text" class="input-short" id="getdate_creacion" value="<?php
        if(tep_not_null($cls_departamento->gettxt_creacion()) && $cls_departamento->gettxt_creacion()!='0000-00-00')
		echo Date::convert($cls_departamento->gettxt_creacion(),'Y-m-d','d-m-Y');?>" />
								<img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />(dia/mes/año)
                                <span id="msg_datecreacion" class="notification-input ni-correct"></span>
                            </p>
							
							 <fieldset>
                                <legend>Publicar:</legend>
                                <ul>
                                    <li><label>
									<input name="chkdepartamento" type="checkbox" id="chkdepartamento" value="1"  <?php echo ($cls_departamento->gettxt_status()==1)?'checked':''?>/>
									<input type="hidden" name="id" id="id"  value="<?php print $IsDepartamento?>"/>
									</label></li>
   
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
								<input type="Button" value="Regresar" onclick="javascript:window.location='inf_departamentos.php'" class='submit-gray' />
                            </fieldset>
                        </form>	
                        </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>
<script  language="javascript" type="text/javascript" src="js/jform_departamento.js"></script>
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