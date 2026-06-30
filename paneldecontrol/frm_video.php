<?php
require_once("header.php");
?>

<?php
$IsVideo = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$videocls = new cls_tbl_video($IsVideo);

$IsActionG = "";
if($do=='create') {

if($IsVideo>0 && !$videocls->IsExistVideo())
$IsVideo = 0 ;

$IsActionG = 1;

}else{
if($videocls->IsExistVideo())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Video YouTube";
else
$MessageForm = "Crear Video YouTube";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>

<script language="javascript" type="text/javascript" >
var MyForm = 'frm_video';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_videos.php';
</script>

<div class="container_16">
	<div style="clear:both;"></div>
			<div class="grid_12">
				<div class="module">
				<h2><span><?php print $MessageForm ;?></span></h2>
				<div class="module-body">

<form method="post" enctype="multipart/form-data" name="frm_video" id="frm_video" >
				<div>
						<span class="notification n-success">Registros Obligatorios</span>
				</div>
				  <p>
					<label>Titulo del Video:</label>
					<input type="text" id="video_title" name="video_title"  value="<?php echo $videocls->gettxt_video_title()?>" class="input-medium" />
					<span class="notification-input ni-correct"></span>
				 </p>
				 
				  <p>
					<label>http://www.youtube.com/watch?v=</label>
					<input name="txt_yt_thumb" type="text" id="txt_yt_thumb"  value="<?php echo $videocls->gettxt_yt_id()?>" class="input-short" /> 
					<span class="notification-input ni-correct"></span>
				 </p>
				 
				 <fieldset>
					<legend></legend>
					<ul>
						<li><label><input name="chk_status" type="checkbox" id="chk_status" value="1"  <?php echo ($videocls->getint_estado()==1)?'checked':''?>/> Visible</label></li>
						<li><label><input name="chk_portada" type="checkbox" id="chk_portada" value="1"  <?php echo ($videocls->getv_destacado()==1)?'checked':''?>/>  Portada</label></li>
					</ul>
				</fieldset>
				
				  <fieldset>
					<?php if($IsActionG==0) { ?>
					<input type="Button" value="Actualizar video" onclick="javascript:editar(<?php echo $id?>);" class='submit-green' />
						<?php 	}
					else{?>
						<input type="Button" value="Añadir video" onclick="javascript:registrar();" class='submit-green' />
						<?php }?>
            
            		<input type="Button" value="Regresar" onclick="javascript:window.location='inf_videos.php'" class='submit-gray' /> 
					
				</fieldset>


</form>

</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<script type="text/javascript">

function validar()
{	var i;
	i=0;	

	if(document.frm_video.video_title.value=="" && i==0)
	{ alert("Por favor, Ingrese el titulo del video.");
	  document.frm_video.video_title.focus();
	  i=i+1;			
	}
	if(document.frm_video.txt_yt_thumb.value=="" && i==0)
	{ alert("Por favor, Ingrese ID del video.");
	  document.frm_video.txt_yt_thumb.focus();
	  i=i+1;			
	}

	return i;
}

function registrar()
{	var i=validar();	
	if(i==0)
	{	document.frm_video.action="proc_video.php?op=1";
		document.frm_video.submit();	}
}

function editar(id)
{	var i=validar();		
	if(i==0)
	{	document.frm_video.action="proc_video.php?op=2&id="+id;
		document.frm_video.submit();
	}
}

</script>
<?php
require_once("footer.php");
?>
