<?php
require_once("header.php");
?>
<?php
$id_paq = (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];
$cls_paquete = new cls_tbl_paquete($id_paq);
$page = $_GET['page'];
	
if(empty($page) || !is_numeric($page) || $page == '')
$page = 1;
$limit = 18;	//	imagenes por pagina
$from = $page * $limit - ($limit);
       
$total_photoalbum = count_entries('paquete_images', 'prod_id', $id_paq);
if($total_photoalbum - $from == 1)
$page--;
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_listphoto';
var IsAction = '<?php echo $IsActionG?>';
var urlProcess = 'proc_paquete.php';
var IsRowSlow = 'arrayorder_';
</script>

<link href="js/uploaddiffy/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/uploaddiffy/swfobject.js"></script>
<script type="text/javascript" src="js/uploaddiffy/jquery.uploadify.v2.1.0.min.js"></script>

<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 	
	  function slideout(){
  	  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });
    
}, 2000);}
	
    $("#response").hide();
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable("serialize") + '&op=9&id=<?php echo $id_paq;?>'; 
			$.post(urlProcess, order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});
</script>
<style>
#response {
	padding:10px;
	background-color:#F4F4F4;
	border:2px solid #DCDCDC;
	margin-bottom:20px;
	color:#000;
}
#list li {
	margin: 0 0 3px;
	padding:0px;
	background-color:#FFF;
	color:#000;
	list-style: none;
	float:left;
}
#list li .albumfoto{
	margin-left:0px;
	margin-right:0px;
}
</style>
<!--  Content  -->
<div id="content">
<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" >
 
 <tr>
  <td colspan="2">
    <div id="tabsJ">
		  <ul>
		    <li><a href="home.php" title="Panel principal"><span>PANEL PRINCIPAL</span></a></li>
			<li><a href="inf_paquete.php" title="Imagenes del producto"><span>Paquete Turistico</span></a></li>
		  </ul>
		</div>
  </td>
 </tr>
 
 <tr>
    <td width="86%"  height="30" align="center" class='maintitle'>LISTA DE IMAGENES DEL PAQUETE : 
	<strong>  </strong></td>
	<td width="14%" align="center" class='maintitle'>Total de registros: <?php echo $total_photoalbum?></td>
   </tr>
</table>
<form action="" method="POST" name="frm_listphoto" id="frm_listphoto" enctype="multipart/form-data">
<table width="100%" align="center" cellpadding="0" cellspacing="1" class="tablesorter" id="myTable">
<thead>
        </thead>
          <tbody>

      <?php	
		
		$sqlAlbum = "SELECT * FROM [|PREFIX|]paquete_images WHERE prod_id='".$id_paq."' ORDER BY prod_order ASC LIMIT $from,$limit";
		$Query = $GLOBALS['CONNECT_DB']->Query($sqlAlbum)or die(mysql_error());

	    if ($total_photoalbum==0)
	  		echo "<tr bgcolor=\"#FFFFFF\" height=\"30\"> <td colspan=\"10\" align=\"center\" valign=\"middle\" style=\"padding-top:5px; font-size:12px; color:#FF0000;\">No se encontró imagenes en el producto.</td></tr>";
		else
		{?>
		<tr bgcolor="#FFFFFF">
			<td  colspan="10" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">
			  <div id="list">
                <div id="response"> </div>
                  <ul>
                    <?php
                    $img = "";	
					while($row = $GLOBALS['CONNECT_DB']->Fetch($Query))
				      {
						if(tep_not_null($row['prod_imgmedium']) && file_exists(ADMIN_IMG_PMIN.$row['prod_imgmedium'])){
							$img = base64_encode(ADMIN_IMG_PMIN.$row['prod_imgmedium']);
							$url_img = "thumb-img.php?image=$img&w=100&h=100&IsCrop=0";
						}else{
							$img = base64_encode(ADMIN_IMG_PMIN.'img_gallery_noavailable.jpg');
							$url_img = "thumb-img.php?image=$img&w=80&h=82&IsCrop=0";
						}
						$file_name = secure_sql($row['prod_imgmedium']);
					?>
                    <li id="arrayorder_<?php echo $row['pict_id']; ?>">
                      <div id="album" >
                           <div class="albumfoto">
                             <img src="<?php echo $url_img?>"  border="0" style="margin:4px 0; "><br />
                             <a href="javascript:RemoveImages('<?php echo $row['pict_id']?>','<?php echo $file_name?>');" title="Haga click para remover la imagen" style="color:#000; text-decoration:none; font-size:12px;">Quitar imagen<img src="images/icons/ico_remove.gif" alt="Eliminar articulo" width="16" height="16" border="0" align="top"></a>
                          </div>                          
                      </div>
                    </li>
                    <?php
					  }
					?>
                  </ul>
              </div>
            </td>
		</tr>
		<?php			
		}
		?>
        
        <tr>
         <td>
          
          <input type="file" name="file_upload" id="file_upload"  />
          
         </td>
        </tr>
        
        <tr>
		    <td  colspan="10" align="center" valign="middle" style="vertical-align:middle;padding:5px 0;">
          <span class="ds">
              <span class="lsbb">
                 <input type="button" class="lsb" value="Subir Imagenes" name="btn_save" id="btn_save" onclick="$('#file_upload').uploadifyUpload()">
              </span>
          </span>
          
          <span class="ds">
              <span class="lsbb">
                 <input type="button" class="lsb" value="Regresar al listado de productos" onclick="location.href='inf_producto.php'">
              </span>
          </span>
            <input name="id" type="hidden" value="<?php print $id_paq;?>" id="id" />
            </td>
		    </tr>
		
          </tbody>
      </table>

</form>
<script type="text/javascript">

$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : 'js/uploaddiffy/uploadify.swf',
    'script'    : 'proc_paquete.php',
    'cancelImg' : 'js/uploaddiffy/cancel.png',
    'auto'      : false,
	'multi': true,
	'displayData': 'percentage',
	'sizeLimit': ' 1048576', <!--Bytes-->
	'fileDesc': '*.jpg;*.jpeg;*.gif',
	'fileExt': '*.jpg;*.jpeg;*.gif',
	scriptData : {'op' : '8','id': <?php echo $id_paq;?>},
	onAllComplete: function(a,b,c,d,e) {
                    window.location.reload();
                }
     });
});

</script>
</div>
<!--  Content  -->
<!--  Footer  -->
<?php
require_once("footer.php");
?>