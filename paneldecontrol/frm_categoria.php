<?php
require_once("header.php");

$IsParent = (int)$_GET['CParent']; # Parent Modify | Create
$do = SecureGet($_GET['do']); # Action Modify | Create

$cls_categoria = new cls_tbl_categoria($IsParent);


$IsActionG = "";
if($do=='create') {

if($IsParent>0 && !$cls_categoria->IsExistCategory())
$IsParent = 0 ;

$IsActionG = 1;

}else{
if($cls_categoria->IsExistCategory())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Categoría";
else
$MessageForm = "Crear Categoría";

?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_categoria';
var IsAction = '<?php echo $IsActionG?>';
var urlProcess = 'proc_categoria.php';
</script>

<script type="text/javascript" src="js/jquery.jqEasyCharCounter.min.js"></script>

<script type="text/javascript">
var $bb = jQuery.noConflict();
	$bb(document).ready(function(){
		$bb('#get_metacategory').jqEasyCounter({
			'maxChars': 156,
			'maxCharsWarning': 156
		});
});
</script>

<script type="text/javascript">
var $mm = jQuery.noConflict();
	$mm(document).ready(function(){
		$mm('#get_metatitlecategory').jqEasyCounter({
			'maxChars': 69,
			'maxCharsWarning': 69
		});
});
</script>

<div class="container_16">
	<div style="clear:both;"></div>
	
		<div class="grid_12">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">
		<form method="post"  name="frm_categoria" id="frm_categoria" enctype="multipart/form-data">
			<div>
				<span class="notification n-success">Registros Obligatorios</span>
			</div>
			
			 <p>
				<label>Título de la Categoría:</label>
				<input name="get_namecategory" type="text"  class="input-medium" id="get_namecategory" value="<?php echo ($IsActionG==0)?$cls_categoria->gettxt_nombre():'';?>" title="Ingrese el nombre de la categoría"/>
				<span id="msg_titlecat" class="notification-input ni-correct"></span>
			 </p>
			 
			 <p>
				<label>Presentacion de la categor&iacute;a:</label>
				<textarea class="input-medium" id="get_presentacioncategory" cols="60" rows="7" title="Ingrese la presentacion de la categoría" name="get_presentacioncategory"><?php echo ($IsActionG==0)?$cls_categoria->gettxt_descripcion():'';?></textarea>
				<span id="msg_presecat" class="notification-input ni-correct"></span>
			 </p>

			  <p>
				<label>Meta Títle de la Categoría:</label>
				<input name="get_metatitlecategory" type="text"  class="input-long" id="get_metatitlecategory" value="<?php echo ($IsActionG==0)?$cls_categoria->gettxt_metatitle():'';?>" title="Ingrese el meta Title de la categoría"/>				
			 </p>
			 
			  <p>
				<label>Meta Description de la Categor&iacute;a:</label>
			 	<textarea class="input-medium" id="get_metacategory" cols="60" rows="7" title="Ingrese el MetaTag de la categoría" name="get_metacategory"><?php echo ($IsActionG==0)?$cls_categoria->gettxt_meta():'';?></textarea>
			 </p>
			 
			  <p>
				<label>Categoría:</label>
				  <select name='sle_parent' id="sle_parent" class="input-medium">
					<option value='0'>Categoría absoluta</option>
					<?php		
					$ParentCmb = "";
					if($IsActionG == 1)
					$ParentCmb = $IsParent;
					else
					$ParentCmb = $cls_categoria->getParent($IsParent);
					?>
					<?php print $cls_categoria->getCategory_Mnu($ParentCmb,"")?>
				  </select>
			  </p>
			  
			   <p>
					<label>Orden:</label>
					<input type="text" value="<?php echo ($IsActionG==0)?$cls_categoria->getint_orden():''?>" id="txt_order" class="input-short" name="txt_order" title="Ingrese el orden de la categoría" >
					<span id="msg_order" class="notification-input ni-correct"></span>
				</p>
		
		 		<p>
					<label>Seleccione la imagen del categoria</label>
					<input name="file_categoria" title="Ingrese la imagen de la categoria" type="file" class="input-medium" id="file_categoria" accept="jpeg|jpg" />
					<input type="hidden" name="hidden_categoriaimg" id="hidden_categoriaimg" value="<?php print $cls_categoria->gettxt_imagen();?>" />
					 <span class="required">(*) Tama&ntilde;o: 730px X 114px *.jpg, *.gif</span>
					<span id="msg_imagencat" class="notification-input ni-correct"></span>
				</p>
                      
				 <p>
					<label>Enlace Externo:</label>
					<input type="text" name="txt_linkexterno" id="txt_linkexterno" class="input-medium" value="<?php echo $cls_categoria->gettxt_linkexterno();?>" />
					<span class="notification-input ni-correct"></span>
				 </p>     
				 
				              
				<fieldset>
					<legend>Ubicacion:</legend>
					<ul>
						<li><label><input name="opt_nivel" id="opt_nivel" type="radio" value="1" <?php print ($cls_categoria->getint_tipo()==1)?'checked':'';?> />Listado</label></li>
						<li><label><input name="opt_nivel" id="opt_nivel" type="radio" value="2" <?php print ($cls_categoria->getint_tipo()==2)?'checked':'';?>/>SubCategorias</label></li>
					</ul>
				</fieldset> 
				
				<fieldset>
					<legend></legend>
					<ul>
						<li><label> <input name="chk_status" type="checkbox" id="chk_status" value="1" <?php echo ($cls_categoria->getint_estado()==1 && $IsActionG==0)?'checked':'';?>/>
      <input type="hidden" name="hdo" id="hdo" value="<?php echo $do;?>"/>
      <input type="hidden" name="id" id="id" value="<?php echo $IsParent;?>"/> Publicar</label></li>
					</ul>
				</fieldset>
				
				<fieldset>

					
					<?php if($IsActionG==0) { ?>
					  <input type="Button" value="Actualizar categoría"  class='submit-green' id="btn_save"/>
					<?php 	}
					else{?>
					<input type="Button" value="Guardar categoría" class='submit-green' id="btn_save"/>
					 <?php }?>
					&nbsp;&nbsp;
					<input type="Button" value="Regresar" onclick="javascript:window.location='inf_categorias.php'" class='submit-gray' /> 
		
		
				</fieldset>

</form>
	</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>
<script  language="javascript" type="text/javascript">
var $ul = jQuery.noConflict();
(function() {
   $ul("#btn_save").click(function(e){
	  
	  var submitButton = $ul("#btn_save");
      var $this = this; var status=true;
      /*Titulo del banner*/
	  if(jQuery.trim($ul('#get_namecategory').val())==""){$ul("#msg_titlecat").html($ul('#get_namecategory').attr('title')).addClass('msg-error'); $ul('#get_namecategory').focus(); status=false;
      }else{ $ul("#msg_titlecat").html("").removeClass('msg-error');}
	  
	  
	  var MathNumber = /^([0-9])*$/ ;
	  if (jQuery.trim($ul('#txt_order').val())=='' || !MathNumber.test(jQuery.trim($ul("#txt_order").val()))   ) {
		$ul("#msg_order").html($ul('#txt_order').attr('title')).addClass('msg-error'); $ul('#txt_order').focus(); status=false;																						      }else{
		$ul("#msg_order").html("").removeClass('msg-error');	
	  }
	  
	  if(!status) return false;
	  
      if(status) {
		  $ul(submitButton).attr("value", "Por favor espere...");
		  $ul(submitButton).attr("disabled", "true");
			
		if(IsAction=='0'){
		editar();
		}else{
		registrar();
		}
	  }
	  
	 
	  
   });

})(jQuery);
</script>
<?php
require_once("footer.php");
?>