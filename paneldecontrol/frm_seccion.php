<?php
require_once("header.php");
?>
<?php
$IsSeccion = (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id']; # Action | Create
$do = (tep_not_null($_GET['do']))?$_GET['do']:$_POST['do']; # Action | Modify

$cls_seccion = new cls_tbl_seccion($IsSeccion);

$IsActionG = "";
if($do=='create') {

if($IsSeccion>0 && !$cls_seccion->IsExistSeccion())
$IsSeccion = 0 ;

$IsActionG = 1;

}else{
if($cls_seccion->IsExistSeccion())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Sección";
else
$MessageForm = "Crear Sección";
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_seccion';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_seccion.php';
</script>


<!--  Autocomeplete  -->
<script type='text/javascript' src='js/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='js/thickbox-compressed.js'></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />


<div class="container_16">
	<div style="clear:both;"></div>
	<div class="grid_12">
		 <div class="module">
		 	<h2><span><?php print $MessageForm ;?></span></h2>
				<div class="module-body">
				
<form method="post" name="frm_seccion" id="frm_seccion" >
	<div>
		   <span class="notification n-success">Campos Obligatorios.</span>
    </div>
	
	
	 <p>
	<label>Titulo de la sección</label>
	<input type="text" value="<?php echo $cls_seccion->gettxt_nombre();?>" class="input-short"  id="txt_title" name="txt_title" title="Ingrese el nombre del banner">
	<span id="msg_seccion" class="notification-input ni-correct"></span>
     </p>		
	 
	 <p>
	<label>Url de la sección</label>
	<input type="text" value="<?php echo $cls_seccion->gettxt_url();?>" id="txt_url" class="input-long" name="txt_url" />
	<span id="msg_seccion" class="notification-input ni-correct"></span>
     </p>	
	 
	 <p>
	<label>Destino</label>
	<select name="txt_target" id="txt_target" class="input-short">
        <option value="_self"  <?php print ($cls_seccion->gettxt_destino()=="_self")?"selected":"";?>>Misma P&aacute;gina</option>
        <option value="_blank" <?php print ($cls_seccion->gettxt_destino()=="_blank")?"selected":"";?>>Nueva P&aacute;gina</option>
    </select>

     </p>	
	 
	  <p>
	<label>Orden sección</label>
	 <input type="text" value="<?php echo $cls_seccion->gettxt_orden();?>" id="txt_order" class="input-short" name="txt_order" title="Ingrese un orden de la seccion">
	<span id="msg_order" class="notification-input ni-correct"></span>
     </p>		
	 
	 
	 <fieldset>
		<legend>Publicar</legend>
		<ul>
			<li><label>
			<input name="chk_status" type="checkbox" id="chk_status" value="1" <?php print ($cls_seccion->getint_estado()==1)?'checked':'';?>/>
			 <input type="hidden" name="id" id="id"  value="<?php print $IsSeccion?>"/>
			</label></li>
		</ul>
	</fieldset>	
	
	
		<fieldset>
						
		<?php if($IsActionG==0) { ?>
		  <input type="Button" value="Actualizar Seccion"  class="submit-green" size="22"  id="btn_save"/>
		<?php 	}
		else{?>
		<input type="Button" value="Guardar Seccion" class="submit-green" size="22" id="btn_save"/>
		 <?php }?>
		&nbsp;&nbsp;
		<input type="Button" value="Regresar" onclick="javascript:window.location='inf_seccion.php'" class="submit-gray"/>
			
		</fieldset>

</form>
</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<script  language="javascript" type="text/javascript" src="js/jform_seccion.js"></script>
<?php
require_once("footer.php");
?>
