<?php
require_once("header.php");
?>
<?php
$id_album = (int)(tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'];

$page = $_GET['page'];
	
if(empty($page) || !is_numeric($page) || $page == '')
$page = 1;
$limit = 18;	//	imagenes por pagina
$from = $page * $limit - ($limit);
       
$total_photoalbum = count_entries('album_photo', 'fk_album', $id_album);
if($total_photoalbum - $from == 1)
$page--;

$cls_album_img = new cls_tbl_album($id_album);
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_listphoto';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_album.php';
var IsRowSlow = 'ListPhoto';
</script>

<!--  Content  -->
<div class="container_12">
 <div style="clear: both"></div>
 	<div class="bottom-spacing">
 		
					<!-- Button -->
		<div class="float-right">
			<a href="inf_album.php" class="button">
				<span>Album de Fotos <img src="images/plus-small.gif" width="12" height="9" alt="Regresar" /></span>
			</a>
		</div>
		
		<div class="module">
 			<h2><span>Gesti&oacute;n de Album de Fotos | Total de registros: <?php print $total_photoalbumm?></span></h2>

		<div class="module-table-body">	
<form action="" method="POST" name="frm_listphoto" id="frm_listphoto" >
<table class="tablesorter" id="myTable">
<thead>
        </thead>
          <tbody>

      <?php	
		
		$sqlAlbum = "SELECT * FROM [|PREFIX|]album_photo WHERE fk_album='".$id_album."' ORDER BY id_photoalbum DESC LIMIT ".$from.",".$limit." ";
		$Query = $GLOBALS['CONNECT_DB']->Query($sqlAlbum);

	    if ($total_photoalbum==0)
	  		echo "<tr bgcolor=\"#FFFFFF\" height=\"30\"> <td colspan=\"10\" align=\"center\" valign=\"middle\" style=\"padding-top:5px; font-size:12px; color:#FF0000;\">No se encontró fotos en este evento.</td></tr>";
		else
		{?>
			<tr>
				<td  colspan="10" align="center" valign="middle" style="padding-top:5px; font-size:12px; color:#FF0000;">
			<div id="album">
			<?php
			$img = "";	
			while($row = $GLOBALS['CONNECT_DB']->Fetch($Query))
				{
            
			if(tep_not_null($row['fotoalbum_prev']) && file_exists(ADMIN_ALBUM_MIN.$row['fotoalbum_prev'])){
			$img = base64_encode(ADMIN_ALBUM_MIN.$row['fotoalbum_prev']);
			$url_img = "resize.php?image=$img&w=82&h=82&IsCrop=1";
			}else{
			$img = base64_encode(ADMIN_ALBUM_MIN.'img_gallery_noavailable.jpg');
			$url_img = "resize.php?image=$img&w=82&h=82&IsCrop=0";
			}
			$file_name = secure_sql($row['fotoalbum_prev']);
?>
				<div class="albumfoto" id="ListPhoto<?php print $row['id_photoalbum'];?>">
				<table width='100%' align="center" >
				<tr>
				    <td height="89" align="center"  >						
						
                        <img src="<?php print $url_img;?>"  border="0" style="cursor:pointer;">						</td>
			    </tr>
				<tr>
				    <td align="center" height="30" class='Field100'><a href="javascript:RemoveImgAlbum('<?php print $row['id_photoalbum'];?>','<?php print $file_name;?>');" title="Haga click para remover la imagen">
						 <img src="images/icons/ico_remove.gif" alt="Eliminar articulo" width="16" height="16" border="0" align="top">
                        </a>                        </td>
			    </tr>
				</table>
					</div>
				<?php
				} 
						
		if($total_photoalbum - $from == 1)
		$page++;

				?>
			</div>			</td>
		</tr>
		<?php			
		}
		?>
        
        
        <tr>
		    <td  colspan="10" align="center">
				<input type="reset" name="button2" class="submit-green" id="button2" value="Añadir imagenes" onclick="open_window('upimgalbum.php?id=<?php print $id_album;?>',540,316);" 
			<?php if(!$cls_album_img->IsExistAlbum()){print 'disabled';}?>/>
			    <input type="button" class="submit-gray" name="button3" id="button3" value="Regresar"  onclick="location.href='inf_album.php'" /></td>
		    </tr>
		
          </tbody>
      </table>
</form>
                        </div>
						
 </div>
                       
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>
<!--  Content  -->
<!--  Footer  -->
<?php
require_once("footer.php");
?>