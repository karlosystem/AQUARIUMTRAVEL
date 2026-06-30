<?php
require_once("header.php");
?>
<?php
$CId = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify
$cls_contact = new cls_tbl_contacto($CId);

$IsActionG = "";
if($do=='create') {

if($CId>0 && !$cls_contact->IsExistReserva())
$IsReserva = 0 ;

$IsActionG = 1;

}else{
if($cls_contact->IsExistReserva())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Formulario de Contactenos";
else
$MessageForm = "Crear Formulario de Contactenos";

?>

<script language="javascript" type="text/javascript" >
var MyForm = 'frm_contactenos';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_contactos.php';
</script>



<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL?>admin/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar.js"  charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL?>admin/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL?>admin/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<div class="container_16">
	<div class="grid_10">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">
		<form method="post"  name="frm_contactenos" id="frm_contactenos" >			
			 <p>
			 <label>Nombre:</label>
			 <input type="text" id="get_txtnombres" name="get_txtnombres" title="Su nombre" value="<?php echo $cls_contact->gettxt_nombres()?>" class="input-medium" />
			</p>
			
			
			 <p>
				<label>E-mail:</label>
				<input type="text" id="get_txtemail" name="get_txtemail" title="Su email" value="<?php echo $cls_contact->gettxt_email()?>" class="input-medium" />
			</p>
			
			 <p>
				<label>Tel&eacute;fono/Celular:</label>
				<input type="text" id="get_txttelefono" name="get_txttelefono" title="Su telefono" value="<?php echo $cls_contact->gettxt_telefono()?>" class="input-medium" />
			</p>
			
			 <p>
				<label>Pais:</label>
				<input type="text" id="get_txtpais" name="get_txtpais" title="Su Pais" value="<?php echo $cls_contact->gettxt_pais()?>" class="input-short" />
			</p>
			
			
			<p>
				<label>Comentario:</label>
				<textarea name="txt_mensaje" class="input-medium" id="txt_mensaje" cols="60" rows="10" title="Ingrese el mensaje"><?php echo $cls_contact->gettxt_mensaje()?></textarea>
			</p>
			
			 <p>
				<label>Fecha de registro:</label>
				<?php print $cls_contact->getdate_fecha();?>				
				<input name="txt_date" type="hidden" title="ingrese" class="Field120" id="txt_date" value="<?php print $cls_contact->getdate_fecha();?>" />
			</p>

			<h1>Datos de la Agencia</h1>
			
			
			<p>
				<label>Counter:</label>
				<select name="get_vendedor" id="get_vendedor" title="Seleccione al vendedor" class="input-short">
				 <option value=""> Seleccione</option>
				 <option value="Elisabel"   <?php echo $select=($cls_contact->gettxt_vendedor()=="Elisabel")?"selected":"";?>>Elisabel</option>
                 <option value="Counter01"   <?php echo $select=($cls_contact->gettxt_vendedor()=="Counter01")?"selected":"";?>>Counter01</option>
                 
                 <option value="Counter02"   <?php echo $select=($cls_contact->gettxt_vendedor()=="Counter02")?"selected":"";?>>Counter02</option>
				</select>
				<span style="color:#FF0000" id="msg_vendedor"></span>
			</p>
			
			
			<p>
				<label>Estado:</label>
				<select name="getfk_estado" class="input-short" id="getfk_estado" title="Seleccione el estado">
					<option value="">Seleccione</option>
          			<?php print cls_tbl_estado::ListaEstado($cls_contact->getfk_estado());?>
				</select>
				<input type="hidden" name="id" id="id"  value="<?php print $CId?>"/>
				<span style="color:#FF0000" id="msg_estado"></span> 
			</p>
			
			 <p>
				<label>Comentario:</label>
				<textarea name="txt_nota" class="input-medium" id="txt_nota" cols="60" rows="10" title="Ingrese la nota"><?php echo $cls_contact->gettxt_nota()?></textarea>
				<span style="color:#FF0000" id="msg_nota"></span> 
			 </p>
			 
			  <fieldset>



		
		  <?php if($IsActionG==0) { ?>
          <input type="Button" value="Actualizar Formulario"  class='submit-green' id="btn_save"/>
        <?php 	}
		else{?>
        <input type="Button" value="Guardar Formulario" class='submit-green' id="btn_save"/>
         <?php }?>
        &nbsp;&nbsp;
        <input type="Button" value="Regresar" onclick="javascript:window.location='inf_contacto.php'" class='submit-gray' /> 
		
			</fieldset>

</form>
	</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>
<!--  Footer  -->
<script  language="javascript" type="text/javascript" src="js/jform_contactenos.js"></script>
<?php
require_once("footer.php");
?>